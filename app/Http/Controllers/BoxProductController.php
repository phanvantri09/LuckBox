<?php

namespace App\Http\Controllers;

use App\Helpers\ConstCommon;
use App\Http\Requests\Box\CrateRequestBoxProduct;
use App\Models\Box_product;
use App\Repositories\BoxProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoxProductController extends Controller
{
    protected $boxProductRepository;

    public function __construct(BoxProductRepositoryInterface $boxProductRepository)
    {
        $this->boxProductRepository = $boxProductRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create($id)
    {
        $optionsProducts = $this->boxProductRepository->getAllProductNotInBox($id);
        $product = $this->boxProductRepository->getAllProduct($id);
        return view('admin.box.addProduct', compact('optionsProducts', 'product', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CrateRequestBoxProduct $request, $id)
    {
        $currentUser = Auth::user();
        $products = $request->input('products', []);

        $productData = $this->boxProductRepository->getAllProduct($id);

        if (count($products) + $productData->boxProducts->count() > 10) {
            return redirect()->back()->withErrors(['products' => 'Vượt quá số lượng 10 sản phẩm']);
        }

        foreach ($products as $productId) {
            $id_user_create = $currentUser->id;
            $id_user_update = $currentUser->id;
            $request->merge([
                "id_user_create"=>$id_user_create,
                "id_user_update"=>$id_user_update,
                'id_product' => $productId,
                'id_box' => $id
            ]);
            $data = $request->all();
            $this->boxProductRepository->create($data);
        }

        return redirect()->route('box.index')->with('success', 'data created successfully');
    }

    public function changeStatus(Request $request, $id)
    {
        $boxProduct = Box_product::findOrFail($id);

        $status = 1;
        if ($boxProduct->status == 1) {
            $status = 2;
        } else {
            $productData = $this->boxProductRepository->getCountProductStatus($boxProduct->id_box);
            if ($productData->boxProducts->count() >= 4) {
                return redirect()->back()->withErrors(['errStatus' => 'Chỉ được tối đa 4 sản phẩm được chọn']);
            }
        }
        $request->merge([
            'status' => $status
        ]);
        $data = $request->all();
        $this->boxProductRepository->update($data, $id);
        return redirect()->route('box.show', ['id'=>$boxProduct->id_box])->with('success', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $boxProduct = Box_product::findOrFail($id);
        $this->boxProductRepository->delete($id);
        return redirect()->route('box.show', ['id'=>$boxProduct->id_box])->with('success', 'Xóa thành công');
    }
}

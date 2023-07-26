<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ImageRepositoryInterface;

use App\Helpers\ConstCommon;

use App\Http\Requests\Product\CreateRequestProduct;
use App\Http\Requests\Product\UpdateRequestProduct;

use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    protected $imageRepository;
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository, ImageRepositoryInterface $imageRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
        $this->imageRepository = $imageRepository;
    }

    public function index()
    {
        $data = $this->productRepository->all();
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['product']);

        return view('admin.product.list', compact([ 'data', 'category' ]));
    }
    public function show($id)
    {
        $data = $this->productRepository->show($id);
        $getAllByIDProductMain = $this->imageRepository->getAllByIDProductMain($id);
        $getAllByIDProductSlide = $this->imageRepository->getAllByIDProductSlide($id);
        $getAllByIDProductItem = $this->imageRepository->getAllByIDProductItem($id);
        return view('admin.product.show', compact('data', 'getAllByIDProductMain', 'getAllByIDProductSlide', 'getAllByIDProductItem'));
    }
    public function create()
    {
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['product']);
        return view('admin.product.add', compact('category'));
    }

    public function store(CreateRequestProduct $request)
    {
        $currentUser = Auth::user();
        $id_user_create = $currentUser->id;
        $id_user_update = $currentUser->id;
        $request->merge(["id_user_create"=>$id_user_create,"id_user_update"=>$id_user_update]);
        $data = $request->all();
        $this->productRepository->create($data);
        return redirect()->route('product.index')->with('success', 'data created successfully');
    }

    public function edit($id)
    {
        $data = $this->productRepository->show($id);
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['product']);
        return view('admin.product.edit', compact('data', 'category'));
    }

    public function update(UpdateRequestProduct $request, $id)
    {
        $currentUser = Auth::user();
        $id_user_update = $currentUser->id;
        $request->merge(["id_user_update"=>$id_user_update]);
        $data = $request->all();
        $this->productRepository->update($data, $id);
        return redirect()->route('product.index')->with('success', 'data updated successfully');
    }

    public function destroy($id)
    {
        $this->productRepository->delete($id);
        return redirect()->route('product.index')->with('success', 'data deleted successfully');
    }
    public function addImage($id){
        $data = $this->productRepository->show($id);
        $category = ConstCommon::TypeImgae;
        $getAllByIDProductItem = $this->imageRepository->getAllByIDProductItem($id);
        $getAllByIDProductMain = $this->imageRepository->getAllByIDProductMain($id);
        $getAllByIDProductSlide = $this->imageRepository->getAllByIDProductSlide($id);
        // dd($getAllByIDProductItem, $getAllByIDProductItem , $getAllByIDProductSlide, $getAllByIDProductMain->link_image);
        return view('admin.product.addImage', compact([ 'data', 'category', 'getAllByIDProductItem','getAllByIDProductMain', 'getAllByIDProductSlide']));
        // $imageRepository->create($data);
    }
    public function addImagePost(Request $request){
        $requestData = $request->except(['_token']);
        $dataImage = [];
        foreach ($requestData as $key => $value) {
            if (!empty($value)) {
                DB::beginTransaction();
                try {
                    $index = 0;
                    $nameImage = 'Product-'.$key.'-'.ConstCommon::getCurrentTime().'.'.$value->extension();
                    ConstCommon::addImageToStorage($value, $nameImage );
                    if ($key == 'imageMain') {
                        $this->imageRepository->create(['id_product' => $request->id, 'link_image'=> $nameImage, 'description' => null, 'type' => 1, 'is_slide' => null]);
                    } elseif ($key == 'imageSlide') {
                        $this->imageRepository->create(['id_product' => $request->id, 'link_image'=> $nameImage, 'description' => null, 'type' => null, 'is_slide' => 1]);
                    } else {
                        $this->imageRepository->create(['id_product' => $request->id, 'link_image'=> $nameImage, 'description' => null, 'type' => null, 'is_slide' => null]);
                    }
                    $index++;
                    DB::commit();
                } catch (\Throwable $th) {
                    DB::rollback();
                    report($th);
                    return redirect()->back()->with('error', 'Đã xảy ra lỗi vui lòng nhập lại');
                }
            }
        }
        return redirect()->route('product.index');
    }

    public function addImage2($id){
        return view('admin.product.addImage2', compact('id'));
    }
    public function addImagePost2(Request $request, $id){
        if ($request->hasFile('imageItem')) {
            $files = $request->file('imageItem');
            foreach ($files as $key => $file){
                $nameImage = 'Product-imageItem' . ConstCommon::getCurrentTime() . '-'.$key.'.' . $file->extension();
                ConstCommon::addImageToStorage($file, $nameImage);
                $request->merge([
                    'link_image' => $nameImage,
                    'id_product' => $id
                ]);
                $data = $request->all();
                $this->imageRepository->create($data);
            }
        }
        if ($request->hasFile('imageMain')) {
            $getAllByIDProductMain = $this->imageRepository->getAllByIDProductMain($id);
            if ($getAllByIDProductMain) {
                Storage::disk('public')->delete('images/' . $getAllByIDProductMain['link_image']);
                $this->imageRepository->delete($getAllByIDProductMain['id']);
            }
            $request->replace([]);
            $nameImage = 'Product-imageMain' . ConstCommon::getCurrentTime() . '.' . $request->imageMain->extension();
            ConstCommon::addImageToStorage($request->imageMain, $nameImage);
            $request->merge([
                'link_image' => $nameImage,
                'id_product' => $id,
                'type' => 1
            ]);
            $data = $request->all();
            $this->imageRepository->create($data);
        }
        if ($request->hasFile('imageSlide')) {
            $getAllByIDProductSlide = $this->imageRepository->getAllByIDProductSlide($id);
            if ($getAllByIDProductSlide) {
                Storage::disk('public')->delete('images/' . $getAllByIDProductSlide['link_image']);
                $this->imageRepository->delete($getAllByIDProductSlide['id']);
            }
            $request->replace([]);
            $nameImage = 'Product-imageSlide' . ConstCommon::getCurrentTime() . '.' . $request->imageSlide->extension();
            ConstCommon::addImageToStorage($request->imageSlide, $nameImage);
            $request->merge([
                'link_image' => $nameImage,
                'id_product' => $id,
                'is_slide' => 1
            ]);
            $data = $request->all();
            $this->imageRepository->create($data);
        }
        return redirect()->route('product.index');
    }

    public function destroyImage($id)
    {
        $imageData = $this->imageRepository->show($id);
        Storage::disk('public')->delete('images/' . $imageData->link_image);
        $this->imageRepository->delete($id);
        return redirect()->route('product.show', ['id'=>$imageData->id_product])->with('success', 'data deleted successfully');
    }
}

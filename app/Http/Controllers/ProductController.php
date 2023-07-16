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
        return view('admin.product.list', compact('data'));
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
        return view('admin.product.edit', compact('data'));
    }

    public function update(UpdateRequestProduct $request, $id)
    {
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

        return view('admin.product.addImage', compact([ 'data', 'category']));
        // $imageRepository->create($data);
    }
    public function addImagePost(Request $request){
        // 'link_image',
        // 'description',
        // 'type',
        // 'is_slide',
        // ConstCommon::getCurrentTime();
        $data = $this->productRepository->show($request->id_product);
        // $imageRepository->create($data);
        return view('admin.product.addImage', compact('data'));
    }
}

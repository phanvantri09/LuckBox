<?php

namespace App\Http\Controllers;

use App\Helpers\ConstCommon;
use App\Http\Requests\Box\CreateRequestBox;
use App\Http\Requests\Box\UpdateRequestBox;
use App\Repositories\BoxProductRepositoryInterface;
use App\Repositories\BoxRepositoryInterface;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BoxController extends Controller
{
    protected $categoryRepository;
    protected $boxRepository;
    protected $boxProductRepository;

    public function __construct(BoxRepositoryInterface $boxRepository, CategoryRepositoryInterface $categoryRepository, BoxProductRepositoryInterface $boxProductRepository)
    {
        $this->boxRepository = $boxRepository;
        $this->categoryRepository = $categoryRepository;
        $this->boxProductRepository = $boxProductRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->boxRepository->all();

        return view('admin.box.list', compact([ 'data' ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['box']);
        return view('admin.box.add', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateRequestBox $request)
    {
        $currentUser = Auth::user();

        $file = $request->file('image');
        $nameImage = 'Box-'.ConstCommon::getCurrentTime().'.'.$request->image->extension();
        ConstCommon::addImageToStorage($request->image, $nameImage );
        // $path = Storage::disk('public')->putFileAs('images', $file,$file->getClientOriginalName());

        $id_user_create = $currentUser->id;
        $id_user_update = $currentUser->id;
        $request->merge(["id_user_create"=>$id_user_create,"id_user_update"=>$id_user_update, 'link_image' => $nameImage]);
        $data = $request->all();
        $this->boxRepository->create($data);
        return redirect()->route('box.index')->with('success', 'data created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->boxRepository->show($id);
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['box']);
        $product = $this->boxProductRepository->getAllProduct($id);
        return view('admin.box.show', compact('data', 'category', 'product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = $this->boxRepository->show($id);
        $category = $this->categoryRepository->getAllByType(ConstCommon::ListTypeCatogory['box']);
        return view('admin.box.edit', compact('data', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequestBox $request, $id)
    {
        $currentUser = Auth::user();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Storage::disk('public')->putFileAs('images', $file, $file->getClientOriginalName());
            $request->merge(['link_image' => $path]);
        }

        $id_user_update = $currentUser->id;
        $request->merge([
            'id_user_update' => $id_user_update
        ]);
        $data = $request->all();
        $this->boxRepository->update($data, $id);
        return redirect()->route('box.index')->with('success', 'data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->boxRepository->delete($id);
        return redirect()->route('box.index')->with('success', 'Xóa thành công');
    }
}

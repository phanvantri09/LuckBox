<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepositoryInterface;
use App\Http\Requests\Category\CreateRequestCategory;
use App\Http\Requests\Category\UpdateRequestCategory;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $data = $this->categoryRepository->all();
        return view('admin.category.list', compact('data'));
    }

    public function create()
    {
        return view('admin.category.add');
    }

    public function store(CreateRequestCategory $request)
    {

        $data = $request->all();
        $this->categoryRepository->create($data);
        return redirect()->route('category.index')->with('success', 'data created successfully');
    }

    public function edit($id)
    {
        $data = $this->categoryRepository->show($id);
        return view('admin.category.edit', compact('data'));
    }

    public function update(UpdateRequestCategory $request, $id)
    {
        $data = $request->all();
        $this->categoryRepository->update($data, $id);
        return redirect()->route('category.index')->with('success', 'data updated successfully');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('category.index')->with('success', 'Xóa thành công');
    }
}

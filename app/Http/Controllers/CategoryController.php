<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Repositories\CategoryRepositoryInterface;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $users = $this->categoryRepository->all();
        return view('category.index', compact('users'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $this->categoryRepository->create($data);
        return redirect()->route('category.index')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = $this->categoryRepository->show($id);
        return view('category.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->categoryRepository->update($data, $id);
        return redirect()->route('category.index')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $this->categoryRepository->delete($id);
        return redirect()->route('category.index')->with('success', 'User deleted successfully');
    }
}

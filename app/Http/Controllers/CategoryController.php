<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function viewList()
    {

        return view('category.index');
    }
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function viewCreate()
    {
        return view('category.categorycreate');
    }
    public function store(CategoryRequest $request)
    {
        // Validate dữ liệu form nếu cần thiết
        $validatedData = $request->validated();

        $category = Category::create($validatedData);

        return response()->json($category, 201);
    }
    public function destroy($id)
    {
        $item = Category::find($id);
        if (!$item) {
            return response()->json(['message' => 'Mục không tồn tại'], 404);
        }
        $item->hotels()->delete();
        $item->delete();
        return response()->json(['message' => 'Xóa mục thành công'], 200);
    }
    public function edit($id)
    {
        $categories = Category::find($id);
        return view('category.edit', compact('categories'));
    }
    public function update(CategoryRequest $request, $id)
{
    $validatedData = $request->validated();

    $category = Category::find($id);
    if (!$category) {
        return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
    }

    $category->update($validatedData);

    return response()->json(['message' => 'Cập nhật thành công'], 200);
}
}

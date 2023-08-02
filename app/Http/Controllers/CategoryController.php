<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function viewList(){

        return view('category.index');
    }
    public function index()
    {
        $categories =Category::all();
        return response()->json($categories);
    }
    public function viewCreate() {
        return view('category.categorycreate');
    }
    public function store(Request $request)
    {
        // Validate dữ liệu form nếu cần thiết
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string',
            'description' => 'required|string',
        ]);

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
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string',
            'description' => 'required|string',
            // Thêm các rules validate khác cho các trường dữ liệu khác nếu cần
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = Category::find($id);
        if (!$category) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }

        $category->update($request->all());

        return response()->json(['message' => 'Cập nhật thành công'], 200);
    }
}

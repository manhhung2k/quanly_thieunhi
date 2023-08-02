<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HotelController extends Controller
{
    public function viewHotel()
    {
        return view('hotel.index');
    }
    public function index()
    {
        $hotels = Hotel::with('category')->get();
        return response()->json($hotels);
    }
    public function viewCreate()
    {
        return view('hotel.hotelcreate');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'code' => 'required',
            'price_max' => 'required|numeric|greater_than_field:price_min',
            'price_min' => 'required|numeric|less_than_field:price_max',
            'sale_day' => 'required|greater_than_today',
        ]);


        $hotel = Hotel::create($validatedData);

        return response()->json($hotel, 201);
    }

    public function destroy($id)
    {
        $item = Hotel::find($id);
        if (!$item) {
            return response()->json(['message' => 'Mục không tồn tại'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Xóa mục thành công'], 200);
    }
    public function edit($id) {
        $hotels = Hotel::find($id);
        $categories = Hotel::with('category')->find($id);
        return view('hotel.edit', compact('hotels','categories'));
    }
    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'code' => 'required',
            'price_max' => 'required|numeric|greater_than_field:price_min',
            'price_min' => 'required|numeric|less_than_field:price_max',
            'sale_day' => 'required|greater_than_today',
        ]);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        $hotel = Hotel::find($id);
        if (!$hotel) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }

        $hotel->update($request->all());

        return response()->json(['message' => 'Cập nhật thành công'], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
            'price_max' => 'required|numeric|greater_than_field:price_min',
            'price_min' => 'required|numeric|less_than_field:price_max',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:4096',
            'sale_day' => 'required|greater_than_today',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Lưu thông tin khách sạn vào database
        $hotel = new Hotel();
        $hotel->name = $request->input('name');
        $hotel->code = $request->input('code');
        $hotel->price_max = $request->input('price_max');
        $hotel->price_min = $request->input('price_min');
        $hotel->category_id = $request->input('category_id');
        $hotel->sale_day = $request->input('sale_day');

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);

        $hotel->image = $imageName;
        $hotel->save();

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
    public function edit($id)
    {
        $hotels = Hotel::find($id);
        $categories = Hotel::with('category')->find($id);
        return view('hotel.edit', compact('hotels', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'code' => 'required',
            'price_max' => 'required|numeric|greater_than_field:price_min',
            'price_min' => 'required|numeric|less_than_field:price_max',
            'sale_day' => 'required|greater_than_today',
        ];
        if (empty($request->image_1)) {
            $rules['image'] = 'required|image|mimes:jpeg,png,jpg,gif|max:4096';
        }
        $validate = Validator::make($request->all(), $rules);
        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }
        $hotel = Hotel::find($id);
        $hotel->name = $request->input('name');
        $hotel->code = $request->input('code');
        $hotel->price_max = $request->input('price_max');
        $hotel->price_min = $request->input('price_min');
        $hotel->category_id = $request->input('category_id');
        $hotel->sale_day = $request->input('sale_day');
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $hotel->image = $imageName;
        } else {
            $hotel->image = $request->input('image_1');
        }

        $hotel->save();
        return response()->json($hotel, 201);

    }
}

<?php

namespace App\Http\Controllers;

use App\Exports\ExportFile;
use App\Exports\HotelExport;
use App\Exports\HotelsExport;
use App\Http\Requests\ExcelUploadRequest;
use App\Http\Requests\HotelRequest;
use App\Imports\HotelsImport;
use App\Models\Category;
use App\Models\Hotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

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
    public function store(HotelRequest $request)
    {
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
    public function update(HotelRequest $request, $id)
    {
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
    public function export()
    {
        $hotels = Hotel::all();

        return Excel::download(new ExportFile($hotels), 'all_hotels.xlsx');
    }
    public function exportHotels(Category $category)
    {
        $export = new HotelExport($category);

        return Excel::download($export, 'hotels_in_' . $category->name . '.xlsx');
    }
    public function indexExcelCSV()
    {
        return view('hotel.excel-csv-import');
    }
    public function importExcelCSV(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ]);

        try {
            Excel::import(new HotelsImport, $request->file('file'));
            return redirect('/hotel')->with('status', 'The file has been excel imported to the database');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}

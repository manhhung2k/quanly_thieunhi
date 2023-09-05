<?php

namespace App\Http\Controllers;

use App\Exports\ExportFile;
use App\Exports\HotelExport;
use App\Http\Requests\ChildrenRequest;
use App\Http\Requests\ExcelUploadRequest;
use App\Http\Requests\HotelRequest;
use App\Imports\HotelsImport;
use App\Models\Category;
use App\Models\Children;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ChildrenController extends Controller
{
    public function viewHotel()
    {
        return view('children.index');
    }
    public function index()
    {
        $children = Children::all();
        return response()->json($children);
    }
    public function viewCreate()
    {
        return view('children.hotelcreate');
    }
    public function store(ChildrenRequest $request)
    {

        $validatedData = $request->all();
        $children = Children::create($validatedData);

        return response()->json($children, 201);
    }

    public function destroy($id)
    {
        $item = Children::find($id);
        if (!$item) {
            return response()->json(['message' => 'Mục không tồn tại'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Xóa mục thành công'], 200);
    }
    public function edit($id)
    {
        $children = Children::find($id);
        return view('children.edit', compact('children'));
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->all();

        $children = Children::find($id);
        if (!$children) {
            return response()->json(['message' => 'Không tìm thấy danh mục'], 404);
        }

        $children->update($validatedData);

        return response()->json(['message' => 'Cập nhật thành công'], 200);

    }
    public function export()
    {
        $children = Children::all();

        return Excel::download(new ExportFile($children), 'all_children.xlsx');
    }
    public function indexExcelCSV()
    {
        return view('children.excel-csv-import');
    }
    public function importExcelCSV(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required',
        ]);

        try {
            Excel::import(new HotelsImport, $request->file('file'));
            return redirect('/children')->with('status', 'The file has been excel imported to the database');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }
}

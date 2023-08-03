<?php

namespace App\Exports;

use App\Models\Hotel;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class HotelExport implements FromQuery, WithHeadings
{
    use Exportable;

    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function query()
    {
        return Hotel::query()->where('category_id', $this->category->id);
    }
    public function headings(): array
    {
        // Thay đổi phần này bằng tên trường dữ liệu thực tế của bạn
        return ['ID', 'Name', 'Code', 'Price Max', 'Price Min', 'Category Id', 'Sale Day', 'Created At' ,' Update At','Image'];
    }
}


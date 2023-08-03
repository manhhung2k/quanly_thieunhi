<?php

namespace App\Exports;

use App\Models\Hotel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ExportFile implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    protected $hotels;

    public function __construct($hotels)
    {
        $this->hotels = $hotels;
    }

    public function collection()
    {
        // Trả về một Collection đã được tùy chỉnh với tên category
        return $this->hotels->map(function ($hotel) {
            $hotelData = $hotel->toArray();
            $hotelData['category_name'] = $hotel->category->name; // Lấy tên category từ quan hệ

            // Các trường dữ liệu cần được thêm vào trong $hotelData cũng có thể thêm vào đây (nếu có)
            // Ví dụ: $hotelData['other_field'] = $hotel->other_field;

            return $hotelData;
        });
    }
    public function headings(): array
    {
        // Thay đổi phần này bằng tên trường dữ liệu thực tế của bạn
        return ['ID', 'Name', 'Code', 'Price Max', 'Price Min', 'Category Id', 'Sale Day', 'Created At' ,' Update At','Image', 'Category Name'];
    }

}

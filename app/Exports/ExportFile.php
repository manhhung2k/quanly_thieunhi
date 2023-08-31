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
        return $this->hotels->map(function ($hotel) {
            $hotelData = $hotel->toArray();
            $hotelData['category_name'] = $hotel->category->name;
            return $hotelData;
        });
    }
    public function headings(): array
    {
        return ['ID', 'Name', 'Code', 'Price Max', 'Price Min', 'Category Id', 'Sale Day', 'Created At' ,' Update At','Image', 'Category Name'];
    }

}

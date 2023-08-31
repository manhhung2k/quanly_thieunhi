<?php

namespace App\Imports;

use App\Models\Hotel;
use App\Rules\GreaterThanFieldRule;
use App\Rules\LessThanFieldRule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
class HotelsImport implements ToModel, WithHeadingRow, WithValidation
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:category,id',
            'code' => 'required',
            'price_max' => [
                'required',
                'numeric',
            ],

            'price_min' => [
                'required',
                'numeric',
            ],
            'sale_day' => [
                'required',
                'date',
            ],
        ];

    }
    public function model(array $row)
    {
        return new Hotel([
            'name' => $row['name'],
            'code' => $row['code'],
            'price_max' => $row['price_max'],
            'price_min' => $row['price_min'],
            'category_id' => $row['category_id'],
            'sale_day' => $row['sale_day'],
            'created_at' => $row['created_at'],
            'update_at' => $row['update_at'],
            'image' => $row['image'],
        ]);
    }
}

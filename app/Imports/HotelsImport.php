<?php

namespace App\Imports;

use App\Models\Hotel;
use Maatwebsite\Excel\Concerns\ToModel;

class HotelsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Hotel([
            'name'     => $row[0],
            'email'    => $row[1],
            'code' => $row[2],
            'price_max' => $row[3],
            'price_min' => $row[4],
            'category_id' => $row[5],
            'sale_day' => $row[6],
            'created_at' => $row[7],
            'updated_at' => $row[8],
            'image' => $row[9],
        ]);
    }
}

<?php

namespace App\Imports;
use App\Models\Children;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HotelsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        return new Children([
            'first_name' => $row['ten_thanh_ho'],
            'last_name' => $row['ten'],
            'ngay_sinh' => $row['ngay_sinh'],
            'strawberry_church' => $row['giao_xomho'],
            'parents' => $row['ten_thanh_ho_va_ten_bo'],
            'phone_number' => $row['so_dt_bome'],
            'gender' => $row['gioi_tinh'],
            'parish' => $row['giao_xu'],
        ]);
    }
}

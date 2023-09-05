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
    protected $children;

    public function __construct($children)
    {
        $this->children = $children;
    }

    public function collection()
    {
        return $this->children->map(function ($child) {
            $childData = $child->toArray();
            return $childData;
        });
    }
    public function headings(): array
    {
        return ['ID', 'TÊN THÁNH - HỌ', 'TÊN', 'NGÀY SINH', 'GIÁO XÓM/HỌ', 'Niên khóa', 'TÊN THÁNH, HỌ VÀ TÊN BỐ', 'SỐ ĐT BỐ/MẸ' ,'GIỚI TÍNH','GIÁO XỨ','ĐIỂM GIỮA HỌC KỲ  1','ĐIỂM HỌC KỲ  1','ĐIỂM GIỮA HỌC KỲ 2','ĐIỂM HỌC KỲ 2'];
    }

}

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
        return ['ID', 'Tên Thánh và Họ', 'Tên', 'Ngày sinh', 'Giáo xóm', 'Niên khóa', 'Bố mẹ', 'Số điện thoại' ,'Giới tính','Giáo xứ','Điểm giữa học kỳ 1','Điểm học kỳ 1','Điểm giữa học kỳ 2','Điểm học kỳ 2'];
    }

}

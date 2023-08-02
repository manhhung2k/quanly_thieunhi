<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\users;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ (nếu có) trong bảng "users"
        

        // Thêm dữ liệu mẫu
        users::create([
            'id'=> 1,
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        users::create([
            'id'=> 2,
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
        ]);

        // Thêm nhiều dữ liệu mẫu bằng cách sử dụng hàm factory:
        // \App\Models\User::factory(10)->create();
    }
}

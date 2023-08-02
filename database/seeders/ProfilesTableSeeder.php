<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Profile;

class ProfilesTableSeeder extends Seeder
{
    public function run()
    {
        // Xóa dữ liệu cũ (nếu có) trong bảng "profiles"
        Profile::truncate();

        // Lấy danh sách người dùng để liên kết dữ liệu với bảng "users"
        $users = \App\Models\users::all();

        // Thêm dữ liệu mẫu cho mỗi người dùng
        foreach ($users as $user) {
            Profile::create([
                'user_id' => $user->id,
                'address' => '123 Main Street',
                'phone' => '555-1234',
            ]);
        }

        // Thêm dữ liệu mẫu bằng cách sử dụng hàm factory:
        // \App\Models\Profile::factory(10)->create();
    }
}

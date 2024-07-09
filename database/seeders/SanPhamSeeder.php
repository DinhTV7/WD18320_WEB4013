<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Nơi xử lý để tạo ra các dữ liệu mẫu
        // Sử dụng query builder để thêm dữ liệu

        // Tạo dữ liệu mẫu bằng faker trong Laravel

        DB::table('san_phams')->insert(
            [
                [
                    'ma_san_pham' => 'SP001',
                    'ten_san_pham' => 'Iphone 15',
                    'gia' => 100000,
                    'so_luong' => 10,
                    'ngay_nhap' => '2024-06-28',
                    'mo_ta' => 'Mô tả sản phẩm',
                    'trang_thai' => true
                ],
                [
                    'ma_san_pham' => 'SP002',
                    'ten_san_pham' => 'Iphone 16',
                    'gia' => 200000,
                    'so_luong' => 20,
                    'ngay_nhap' => '2024-06-28',
                    'mo_ta' => 'Mô tả sản phẩm',
                    'trang_thai' => true
                ]
            ]
        );
    }
}

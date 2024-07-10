<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory;

    // Cách 1: Sử dụng Raw Query (SQL thuần)
    // public function getList() {
    //     $listSanPham = DB::select('SELECT * FROM san_phams ORDER BY id DESC');

    //     return $listSanPham;
    // }

    // Cách 2: Sử dụng Query Builder
    // public function getList()
    // {
    //     $listSanPham = DB::table('san_phams')
    //         ->orderByDesc('id')
    //         ->get();

    //     return $listSanPham;
    // }

    // Cách 3: Sử dụng Eloquent
    protected $table = 'san_phams';

    protected $fillable = [
        'ma_san_pham',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'mo_ta',
        'trang_thai',
    ];
}

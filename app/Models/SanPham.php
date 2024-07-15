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
    public function getList()
    {
        $listSanPham = DB::table('san_phams')
            ->orderByDesc('id')
            ->get();

        return $listSanPham;
    }

    public function createProduct($datas) {
        DB::table('san_phams')->insert($datas);
    }

    public function getDetailProduct($id) {
        $san_pham = DB::table('san_phams')->where('id', $id)->first();

        return $san_pham;
    }

    // Cách 3: Sử dụng Eloquent
    protected $table = 'san_phams';

    protected $fillable = [
        'hinh_anh',
        'ma_san_pham',
        'ten_san_pham',
        'gia',
        'so_luong',
        'ngay_nhap',
        'mo_ta',
        'trang_thai',
    ];
}

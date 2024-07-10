<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SanPham extends Model
{
    use HasFactory;

    // Cách 1: Sử dụng Raw Query (SQL thuần)
    public function getList() {
        $listSanPham = DB::select('SELECT * FROM san_phams ORDER BY id DESC');

        return $listSanPham;
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SanPhamController extends Controller
{
    // Nơi viết các hàm xử lý công việc
    public function index() {
        // dd("Đây là SanPhamController");
        $title = "Danh sách sản phẩm";
        $sanPhams = DB::table('san_phams')->get();
        return view('sanpham.index', [
                    'title' => $title, 
                    'san_phams' => $sanPhams
                ]);
    }
}

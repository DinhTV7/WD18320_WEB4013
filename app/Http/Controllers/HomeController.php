<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        // dd(12345);
        // $title = "Trang chủ";
        // return view('clients.index', [
        //     'title' => $title
        // ]);

        $data = [];
        $data['title'] = "Trang chủ";
        $data['content'] = "Đây là trang chủ";
        $data['text'] = "<u>Lớp WD18320</u>";
        $data['dataArr'] = [
            'Item 1',
            'Item 2',
            'Item 3',
        ];
        return view('clients.index', $data);
    }
}

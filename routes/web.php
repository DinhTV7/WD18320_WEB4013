<?php

use App\Http\Controllers\Admins\SanPhamController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Tạo route để trỏ đến view
// Route::get('/hello', function () {
//     return view('xinchao');
// });

// Route::view('/hello', 'xinchao');

// Truyền dữ liệu sang view
// Route::get('/hello', function () {
//     $title = "Thầy Định đẹp trai";
//     $text = "Đẹp trai nhất Fpoly";
//     return view('xinchao', ['title' => $title, 'text' => $text]);
// });

// Route::view('/hello', 'xinchao', [
//     'title' => 'Hihi xin chào',
//     'text' => 'Xin chào bây by!'
// ]);

// Tạo 1 route để trỏ đến hàm trong controller
Route::get('/home', [HomeController::class, 'index']);

// Route resource
Route::get('sanpham/test', [SanPhamController::class, 'test'])->name('sanpham.test');
Route::resource('sanpham', SanPhamController::class);
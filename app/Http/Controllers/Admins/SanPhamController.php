<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\SanPham;
use Illuminate\Http\Request;

class SanPhamController extends Controller
{
    // Sử dụng cho 2 cách Raw Query và Query Builder
    public $san_phams;

    public function __construct()
    {
        $this->san_phams = new SanPham();   
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Sử dụng cho 2 cách Raw Query và Query Builder
        // Lấy dữ liệu
        // $listSanPham = $this->san_phams->getList();

        // Sử Eloquent
        $listSanPham = SanPham::orderByDesc('id')->get();

        $title = "Danh sách sản phẩm";
        return view('admins.sanpham.index', compact('title', 'listSanPham'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Thêm sản phẩm";

        return view('admins.sanpham.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Kiểm tra dữ liệu
        // dd($request->post());

        if ($request->isMethod('POST')) {
            // Lấy ra dữ liệu
            // Vì có trường '_token' do csrf sinh ra
            // nên trước khi gửi dữ liệu ta cần loại bỏ _token
            // Cách 1: 
            // $params = $request->post();
            // unset($params['_token']);

            // Cách 2:
            $params = $request->except('_token');

            // Xử lý ảnh
            if ($request->hasFile('img_san_pham')) {
                $filename = $request->file('img_san_pham')->store('uploads/sanpham', 'public');
            } else {
                $filename = null;
            } 

            $params['hinh_anh'] = $filename;

            // Thêm dữ liệu
            // Sử dụng Query Builder
            // $this->san_phams->createProduct($params);

            // Sử dụng Eloquent
            SanPham::create($params);

            // Sau khi thêm thành công sẽ quay trở về trang danh sách
            // Và hiển thị thông báo
            return redirect()->route('sanpham.index')->with('success', 'Thêm sản phẩm thành công!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Chỉnh sửa sản phẩm";

        // Lấy thông tin chi tiết
        // Sửa dụng Query Builder
        $sanPham = $this->san_phams->getDetailProduct($id);

        // Sử dụng Eloquent
        // $sanPham = SanPham::findOrFail($id);

        if (!$sanPham) {
            return redirect()->route('sanpham.index')->with('error', 'Sản phẩm không tồn tại');
        }

        return view('admins.sanpham.update', compact('title', 'sanPham'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // Viết một phương thức mới
    public function test() {
        dd("Đây là một hàm mới");
    }
}

<?php

namespace App\Http\Controllers\Admins;

use App\Models\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SanPhamRequest;
use App\Mail\MailConfirm;
use Illuminate\Support\Facades\Storage;

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
    public function index(Request $request)
    {
        // Sử dụng cho 2 cách Raw Query và Query Builder
        // Lấy dữ liệu
        // $listSanPham = $this->san_phams->getList();

        // Lấy dữ liệu từ form tìm kiếm
        $search = $request->input('search');
        $searchTrangThai = $request->input('searchTrangThai');

        // Sử Eloquent
        $listSanPham = SanPham::query()
            ->when($search, function ($query, $search) {
                return $query->where('ma_san_pham', 'like', "%{$search}%")
                    ->orWhere('ten_san_pham', 'like', "%{$search}%");
            })
            ->when($searchTrangThai !== null, function ($query) use ($searchTrangThai) {
                return $query->where('trang_thai', '=', $searchTrangThai);
            })
            ->orderByDesc('id')->paginate(3);

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
    public function store(SanPhamRequest $request)
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
            $sanPham = SanPham::create($params);

            // Gửi mail thông tin sản phẩm về email
            $email_nguoi_nhan = 'dinhtv7@fpt.edu.vn';
            Mail::to($email_nguoi_nhan)->send(new MailConfirm($sanPham));


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
    public function update(SanPhamRequest $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $sanPham = SanPham::findOrFail($id);

            // Xử lý hình ảnh
            if ($request->hasFile('img_san_pham')) {
                // Nếu có đẩy hình ảnh thì xóa hình cũ và thêm hình mới
                if ($sanPham->hinh_anh) {
                    // Nếu sản phẩm có ảnh cũ thì mới tiến hành xóa
                    Storage::disk('public')->delete($sanPham->hinh_anh);
                }

                $params['hinh_anh'] = $request->file('img_san_pham')->store('uploads/sanpham', 'public');
            } else {
                // Nếu ko có hình ảnh thì lấy lại hình ảnh cũ
                $params['hinh_anh'] = $sanPham->hinh_anh;
            }

            // Cập nhật dữ liệu
            // Eloquent
            $sanPham->update($params);

            return redirect()->route('sanpham.index')->with('success', 'Cập nhật sản phẩm thành công!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        if ($request->isMethod('DELETE')) {
            // Sử dụng Query Builder
            // Lấy thông tin về sản phẩm để nếu xòa thì xóa ảnh
            // $sanPham = $this->san_phams->getDetailProduct($id);

            // Sử dụng Eloquent
            $sanPham = SanPham::findOrFail($id);

            if ($sanPham) {
                // Sử dụng Query Builder
                // $this->san_phams->deleteProduct($id);

                // Sử dụng Eloquent
                $sanPham->delete();

                // Xóa hình ảnh (Nếu xóa mềm thì không xóa hình ảnh)
                // if ($sanPham->hinh_anh && Storage::disk('public')->exists($sanPham->hinh_anh)) {
                //     Storage::disk('public')->delete($sanPham->hinh_anh);
                // }

                return redirect()->route('sanpham.index')->with('success', 'Xóa sản phẩm thành công!');
            }

            return redirect()->route('sanpham.index')->with('error', 'Không có sản phẩm!');
        }

        // Khi xóa mềm sẽ sử dụng eloquent (Xóa mềm thì không được xóa ảnh)
        // Một số hàm cần nhớ khi làm việc với xóa mềm
        // Hàm hiển thị toàn bộ các sản phẩm đã xóa mềm
        // $listSanPhamDaXoa = SanPham::query()->onlyTrashed()->get();

        // Hàm restore sản phẩm đã xóa
        // $sanPham->restore();

        // Hàm xóa vĩnh viễn sản phẩm đã xóa mềm (Khi làm chức năng này mới được xóa ảnh)
        // $sanPham->forceDelete();
    }

    // Viết một phương thức mới
    public function test()
    {
        dd("Đây là một hàm mới");
    }
}

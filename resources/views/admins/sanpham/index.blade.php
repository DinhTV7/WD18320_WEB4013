{{-- extends dùng đề kế thừa Layout --}}
@extends('layouts.admin')

@section('title')
    {{ $title }}
@endsection

@section('css')
@endsection

@section('content')
    <div class="card">
        <h4 class="card-header">{{ $title }}</h4>
        <div class="card-body">
            <div class="d-flex justify-content-between">
                <a href="{{ route('sanpham.create') }}" class="btn btn-success">Thêm sản phẩm</a>
                <form action="{{ route('sanpham.index') }}" method="GET">
                    <div class="input-group">
                        <select name="searchTrangThai" class="form-select">
                            <option value="" selected>Chọn trạng thái</option>
                            <option value="1" {{ request('searchTrangThai') == '1' ? 'selected' : '' }}>Hiển thị</option>
                            <option value="0" {{ request('searchTrangThai') == '0' ? 'selected' : '' }}>Ẩn</option>
                        </select>
                        <input type="text" name="search" class="form-control"
                            value="{{ request('search') }}" placeholder="Tìm kiếm.....">
                        <button type="submit" class="btn btn-secondary">Tìm kiếm</button>
                    </div>
                </form>
            </div>
            {{-- Hiển thị thông báo --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            
            <table class="table">
                <thead>
                    <th>STT</th>
                    <th>Mã sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Số lượng</th>
                    <th>Ngày nhập</th>
                    <th>Mô tả</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </thead>
                <tbody>
                    @foreach ($listSanPham as $index => $sanPham)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $sanPham->ma_san_pham }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $sanPham->hinh_anh) }}" alt="Hình ảnh sản phẩm" width="150px">
                            </td>
                            <td>{{ $sanPham->ten_san_pham }}</td>
                            <td>{{ $sanPham->gia }}</td>
                            <td>{{ $sanPham->so_luong }}</td>
                            <td>{{ $sanPham->ngay_nhap }}</td>
                            <td>{{ $sanPham->mo_ta }}</td>
                            <td>{{ $sanPham->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                            <td>
                                <a href="{{ route('sanpham.edit', $sanPham->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('sanpham.destroy', $sanPham->id) }}" 
                                    class="d-inline" method="POST" onsubmit="return confirm('Bạn có đồng ý xóa không?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- Hiển thị phân trang --}}
            {{ $listSanPham->links('pagination::bootstrap-5') }}
        </div>
    </div>
@endsection

@section('js')
@endsection

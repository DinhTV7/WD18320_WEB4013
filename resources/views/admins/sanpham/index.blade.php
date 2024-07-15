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
            <a href="{{ route('sanpham.create') }}" class="btn btn-success">Thêm sản phẩm</a>
            
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
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
@endsection

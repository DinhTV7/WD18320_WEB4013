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
        <table class="table">
            <thead>
                <th>STT</th>
                <th>Mã sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Ngày nhập</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
            </thead>
            <tbody>
                @foreach ($listSanPham as $index => $sanPham)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $sanPham->ma_san_pham }}</td>
                        <td>{{ $sanPham->ten_san_pham }}</td>
                        <td>{{ $sanPham->gia }}</td>
                        <td>{{ $sanPham->so_luong }}</td>
                        <td>{{ $sanPham->ngay_nhap }}</td>
                        <td>{{ $sanPham->mo_ta }}</td>
                        <td>{{ $sanPham->trang_thai == 1 ? 'Hiển thị' : 'Ẩn' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('js')

@endsection

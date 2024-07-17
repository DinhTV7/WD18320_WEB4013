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
            <form action="{{ route('sanpham.update', $sanPham->id) }}" method="POST" enctype="multipart/form-data">
                {{-- LÀM VIỆC VỚI FORM TRONG LARAVEL --}}
                {{-- 
                    CSRF Field: Là một trường bắt buộc phải có trong Form khi sử dụng Laravel
                --}}
                @csrf

                @method('PUT')

                <div class="mb-3">
                    <label for="" class="form-label">Mã sản phẩm:</label>
                    <input type="text" class="form-control @error('ma_san_pham') is-invalid @enderror" name="ma_san_pham"
                        placeholder="Nhập mã sản phẩm" value="{{ $sanPham->ma_san_pham }}">
                    @error('ma_san_pham')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Tên sản phẩm:</label>
                    <input type="text" class="form-control @error('ten_san_pham') is-invalid @enderror"
                        name="ten_san_pham" placeholder="Nhập tên sản phẩm" value="{{ $sanPham->ten_san_pham }}">
                    @error('ten_san_pham')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Giá sản phẩm:</label>
                    <input type="number" class="form-control @error('gia') is-invalid @enderror" name="gia"
                        min="1" placeholder="Nhập giá sản phẩm" value="{{ $sanPham->gia }}">
                    @error('gia')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Số lượng:</label>
                    <input type="text" class="form-control @error('so_luong') is-invalid @enderror" name="so_luong"
                        placeholder="Nhập số lượng sản phẩm" value="{{ $sanPham->so_luong }}">
                    @error('so_luong')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Ngày nhập:</label>
                    <input type="date" class="form-control @error('ngay_nhap') is-invalid @enderror" name="ngay_nhap"
                        value="{{ $sanPham->ngay_nhap }}">
                    @error('ngay_nhap')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Mô tả:</label>
                    <textarea name="mo_ta" cols="30" rows="3" class="form-control" placeholder="Nhập mô tả sản phẩm">{{ $sanPham->mo_ta }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Trạng thái:</label>
                    <select name="trang_thai" class="form-select @error('trang_thai') is-invalid @enderror">
                        <option selected>Chọn trạng thái</option>
                        <option value="0" {{ $sanPham->trang_thai == '0' ? 'selected' : '' }}>Ẩn</option>
                        <option value="1" {{ $sanPham->trang_thai == '1' ? 'selected' : '' }}>Hiển thị</option>
                    </select>
                    @error('trang_thai')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="" class="form-label">Hình ảnh:</label>
                    <input type="file" class="form-control" name="img_san_pham" onchange="showImage(event)">
                </div>

                <img id="img_product" src="{{ Storage::url($sanPham->hinh_anh) }}" alt="Hình ảnh sản phẩm"
                    style="width: 200px">

                <div class="mb-3 d-flex justify-content-center">
                    <button type="reset" class="btn btn-outline-secondary me-3">Nhập lại</button>
                    <button type="submit" class="btn btn-warning">Chỉnh sửa</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        function showImage(event) {
            const img_product = document.getElementById('img_product');

            const file = event.target.files[0];

            const reader = new FileReader();

            reader.onload = function() {
                img_product.src = reader.result;
                img_product.style.display = 'block';
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

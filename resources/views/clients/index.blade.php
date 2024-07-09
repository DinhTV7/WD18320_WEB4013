{{-- extends: quy định master layout kế thừa --}}
@extends('layouts.client')

@section('title')
    {{-- Hiển thị dữ liệu trong blade --}}
    {{ $title }}
@endsection

@section('css')
    {{-- Nơi để các đường dẫn file CSS và thư viện CSS 
        dùng riêng cho trang --}}
    <style>
        /* .content {
                background-color: aqua;
            } */
    </style>

    {{-- Hàm asset() dùng để trỏ đường dẫn trong Laravel --}}
    <link rel="stylesheet" href="{{ asset('assets/clients/css/index.css') }}">
@endsection

{{-- section: dùng để định nghĩa nội dung của section --}}
@section('content')
    <h1 class="text-danger">Đây là trang Client</h1>
    <p>Chào mừng đến với bình nguyên vô tận</p>
    <button class="btn btn-success" onclick="onSubmit()">Submit</button>

    <h1>{{ $content }}</h1>

    {{-- Hiển thị phiên dịch mã HTML --}}
    <h1>{!! $text !!}</h1>

    {{-- Viết mã PHP --}}
    @php
        $flag = true;
    @endphp

    {{-- Vòng lặp for --}}
    @for ($i = 1; $i <= 3; $i++)
        <p>Index: {{ $i }}</p>
    @endfor

    {{-- Vòng lặp foreach --}}
    @foreach ($dataArr as $item)
        <p>Phần tử: {{ $item }}</p>
    @endforeach

    {{-- Vòng lặp forelse --}}
    @forelse ($dataArr as $item)
        <p>Phần tử: {{ $item }}</p>
    @empty
        <p>Không có phần tử nào trong mảng</p>
    @endforelse

    {{-- while; if; if-else; if-elseif; switch_case --}}
@endsection

@section('js')
    {{-- Nơi để các đường dẫn file JS và thư viện JS 
        dùng riêng cho trang --}}
    <script>
        function onSubmit() {
            alert(12345);
        }
    </script>
    <script src=""></script>
@endsection

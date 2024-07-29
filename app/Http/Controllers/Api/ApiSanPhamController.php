<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SanPhamResorce;
use App\Models\SanPham;
use Illuminate\Http\Request;

class ApiSanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $searchTrangThai = $request->input('searchTrangThai');

        $sanPhams = SanPham::query()->when($search, function ($query, $search) {
            return $query->where('ma_san_pham', 'like', "%{$search}%")
                ->orWhere('ten_san_pham', 'like', "%{$search}%");
        })
            ->when($searchTrangThai !== null, function ($query) use ($searchTrangThai) {
                return $query->where('trang_thai', '=', $searchTrangThai);
            })
            ->orderByDesc('id')->paginate(3);
        return SanPhamResorce::collection($sanPhams);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $sanPham = SanPham::query()->findOrFail($id);
        return new SanPhamResorce($sanPham);
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
}

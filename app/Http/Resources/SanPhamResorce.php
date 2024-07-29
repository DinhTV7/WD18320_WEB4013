<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SanPhamResorce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        // Cấu hình dữ liệu trả về
        return [
            'san_pham_id' => $this->id,
            'name_san_pham' => $this->ten_san_pham,
            'price' => $this->gia,
        ];
    }
}

<?php

namespace App\Http\Resources\Products;

use App\Http\Resources\Categories\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            "id"          => $this->id,
            "title"       => $this->title,
            "description" => $this->description,
            "price"       => $this->price,
            "imageUrl"    => $this->image_url,
            "publishedAt" => $this->published_at,
            "categories"  => CategoryResource::collection($this->whenLoaded("categories")),
        ];
    }
}

<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' =>  $this->id,
            'name' =>  $this->name,
            'reference' => $this->reference,
            'price' => $this->price,
            'description' => $this->description,
            'categoryId' => $this->category_id,
            'subCategoryId' => $this->sub_category_id,
            'createdAt' => $this->created_at,
            'category' => new ProductCategoryResource($this->whenLoaded('category')),
            'subCategory' => new ProductCategoryResource($this->whenLoaded('subCategory')),
            'images' => ProductImageResource::collection($this->images)
        ];
    }
}

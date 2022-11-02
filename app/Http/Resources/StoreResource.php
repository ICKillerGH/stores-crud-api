<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
            'phoneNumber' => $this->phone_number,
            'email' => $this->email,
            'location' => $this->location,
            'imagePath' => $this->image_path,
            'storeReviews' => $this->storeReviews,
            'storeReviewsCount' => $this->storeReviews->count(),
            'createdAt' => $this->created_at
        ];
    }
}

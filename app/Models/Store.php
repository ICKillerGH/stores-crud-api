<?php

namespace App\Models;

use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Grimzy\LaravelMysqlSpatial\Eloquent\SpatialTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory, SpatialTrait;

    protected $spatialFields = ['location'];

    /**
     * Relationships
     */
    public function storeReviews()
    {
        return $this->hasMany(StoreReview::class);
    }

    /**
     * Mutators
     */
    public function setImageAttribute($image)
    {
        $this->attributes['image_path'] = $image instanceof UploadedFile
            ? $image->store('public/stores')
            : $image;
    }

    /**
     * Accessors
     */
    public function getImagePathAttribute($value)
    {
        return $value ? Storage::url($value) : null;
    }

    public function getLocationAttribute($value)
    {
        return [
            'lat' => $value->getLat(),
            'lng' => $value->getLng(),
        ];
    }
}

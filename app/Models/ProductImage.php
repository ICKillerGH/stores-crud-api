<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * Relations
     */

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Accessors
     */
    public function getPathAttribute($value)
    {
        return Storage::url($value);
    }

    public function getRawPathAttribute()
    {
        return $this->attributes['path'];
    }
}

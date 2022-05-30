<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'store_id'
    ];

    /**
     * Relationships
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreReviewRequest;
use App\Models\StoreReview;

class StoreReviewsController extends Controller
{
    public function store(StoreStoreReviewRequest $request)
    {
        $storeReview = StoreReview::create([
            'content' => $request->content,
            'store_id' => $request->store_id
        ]);

        return $storeReview;
    }

    public function count()
    {
        return [
            'count' => StoreReview::count(),
        ];
    }
}

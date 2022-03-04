<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStoreReviewRequest;
use App\Models\StoreReview;

class StoreReviewsController extends Controller
{
    public function store(StoreStoreReviewRequest $request)
    {
        $storeReview = StoreReview::create($request->validated());

        return $storeReview;
    }
}

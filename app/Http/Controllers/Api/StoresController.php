<?php

namespace App\Http\Controllers\Api;

use App\Models\Store;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStoreRequest;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Response;

class StoresController extends Controller
{
    public function index(Request $request)
    {
        $stores = Store::query()
            ->with('storeReviews')
            ->withCount('storeReviews')
            ->paginate($request->query('per_page', 10));

        return $stores;
    }

    public function store(StoreStoreRequest $request)
    {
        $store = Store::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'image' => $request->image,
            'location' => new Point($request->latitude, $request->longitude)
        ]);

        $store->save();

        return $store;
    }

    public function show(Store $store)
    {
        $store->load('storeReviews')->loadCount('storeReviews');

        return $store;
    }

    public function update(StoreStoreRequest $request, Store $store)
    {
        $store->name = $request->name;
        $store->email = $request->email;
        $store->address = $request->address;
        $store->phone_number = $request->phone_number;
        $store->location = new Point($request->latitude, $request->longitude);

        if ($request->image) {
            $store->image = $request->image;
        }

        $store->save();

        return $store;
    }

    public function destroy(Store $store)
    {
        $store->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductImageResource;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['category', 'subCategory'])
            ->when($request->name, fn ($query, $name) => $query->where('name', 'LIKE', "%$name%"))
            ->when($request->reference, fn ($query, $reference) => $query->where('reference', 'LIKE', "%$reference%"))
            ->when($request->exceptId, fn ($query, $productId) => $query->where('id', '!=', $productId))
            ->when($request->price, fn ($query, $price) => $query->where('price', $price))
            ->when($request->categoryId, fn ($query, $categoryId) => $query->whereRelation('category', 'id', $categoryId))
            ->when($request->subCategoryId, fn ($query, $subCategoryId) => $query->whereRelation('subCategory', 'id', $subCategoryId))
            ->orderBy('created_at', 'DESC')
            ->paginate($request->query('perPage'));

        return ProductResource::collection($products);
    }

    public function store(StoreProductRequest $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->categoryId;
        $product->sub_category_id = $request->subCategoryId;

        $product->save();

        $imagesData = collect($request->images)->values()->map(fn ($item) => [
            'path' => $item->store("public/product-images/")
        ]);

        $product->images()->createMany($imagesData);

        return new ProductResource($product);
    }

    public function show(Product $product)
    {
        $product->load(['category', 'subCategory']);

        return new ProductResource($product);
    }

    public function update(StoreProductRequest $request, Product $product)
    {
        $product->name = $request->name;
        $product->reference = $request->reference;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->categoryId;
        $product->sub_category_id = $request->subCategoryId;

        $product->save();

        if ($request->images) {
            $imagesData = collect($request->images)->values()->map(fn ($item, $i) => [
                'path' => $item->store("public/product-images/")
            ]);

            $product->images()->createMany($imagesData);
        }

        return new ProductResource($product);
    }

    public function createImage(StoreProductImageRequest $request, Product $product)
    {
        $image = new ProductImage();

        $image->path = $request->image->store("public/product-images");

        $image->product_id = $product->id;

        $image->save();

        return new ProductImageResource($image);
    }

    public function deleteImage(Product $product, $id)
    {
        $image = ProductImage::findOrFail($id);

        $image->delete();

        Storage::delete($image->raw_path);

        return response()->json([
            'success' => true,
            'message' => 'la imagen se ha eliminado exitosamente.'
        ]);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}

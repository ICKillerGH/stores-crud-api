<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductCategoryRequest;
use App\Http\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsCategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = ProductCategory::query()
            ->with(['parentCategory'])
            ->when($request->name, fn ($query, $name) => $query->where('name', 'LIKE', "%$name%"))
            ->when($request->parentsOnly === 'true', fn ($query) => $query->whereNull('parent_id'))
            ->when($request->parentId, fn ($query, $parentId) => $query->where('parent_id', $parentId))
            ->paginate($request->query('perPage', 10));

        return ProductCategoryResource::collection($categories);
    }

    public function store(StoreProductCategoryRequest $request)
    {
        $category = new ProductCategory();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parentId;
        $category->save();

        return new ProductCategoryResource($category);
    }

    public function show(ProductCategory $category)
    {
        $category->load(['parentCategory']);

        return new ProductCategoryResource($category);
    }

    public function update(StoreProductCategoryRequest $request, ProductCategory $category)
    {
        $category->name = $request->name;
        $category->description = $request->description;
        $category->parent_id = $request->parentId;
        $category->save();

        return new ProductCategoryResource($category);
    }

    public function destroy(ProductCategory $category)
    {
        $category->delete();

        return response()->json('', Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|max:255',
            'reference' => [
                'required',
                'max:255'
            ],
            'price' => 'required|numeric|min:0',
            'images.*' => 'required|image',
            'images' => [
                Rule::requiredIf(!$this->product),
                'array',
                'min:1'
            ],
            'description' => 'required|max:3000',
            'categoryId' => 'nullable|exists:product_categories,id',
            'subCategoryId' => [
                'nullable',
                Rule::exists('product_categories', 'id')->where('parent_id', $this->categoryId),
            ]
        ];
    }
}

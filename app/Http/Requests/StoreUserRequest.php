<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            'email' => [
                'required',
                $this->user ? Rule::unique('users')->ignore($this->user->id) : Rule::unique('users'),
            ],
            'password' => [
                Rule::requiredIf(!$this->user),
                'min:6',
            ],
        ];
    }
}

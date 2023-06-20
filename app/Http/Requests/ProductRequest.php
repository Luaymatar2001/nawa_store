<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $product = $this->route('product', 0);
        $id = $product ? $product->id : 0;

        return
            [
                'name' => 'required|string|max:255|min:3',
                'slug' => "required|unique:products,slug,{$id}",
                'description' => 'nullable|string',
                'short_description' => 'nullable|string|max:500',
                'price' => 'required|min:0',
                // 'compare_price' => 'nullable|gt:products,price',
                // 'image' => 'required|file|mimetypes:image/png,image/jpg,image/bmp|max:1024',
                'image' => 'nullable|image|mimes:png,jpg,bmp|max:2024',
                'status' => 'required|in:draft,active,archived',
                'category_id' => 'required|exists:categories,id',
            ];
    }
    public function message()
    {
        return
            [
                'required' => 'the :attribute is required',
                'email' => 'the :attribute must contain @',
                'image.required' => 'The image field is required.',
                'image.image' => 'The image field must be a file.',
                'image.mimes' => 'The image field must be in PNG, JPG, or BMP format.',
                'image.max' => 'The image field must not exceed 1MB in size.',                'name.max' => 'the max character in :attribute is 255',
                'name.min' => 'the min character in :attribute 3',
                'price.min' => 'the min price in :attribute 0',

            ];
    }
}

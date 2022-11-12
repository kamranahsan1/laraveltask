<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name'      => 'required|string',
            'sku'       => 'required|unique:products,sku,'.$this->id,
            'price'     => 'required|numeric',
            'image'     => 'mimes:jpeg,jpg,png,gif|max:10000',
            'status'    => 'required|numeric|in:1,0'
        ];
    }
}

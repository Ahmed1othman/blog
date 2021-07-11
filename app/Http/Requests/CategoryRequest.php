<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'name' => 'required|min:3|string:255|unique:categories,name,'.$this->id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> "name is required",
            'name.min'=> "name at least 3 characters",
            'name.string'=> "name must be string",
            'name.unique'=> "category is already exists",
            'admin_id.required'=>"you not have permission to add category",
        ];
    }
}

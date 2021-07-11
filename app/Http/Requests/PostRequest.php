<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'post_title' => 'required|min:3|string:255',
            'category_id' => 'required|exists:categories,id',
            'post_body' => 'required|max:999',
            'photo' => 'nullable|image|mimes:jpg,bmp,png',

        ];
    }

    public function messages()
    {
        return [
//            'post_title.required'=> "name is required",
//            'post_title.min'=> "name at least 3 characters",
//            'post_title.string'=> "name must be string",
//            'post_body.required'=> "category is already exists",
//            'photo'=>"please select photo file",
        ];
    }
}

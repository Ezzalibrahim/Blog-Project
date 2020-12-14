<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRaquest extends FormRequest
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
            'title' => 'required|unique:posts|max:255|min:6',
            'description' => 'required|min:6',
            'content' => 'required|min:6',
            'image' => 'required|image',
            'category_id' => 'required'
        ];
    }
}

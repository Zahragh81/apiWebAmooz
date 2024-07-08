<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return false;
    }


    public function rules(): array
    {
        if (request()->isMethod('POST')){
        return [
            'title' => 'required|string',
            'slug' => 'required|string',
            'image' => 'required|image',
            'content' => 'required|string',
            'user_id' => 'required'
        ];
        }
        else{
            return [
                'title' => 'required|string',
                'slug' => 'required|string',
                'image' => 'image',
                'content' => 'required|string',
                'user_id' => 'required'
            ];
        }
    }
}

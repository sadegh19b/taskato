<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:64'],
            'is_group' => ['boolean'],
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

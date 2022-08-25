<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompletedTodosDestroyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'category_id' => ['required', 'numeric', 'exists:categories,id']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

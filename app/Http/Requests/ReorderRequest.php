<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReorderRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'reorder' => ['required', 'array']
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

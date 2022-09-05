<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryStoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'max:64'],
            'parent_id' => ['nullable', 'numeric', 'exists:categories,id'],
            'is_group' => [
                'boolean',
                Rule::when(!is_null($this->parent_id), [function ($attribute, $value, $fail) {
                    if ($value !== false) {
                        $fail(__(
                            'The :attribute field must be false when you add a new category to the group.',
                            [':attribute', $attribute]
                        ));
                    }
                }]),
            ],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

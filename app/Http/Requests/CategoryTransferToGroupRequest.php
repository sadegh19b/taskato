<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryTransferToGroupRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'group_id' => ['required', 'numeric', 'exists:categories,id']
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $_category = Category::find($this->input('group_id'));

            if (!$_category->is_group) {
                $validator->errors()->add('group_id', __('The category must be a group.'));
            }

            if ($_category->children()->whereId($this->category->id)->exists()) {
                $validator->errors()->add('group_id', __('The category should not already be in the group.'));
            }
        });
    }

    public function authorize(): bool
    {
        return true;
    }
}

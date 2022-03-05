<?php

namespace App\Http\Requests\Posts;

use App\Constants\PostConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SortPostsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'sort_by' => [
                'bail', 'nullable', 'string', Rule::in(array_keys(PostConstants::SORT_PARAMS))
            ],
            'direction' => [
                'bail', 'nullable', 'string', Rule::in(array_keys(PostConstants::SORT_DIRECTIONS))
            ]
        ];
    }
}

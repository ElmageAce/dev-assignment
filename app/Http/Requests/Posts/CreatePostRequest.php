<?php

namespace App\Http\Requests\Posts;

use Illuminate\Foundation\Http\FormRequest;

class CreatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    final public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    final protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => slugger($this->title ?? '', uniqid()),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    final public function rules(): array
    {
        return [
            'title' => 'bail|required|string|max:200',
            'description' => 'bail|required|string|max:5000',
            'publication_date' => 'bail|required|string|date|after_or_equal:now',
            'slug' => 'bail|required|string|unique:posts,slug',
        ];
    }
}

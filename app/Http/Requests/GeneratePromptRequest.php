<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneratePromptRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['required', 
                        'image', 
                        'max:10240', // Max size 1MB
                        'file', 'mimes:png,jpg,gif,jpeg',
                        'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
                        ], 
        ];
    }

    public function messages(): array
    {
        return [
            'image.required' => 'An image file is required.',
            'image.image' => 'The uploaded file must be an image.',
            'image.max' => 'The image size must not exceed 10MB.',
            'image.file' => 'The uploaded file must be a valid file.',
            'image.mimes' => 'The image must be a file of type: png, jpg, gif, jpeg.',
            'image.dimensions' => 'The image dimensions are invalid. Minimum size is 100x100 pixels and maximum size is 1000x1000 pixels.',
        ];
    }
}

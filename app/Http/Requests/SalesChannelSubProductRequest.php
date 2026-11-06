<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SalesChannelSubProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'sub_product_id' => ['required', 'integer'],
            'sales_channel_id' => ['required', 'integer', 'exists:sales_channels,id'],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'sub_product_id.required' => 'The sub product field is required.',
            'sub_product_id.exists' => 'The selected sub product does not exist.',
            'sales_channel_id.required' => 'The sales channel field is required.',
            'sales_channel_id.exists' => 'The selected sales channel does not exist.',
        ];
    }
}


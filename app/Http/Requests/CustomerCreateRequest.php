<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerCreateRequest extends FormRequest
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
        $rules = [
            'first_name' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'country_id' => ['required'],
            'phone_number' => ['required', 'string', 'max:15'],
            'address' => ['required', 'string', 'max:100'],
            'city' => ['required', 'string', 'max:50'],
            'postal_code' => ['required', 'string'],
        ];
        if (auth()->user()->hasAnyRole(['super_admin', 'admin'])) {
            $rules['inventory_id'] = 'required';
        }
        return $rules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'inventory_id.required' => 'The inventory type is required.',
            'first_name.required' => 'The first name is required.',
            'first_name.max' => 'The first name may not be greater than 30 characters.',
            'email.required' => 'The email address field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.max' => 'The email address may not be greater than 255 characters.',
            'email.unique' => 'This email address is already registered.',
            'country_id.required' => 'The country is required.',
            'phone_number.required' => 'The phone number is required.',
            'phone_number.max' => 'The phone number may not be greater than 15 characters.',
            'address.required' => 'The address is required.',
            'address.max' => 'The address may not be greater than 100 characters.',
            'city.required' => 'The city is required.',
            'postal_code.required' => 'The postal code is required.',
        ];
    }
}

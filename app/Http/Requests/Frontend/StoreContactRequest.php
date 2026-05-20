<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'                   => 'required|string|max:120',
            'email'                  => 'required|email|max:200',
            'phone'                  => 'nullable|string|regex:/^[+\d\s\-()]{7,20}$/',
            'company'                => 'nullable|string|max:150',
            'subject'                => 'nullable|string|max:200',
            'message'                => 'required|string|min:10|max:2000',
            'g-recaptcha-response'   => 'required|captcha',
        ];
    }

    public function messages(): array
    {
        return [
            'g-recaptcha-response.required' => 'Please verify that you are not a robot.',
            'g-recaptcha-response.captcha'  => 'reCAPTCHA verification failed. Please try again.',
        ];
    }
}

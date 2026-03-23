<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:30',
            'company' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:5000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Укажите ваше имя',
            'email.required'   => 'Укажите email',
            'email.email'      => 'Некорректный формат email',
            'message.required' => 'Напишите сообщение',
            'message.max'      => 'Сообщение слишком длинное (макс. 5000 символов)',
        ];
    }
}

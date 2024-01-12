<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Activity_request extends FormRequest
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
            'name'     => 'required|string|max:255',
            'deadline' => 'required|string|max:255',
            'isDone' => 'required|boolean',
            'user_id'  => 'required|integer',
            'sub_id'   => 'required|integer',
        ];
    }
}

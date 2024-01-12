<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class webinarRequest extends FormRequest
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
            'name'      => 'required|string|max:255',
            'link'      => 'required|string|max:255',
            'sched'     => 'required|string|max:255',
            'user_id'   => 'required|integer',
            'sub_id'    => 'required|integer',
            'type_id'   => 'required|integer',
        ];
    }
}

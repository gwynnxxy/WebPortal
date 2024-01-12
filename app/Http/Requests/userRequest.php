<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
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
        if (request()->routeIs('user.login')) {
            return [
                'email'     =>  'required|string|email|max:255',
                'password'  =>  'required|min:8',
            ];
        } else if (request()->routeIs('user.store')) {
            return [
                'first_name'     =>  'required|string|max:255',
                'last_name'      =>  'required|string|max:255',
                'email'          =>  ['required', Rule::unique('users')],
                'password'       =>  'required|min:8',
            ];
        } else if (request()->routeIs('user.name')) {
            return [
                'first_name'     =>  'required|string|max:255',
                'last_name'      =>  'required|string|max:255',
            ];
        } else if (request()->routeIs('user.email')) {
            return [
                'email'     =>  'required|string|email|unique:App\Models\User|max:255',
            ];
        } else if (request()->routeIs('user.password')) {
            return [
                'password'  =>  'required|min:8',
            ];
        }

        // Default return statement, return an empty array if no conditions match
        return [];;
    }
}

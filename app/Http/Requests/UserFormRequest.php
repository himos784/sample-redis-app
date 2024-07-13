<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        $isPutMethod = request()->isMethod('PUT');
        $uniqueEmailRule = Rule::unique('users', 'email');

        $rules = [
            'name' => ['required'],
            'email' => ['required', 'email', $uniqueEmailRule],
        ];

        // Make password required
        if(
            request()->isMethod('POST') ||
            ($isPutMethod && !empty(request()->get('password')))
        ) {
            $rules['password'] = ['required'];
        }

        if($isPutMethod) {
            $rules['email'][2] = $uniqueEmailRule->ignore(request()->id);
        }
        \Log::info($rules);
        return $rules;
    }
}

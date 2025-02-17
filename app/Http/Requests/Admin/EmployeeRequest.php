<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'date_of_birth' => 'required|date',
            'join_date' => 'required|date',
            'designation' => 'required',
            'branch_id' => 'required',
            'department_id' => 'required',
            'shift_id' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'branch_id.required' => 'Please select the branch.',
            'department_id.required' => 'Please select the department.',
            'shift_id.required' => 'Please select the shift.',
        ];
    }
}

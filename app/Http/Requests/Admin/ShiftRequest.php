<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShiftRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i',
            'department_id' => [
                'required',
                Rule::unique('shifts', 'department_id')->ignore($this->route('shift')->id ?? null),
            ],
        ];
    }

    public function messages()
    {
        return [
            'department_id.unique' => 'This department is already assign to previous shifts.',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $startTime = strtotime($this->input('start_time'));
            $endTime = strtotime($this->input('end_time'));

            if ($endTime <= $startTime) {
                $validator->errors()->add('end_time', 'The End time must be greater than the start time.');
            }
        });
    }
}

<?php

namespace App\Http\Requests;

use App\Enums\EducationLevel;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEnrollmentRequest extends FormRequest
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
            'student_name' => ['required', 'string', 'max:200'],
            'birth_date' => ['required', 'date', 'before:today'],
            'parent_name' => ['required', 'string', 'max:200'],
            'parent_email' => ['required', 'email', 'max:320'],
            'parent_phone' => ['required', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'course_id' => ['nullable', 'exists:courses,id'],
            'level' => ['required', Rule::in(EducationLevel::values())],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'student_name' => 'nome do aluno',
            'birth_date' => 'data de nascimento',
            'parent_name' => 'nome do responsável',
            'parent_email' => 'e-mail do responsável',
            'parent_phone' => 'telefone do responsável',
            'address' => 'endereço',
            'course_id' => 'curso',
            'level' => 'nível educacional',
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
            'birth_date.before' => 'A data de nascimento deve ser anterior a hoje.',
            'parent_email.email' => 'O e-mail do responsável deve ser válido.',
        ];
    }
}

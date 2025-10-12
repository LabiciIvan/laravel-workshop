<?php

namespace App\Http\Requests;

class JobStoreRequest extends BaseJob
{
    protected array $attributesData = [
        'name'       => 'title',
        'salary'     => null,
        'employer'   => 'employer_id',
    ];

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
            'name'         => 'required|string',
            'salary'       => 'required|string|numeric',
            'employer'     => 'required|exists:employers,id'
        ];
    }
}

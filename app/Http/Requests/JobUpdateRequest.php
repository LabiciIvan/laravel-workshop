<?php

namespace App\Http\Requests;

class JobUpdateRequest extends BaseJob
{
    protected array $attributesData = [
        'id'         => null,
        'title'      => null,
        'salary'     => null,
        'tags'       => self::OTHER_ATTRIBUTES,
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
            'id'           => 'required',
            'title'        => 'string',
            'salary'       => 'string|numeric',
            'tags'         => 'array',
        ];
    }
}

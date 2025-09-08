<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesInstantiationRequest extends FormRequest
{
    protected array $allowedNamespaced = [
        'App\Classes'
    ];

    protected array $data = [];

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
            'data.namespace' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    if (!in_array($value, $this->allowedNamespaced, true)) {
                        $fail("The namespace '{$value}' is not allowed.");
                    }
                }
            ],
            'data.class' => 'required|string',
            'data.method' => 'required|string',
            'data.params' => 'sometimes|string',
        ];
    }

    public function normaliseRequestData(): void {
        $dataNormalisation = [
            'data.class'    => 'class',
            'data.method'   => 'method',
            'data.params'   => 'params',
            'data.namespace' => 'namespace',
        ];

        foreach ($dataNormalisation as $requestKey => $expectedKey) {
            if (!$this->has($requestKey)) {
                continue;
            }

            $this->data[$expectedKey] = $this->input($requestKey);
        }
    }

    public function getField(string $field): string|null {
        return $this->data[$field] ?? null;
    }
}

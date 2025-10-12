<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaseJob extends FormRequest
{

    protected array $attributesData;

    public function mappedAttributes(): array {

        foreach ($this->attributesData as $key => $column) {
            if ($this->has($key)) {

                // Field which has different column name in DB needs specific mapping.
                if ($column) {
                    $this->attributesData[$column] = $this->input($key);
                    unset($this->attributesData[$key]);
                    continue;
                }

                $this->attributesData[$key] = $this->input($key);
            }
        }

        return $this->attributesData;
    }
}

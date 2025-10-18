<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BaseJob extends FormRequest
{

    public const OTHER_ATTRIBUTES = 'OTHER_ATTRIBUTES_SEPARATION';

    protected array $attributesData;

    protected array $otherAttributes;

    public function mappedAttributes(): array {

        foreach ($this->attributesData as $key => $column) {

            if ($column === self::OTHER_ATTRIBUTES) {
                Log::debug('----other attributes------');
                Log::debug($column);
                Log::debug($this->input($key));
                Log::debug('----other attributes------');
                // Place other attributes in a different array for easy access.
                $this->otherAttributes[$key] = $this->input($key);
                unset($this->attributesData[$key]);
                continue;
            }

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

    public function otherAttributes(string $attributeName = null) {
        if ($attributeName) {
            return isset($this->otherAttributes[$attributeName]) ? $this->otherAttributes[$attributeName] : null;
        }

        return $this->otherAttributes;
    }
}

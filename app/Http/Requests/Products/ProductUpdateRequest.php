<?php

namespace App\Http\Requests\Products;

class ProductUpdateRequest extends ProductStoreRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            "id" => ["required","exists:products,id"]
        ]);
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->route('id'),
        ]);
    }
}

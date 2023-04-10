<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Requests\Helper as H;

class IndexEquipmentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'equipment_type_id' => 'numeric',
            'serial_number' => 'max:10',
            'comment' => 'max:100'
        ];
    }

    protected function prepareForValidation(): void
    {
        if($this->q) $this->merge(H::q($this->q));
    }

    public function failedValidation(Validator $validator)

    {
        $errors = $validator->errors();
        throw new HttpResponseException(
            response()->json(['errors' => $errors])
        );
    }
}

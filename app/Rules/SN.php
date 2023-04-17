<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\ValidatorAwareRule;
use App\Models\EquipmentType;
use Illuminate\Validation\Validator;

class SN implements ValidationRule, ValidatorAwareRule
{

    /**
     * The validator instance.
     *
     * @var \Illuminate\Validation\Validator
     */
    protected $validator;

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $data = $this->validator->getData();

        if(empty($data['equipment_type_id'])){
            $fail('Equipment_type_id not set');
            return;
        }

        if(!$regex = EquipmentType::regex($data['equipment_type_id'])){
            $fail('Mask to regex error.');
            return;
        }

        if(!preg_match($regex, $value)) $fail('Serial_number is not valid.'); 
    }


    /**
     * Set the current validator.
     */
    public function setValidator(Validator $validator): static
    {
        $this->validator = $validator;
        return $this;
    }
}

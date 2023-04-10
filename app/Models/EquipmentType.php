<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EquipmentType extends Model
{
    use HasFactory;

    //public function devices(){
    //    return $this->HasMany(Equipment::class);
    // }

    static function regex(int $equipment_type_id)
    {
         
        if(!$instance = self::find($equipment_type_id)) return false;
        if(!$instance->mask) return false;
        $map = [
            'N' => '[0-9]',
            'A' => '[A-Z]',
            'a' => '[a-z]',
            'X' => '[A-Z0-9]',
            'Z' => '[_@-]'
        ];
        $regex = '';
        foreach(str_split($instance->mask) as $char){
            $regex .= $map[$char];
        }
        return '/'.$regex.'/';
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\EquipmentType;

class Equipment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'equipment_type_id', 'serial_number', 'comment'];
 
    protected $dates = ['deleted_at'];
    protected $primaryKey = 'id';

    public function type(){
        return $this->hasOne(EquipmentType::class, 'id', 'equipment_type_id');
    }
}

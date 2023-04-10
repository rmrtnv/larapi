<?php

namespace App\Services;

use App\Models\Equipment;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use Illuminate\Support\Facades\Validator;
use App\Rules\SN;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Collection;

class EquipmentService
{

    public function index(array $query)
    {
        return new EquipmentCollection(Equipment::where($query)->paginate(1));
    }

    public function show(int $id)
    {
        if($equipment = Equipment::find($id)) return new EquipmentResource($equipment);
        return response()->json(['Record not found']);
    }

    public function store()
    {
        $request = request();
        $payload = $request->all();
        $response['errors'] = [];
        $response['success'] = [];

        foreach($payload as $index => $object){

            $validator = Validator::make($object, [
                'equipment_type_id' => 'required',
                'serial_number' => ['required', new SN],
                'comment' => 'max:500',
            ]);
            
            if($validator->messages()->any()){
                $response['errors'][$index] = $validator->messages()->all();
                continue;
            } else $response['validated'][$index] = $validator->validated();

            $equipment = new Equipment;
            if($id = $equipment::insertGetId($object)){
                $response['success'][$index] = new EquipmentResource($equipment::find($id));
            }
            else $response['errors'][$index] = 'DB inserting failed.';

        }

        return $response;
    }
    
    
    /**
     * Method update
     *
     * @param array $data validated input
     *
     */
    public function update(array $data)
    {
        $equipment = Equipment::find($data['id']);
        if(!$equipment) return response()->json(['Record not found']);
        $equipment->update($data);
        $equipment->save();
        return new EquipmentResource($equipment);
    }
    
    /**
     * Method delete
     *
     * @param int $id equipment_type primary key
     *
     * @return void
     */
    public function delete(int $id)
    {
        $equipment = Equipment::find($id);
        $equipment->delete();
    }


}
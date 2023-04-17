<?php

namespace App\Services;

use App\Models\Equipment;

use App\Http\Resources\EquipmentResource;
use Illuminate\Support\Facades\Validator;
use App\Rules\SN;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\Collection;
use Exception;
class EquipmentService
{

    public function index(array $query)
    {
        try {
            $equipment = Equipment::where($query)->paginate(1);
            return $equipment ?? 'Not found';
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function show(int $id): Equipment|string
    {
        $equipment = Equipment::find($id);
        return $equipment ?? 'Not found';
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
                'comment' => 'max:255',
            ]);
            
            if($validator->messages()->any()){
                $response['errors'][$index] = $validator->messages()->all();
                continue;
            } else $response['validated'][$index] = $validator->validated();

            try {
                $id = Equipment::insertGetId($object);
                $response['success'][$index] = Equipment::findOrFail($id);

            } catch (Exception $e) {
                $msg[] = $e->getMessage();
                $response['errors'][$index] = $msg;
            }

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
        try {
            $equipment = Equipment::findOrFail($data['id']);
            $equipment->update($data);
            $equipment->save();
            return $equipment;
        } catch (Exception $e) {
            return 'Updating error: ' . $e->getMessage();
        }
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
        try {
            $equipment = Equipment::findOrFail($id);
            if($equipment->delete()) return 'Deleted.';
            return 'Not deleted.';
        } catch (Exception $e) {
            return 'Deletion error: ' . $e->getMessage();
        }
    }
    
}
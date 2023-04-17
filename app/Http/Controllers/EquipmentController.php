<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Services\EquipmentService;
use App\Http\Resources\EquipmentResource;
use App\Models\Equipment;
use App\Http\Resources\EquipmentCollection;
class EquipmentController extends Controller
{

    public function __construct(protected EquipmentService $service)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(IndexEquipmentRequest $request)
    {
        $response = $this->service->index($request->validated());
        return $response instanceof Equipment ? new EquipmentCollection($response) : $response;
    }

    /**
     * Store a newly created resource in storage. StoreEquipmentRequest $request
     */ 
    public function store()
    {   
        $response =  $this->service->store();
        array_walk($response['success'], function(&$value){
            $value = new EquipmentResource($value);
        });
        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $response = $this->service->show($id);
        return $response instanceof Equipment ? new EquipmentResource($response) : $response;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request)
    {
        $response = $this->service->update($request->validated());
        return $response instanceof Equipment ? new EquipmentResource($response) : $response;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {   
        return $this->service->delete($id);
    }
}

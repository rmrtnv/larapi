<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEquipmentTypeRequest;
use App\Http\Requests\UpdateEquipmentTypeRequest;
use App\Models\EquipmentType;
use App\Http\Resources\EquipmentTypeCollection;

class EquipmentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return new EquipmentTypeCollection(EquipmentType::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEquipmentTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentTypeRequest $request, EquipmentType $equipmentType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EquipmentType $equipmentType)
    {
        //
    }
}

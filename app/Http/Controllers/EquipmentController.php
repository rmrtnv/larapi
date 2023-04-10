<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Services\EquipmentService;

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
        return $this->service->index($request->validated());
    }

    /**
     * Store a newly created resource in storage. StoreEquipmentRequest $request
     */ 
    public function store()
    {   
        return $this->service->store();
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->service->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEquipmentRequest $request)
    {
        return $this->service->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {   
        $this->service->delete($id);
    }
}

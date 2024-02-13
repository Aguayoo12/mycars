<?php

namespace App\Http\Controllers;

use App\Http\Requests\APICarRequest;
use App\Models\Car;
use Illuminate\Http\Request;

class APICarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //devuelve un findall
        $cars = Car::all();
        //se devulve en JSON por que es una API
        return response()->json([
            'cars' => $cars,
            'status' => 'true'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(APICarRequest $request)
    {
        $car = Car::create($request->all());
        return response()->json([
            'status' => true,
            'car' => $car,
            'mesage' => 'Todo canela'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $car = Car::find($id);
        //se devulve en JSON por que es una API
        return response()->json([
            'cars' => $car,
            'status' => 'true'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(APICarRequest $request, string $id)
    {
        $car = Car::find($id);
        $car->update($request->all());
        return response()->json([
            'status' => true,
            'car' => $car,
            'mesage' => 'Todo canela'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $car = Car::find($id);
        $car->delete();
        return response()->json([
            'status' => true,
            'mesage' => 'Todo canela'
        ], 200);
    }
}

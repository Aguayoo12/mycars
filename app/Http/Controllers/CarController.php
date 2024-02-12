<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarRequest;
use App\Models\Car;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::find(Auth::id());
        $cars =$user->mycars()->get();
        return view('car.index')->with('coche', $cars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('car.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CarRequest  $request)
    {
        $request->validated();
        //Ejecutar el comando php artisan storage:link para crear enlace sinbolico a la carpeta public enlace con la carpeta storage/app/public
        try {
            // var_dump($request);
            $newCar = new Car();
            $newCar->plate = $request->plate;
            $newCar->marca = $request->marca;
            $newCar->model = $request->modelo;
            $newCar->year = $request->year;
            $newCar->last_revision = $request->fecha_ultima_revision;
            $newCar->price = $request->precio;
            $newCar->user_id = Auth::id();

            //guardamos el nombre del fichero a la base de datos
            $nombreFoto = time() . "-" . $request->file("foto")->getClientOriginalName();
            $newCar->image = $nombreFoto;

            $newCar->save();

            $request->file('foto')->storeAs('public/img_car', $nombreFoto);

            return to_route('car.index')->with('status', 'Coche insertado correctamente');

            // falta subir el fichero
        } catch (QueryException $e) {
            return to_route('car.index')->with('status', "Coche no ha podido ser insertado, Error: $e");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        $rutaImages = 'storage/img_car/';
        return view('car.show')->with('car', $car)->with('ruta', $rutaImages);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        $rutaImages = 'storage/img_car/';
        return view('car.edit')->with('car', $car)->with('ruta', $rutaImages);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Car $car)
    {
        $request->validate(["plate" => "required|unique:cars,plate,".$car->id,
        "marca" => "required",
        "modelo" => "required",
        "year" => "required|integer",
        "fecha_ultima_revision" => "required|date",
        "precio" => "required|numeric"]);

        try {
            $car->plate = $request->plate;
            $car->marca = $request->marca;
            $car->model = $request->modelo;
            $car->year = $request->year;
            $car->last_revision = $request->fecha_ultima_revision;
            $car->price = $request->precio;
            $car->user_id = Auth::id();

            //guardamos el nombre del fichero a la base de datos
            
            if(is_uploaded_file($request->file('foto'))){
                Storage::delete('public/img_car/'.$car->image);
                $nombreFoto = time() . "-" . $request->file("foto")->getClientOriginalName();
                $car->image = $nombreFoto;
                $request->file('foto')->storeAs('public/img_car', $nombreFoto);
            }

            $car->save();
            return to_route('car.index')->with('status', 'Coche editado correctamente');
        } catch (QueryException $th) {
            
            return to_route('car.index')->with('status', "Coche no ha podido ser updateado, Error: $th");
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        
        try {
            $car->delete();
            return to_route('car.index')->with('status', 'Coche bpprradp correctamente');
        } catch (QueryException $th) {
            return to_route('car.index')->with('status', "Coche no ha podido ser borrado, Error: $th");
        }
    }
}

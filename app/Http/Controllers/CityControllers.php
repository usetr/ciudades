<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Services\ApiCity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
 
class CityControllers extends Controller
{
    public function getContry(){
        $apiCity= new ApiCity;
        //return  $apiCity->getContry();

        return View::make('guardar_ciudad', ['contrys' => $apiCity->getContry()]);

    }

    public function guardarCity(){
        //return Request()->ciudad['name'];
        $todasCiudades= City::where('creador',auth()->user()->email)->get();
        if(count($todasCiudades)>=5){
            return response()->json(['error' => 'No se puede completar la acción solicitada,tiene que borrar una ciudad.'], 500);


        }
        $city= new City();
        $city->country = Request()->ciudad['country'];
        $city->creador = auth()->user()->email;
        $city->is_capital = Request()->ciudad['is_capital'];
        $city->latitude = Request()->ciudad['latitude'];
        $city->longitude = Request()->ciudad['longitude'];
        $city->name = Request()->ciudad['name'];
        $city->population = Request()->ciudad['population'];
        $city->save();

        

        return View::make('guardar_ciudad', ['state' =>'']);

    }
    public function dashboard(){
        //return Request()->ciudad['name'];
        $todasCiudades= City::where('creador',auth()->user()->email)->get();
        return View::make('dashboard', ['listarCiudades' =>$todasCiudades]);
    }

    public function eliminar(){
        //return Request()->ciudad['name'];
       $id = request()->id;
       //return request();
       $ciudad = City::find($id);
       if ($ciudad) {
            $ciudad->delete();
            return response()->json(['message' => 'Ciudad eliminada correctamente.'], 200);
        }

        return response()->json(['message' => 'No se encontró la ciudad.'], 404);
    }
}

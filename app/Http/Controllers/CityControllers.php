<?php

namespace App\Http\Controllers;

use App\Services\ApiCity;
use Illuminate\Http\Request;

class CityControllers extends Controller
{
    public function getContry(){
        $apiCity= new ApiCity;
        return $apiCity->getContry();
    }
}

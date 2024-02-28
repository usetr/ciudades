<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiCity
{
    public function GetContry(){
        $url = 'https://api.countrystatecity.in/v1/countries';

        $headers = [
            'Content-Type' => 'application/json',
            'X-CSCAPI-KEY' => 'QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==',
        ];
        // dd($headers['Authorization']);

        // Usar el método get() para realizar una solicitud GET
         $response = Http::withHeaders($headers)->get($url);
        // $response = Http::get($url, $headers);
    
        // Verificar si la solicitud fue exitosa (código de estado 2xx)
        if ($response->successful()) {

            // Obtener el contenido de la respuesta
            $content = $response->body();
    
            // Decodificar la respuesta JSON, si es necesario
            $decodedContent = json_decode($content, true);

            return $decodedContent;
        } else {
            // Si la solicitud no fue exitosa, puedes manejar el error según tus necesidades
            return response()->json(['error' => 'No se pudo obtener los cursos'], $response->status());
        }
    }

}

class state
{
    public function GetContry(){
        $url = ' https://api.countrystatecity.in/v1/states';

        $headers = [
            'Content-Type' => 'application/json',
            'X-CSCAPI-KEY' => 'QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==',
        ];
        // dd($headers['Authorization']);

        // Usar el método get() para realizar una solicitud GET
         $response = Http::withHeaders($headers)->get($url);
        // $response = Http::get($url, $headers);
    
        // Verificar si la solicitud fue exitosa (código de estado 2xx)
        if ($response->successful()) {

            // Obtener el contenido de la respuesta
            $content = $response->body();
    
            // Decodificar la respuesta JSON, si es necesario
            $decodedContent = json_decode($content, true);

            return $decodedContent;
        } else {
            // Si la solicitud no fue exitosa, puedes manejar el error según tus necesidades
            return response()->json(['error' => 'No se pudo obtener los cursos'], $response->status());
        }
    }

}

class ciudades_estados_paises
{
    public function GetContry(){
        $url = 'https://api.countrystatecity.in/v1/countries/[ciso]/states/[siso]/cities';

        $headers = [
            'Content-Type' => 'application/json',
            'X-CSCAPI-KEY' => 'QkpTWVU5czBLVG5KTkh1MEF1NmtsbDBralJxOWtJRUhweWE1YWdkVw==',
        ];
        // dd($headers['Authorization']);

        // Usar el método get() para realizar una solicitud GET
         $response = Http::withHeaders($headers)->get($url);
        // $response = Http::get($url, $headers);
    
        // Verificar si la solicitud fue exitosa (código de estado 2xx)
        if ($response->successful()) {

            // Obtener el contenido de la respuesta
            $content = $response->body();
    
            // Decodificar la respuesta JSON, si es necesario
            $decodedContent = json_decode($content, true);

            return $decodedContent;
        } else {
            // Si la solicitud no fue exitosa, puedes manejar el error según tus necesidades
            return response()->json(['error' => 'No se pudo obtener los cursos'], $response->status());
        }
    }

}
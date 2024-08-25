<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class TipoController extends Controller
{
    //
    public function index()
    {
        return view('tipo.index');
    }
    public function buscarRegistro($dni)
    {
        $registro = Registro::where('dni', $dni)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->first();
        return response()->json($registro);
    }
    public function tipo_p(Request $request)
    {
        // Recoge los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u', // Solo letras y espacios
            'dni' => 'required|numeric|digits:8', // Solo 8 dígitos
            'edad' => 'required|numeric|min:0|max:144', // Edad en meses
            'peso' => 'required|numeric|min:5|max:29.2', // Peso en kg
            'altura' => 'required|numeric|min:50|max:123', // Altura en cm
            'sexo' => 'required|in:M,F', // Sexo M o F
            'hmg' => 'required|numeric|min:7|max:18.5', // Hmg en g/dl
            'rbc' => 'required|numeric|min:3.8|max:6.1', // RBC en 10^3/µL
            'mcv' => 'required|numeric|min:77|max:119', // MCV en fL
            'mch' => 'required|numeric|min:25|max:36', // MCH en pg
            'mchc' => 'required|numeric|min:30|max:36', // MCHC en g/dL
            'rdw' => 'required|numeric|min:11.5|max:14.5' // RDW en %
        ]);

        $input_data = [
            $validatedData['edad'],
            $validatedData['peso'],
            $validatedData['altura'],
            $validatedData['sexo'] == 'M'  ? 0 : 1,// Asumimos que M = 1 y F = 0
            $validatedData['hmg'],
            $validatedData['rbc'],
            $validatedData['mcv'],
            $validatedData['mch'],
            $validatedData['mchc'],
            $validatedData['rdw'],
        ];

        // Haz la solicitud POST a la API de Flask
        $response = Http::post('http://localhost:5000/predict/modelo3', [
            'input_data' => $input_data
        ]);


        // return redirect()->back()->with('tipo_p', $tipo_p);
        $prediccion = $response->json()['prediccion'];

        // Insertar el registro en la base de datos
        Registro::create([
            'dni' => $validatedData['dni'],
            'nombre_apellido' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'peso' => $validatedData['peso'],
            'altura' => $validatedData['altura'],
            'sexo' => $validatedData['sexo'],
            'hmg' => $validatedData['hmg'],
            'RBC' => $validatedData['rbc'],
            'PCV' => null, // No aplicable para tipo
            'MCV' => $validatedData['mcv'],
            'MCH' => $validatedData['mch'],
            'MCHC' => $validatedData['mchc'],
            'RDW' => $validatedData['rdw'],
            'TLC' => null, // No aplicable para tipo
            'fecha' => now()->format('Y-m-d'),
            'hora' => now()->format('H:i:s'),
            'tipo_prediccion' => 2, // Asumiendo 3 para tipo
            'resultado' => $prediccion
        ]);

         // Devuelve una respuesta JSON con la predicción
         return response()->json(['prediccion' => $prediccion]);
    }
}

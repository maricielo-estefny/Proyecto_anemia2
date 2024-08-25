<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Registro;

class SeveridadController extends Controller
{
    //
    public function index()
    {
        return view('severidad.index');
    }
    public function buscarRegistro($dni)
    {
        $registro = Registro::where('dni', $dni)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->first();
        return response()->json($registro);
    }
    public function predecir(Request $request)
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
            'mcv' => 'required|numeric|min:77|max:119', // MCV en fL
            'mch' => 'required|numeric|min:25|max:36', // MCH en pg
            'mchc' => 'required|numeric|min:30|max:36', // MCHC en g/dL
            'rdw' => 'required|numeric|min:11.5|max:14.5', // RDW en %
            'pcv' => 'required|numeric|min:29|max:60', // PCV en %
            'tlc' => 'required|numeric|min:4.5|max:38', // TLC en 10^3/µL
        ]);

        $input_data = [
            $validatedData['edad'],
            $validatedData['peso'],
            $validatedData['altura'],
            $validatedData['sexo'] == 'M' ? 1 : 2, // Asumimos que M = 1 y F = 0
            $validatedData['hmg'],
            $validatedData['pcv'],
            $validatedData['mcv'],
            $validatedData['mch'],
            $validatedData['mchc'],
            $validatedData['rdw'],
            $validatedData['tlc'],
        ];

        // Haz la solicitud POST a la API de Flask
        $response = Http::post('http://localhost:5000/predict/modelo2', [
            'input_data' => $input_data
        ]);

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
            'RBC' => null,
            'PCV' => $validatedData['pcv'],
            'MCV' => $validatedData['mcv'],
            'MCH' => $validatedData['mch'],
            'MCHC' => $validatedData['mchc'],
            'RDW' => $validatedData['rdw'],
            'TLC' => $validatedData['tlc'],
            'PLT' => null,
            'fecha' => now()->format('Y-m-d'),
            'hora' => now()->format('H:i:s'),
            'tipo_prediccion' => 3, // Asumiendo 2 para severidad
            'resultado' => $prediccion
        ]);

        return response()->json(['prediccion' => $prediccion]);
    }
    
}

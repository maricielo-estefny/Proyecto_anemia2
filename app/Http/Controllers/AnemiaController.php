<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Registro;

class AnemiaController extends Controller
{
    //
    // @return \Iluminate\Http\Response
    public function index()
    {
        return view('anemia.index');
    }
    public function buscarRegistro($dni)
    {
        $registro = Registro::where('dni', $dni)->orderBy('fecha', 'desc')->orderBy('hora', 'desc')->first();
        return response()->json($registro);
    }
    public function anemia_p(Request $request)
    {
        // Recoge los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required|regex:/^[\pL\s]+$/u', // Solo letras y espacios
            'dni' => 'required|numeric|digits:8', // Solo 8 dígitos
            'edad' => 'required|numeric|min:0|max:144', // Edad en meses
            'peso' => 'required|numeric|min:5|max:29.2', // Peso en kg
            'altura' => 'required|numeric|min:50|max:123', // Altura en cm
            'sexo' => 'required|in:M,F', // Sexo M o F
            'hmg' => 'required|numeric|min:7|max:18.5' // Hmg en g/dl
        ]);
    
        $input_data = [
            $validatedData['edad'],
            $validatedData['peso'],
            $validatedData['altura'],
            $validatedData['sexo'] == 'M' ? 1 : 2, // Asumimos que M = 1 y F = 0
            $validatedData['hmg']
        ];
    
        // Haz la solicitud POST a la API de Flask
        $response = Http::post('http://localhost:5000/predict/modelo1', [
            'input_data' => $input_data
        ]);
    
        $prediccion = $response->json()['prediccion'];
    
        // Guarda el registro en la base de datos
        Registro::create([
            'dni' => $validatedData['dni'],
            'nombre_apellido' => $validatedData['nombre'],
            'edad' => $validatedData['edad'],
            'peso' => $validatedData['peso'],
            'altura' => $validatedData['altura'],
            'sexo' => $validatedData['sexo'],
            'hmg' => $validatedData['hmg'],
            'RBC' => null, // No aplicable para este tipo de prueba
            'PCV' => null, // No aplicable para este tipo de prueba
            'MCV' => null, // No aplicable para este tipo de prueba
            'MCH' => null, // No aplicable para este tipo de prueba
            'MCHC' => null, // No aplicable para este tipo de prueba
            'RDW' => null, // No aplicable para este tipo de prueba
            'TLC' => null, // No aplicable para este tipo de prueba
            'PLT' => null, // No aplicable para este tipo de prueba
            'fecha' => now()->format('Y-m-d'),
            'hora' => now()->format('H:i:s'),
            'tipo_prediccion' => 1, // Asumimos que 1 es para la predicción de anemia
            'resultado' => $prediccion
        ]);
    
        // Devuelve una respuesta JSON con la predicción
        return response()->json(['prediccion' => $prediccion]);
    }
    
}

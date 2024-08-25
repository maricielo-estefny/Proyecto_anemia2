<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;

class RegistroController extends Controller
{
    public function index(Request $request)
    {
        $dni = $request->input('dni');
        $registros = Registro::where('dni', 'like', '%' . $dni . '%')->paginate(6);

        // Preparar los datos para el gráfico
        $hmgData = $registros->pluck('hmg');
        $horaData = $registros->pluck('hora');

        return view('registros.index', compact('registros', 'dni', 'hmgData', 'horaData'));
    }

    // RegistroController.php
    public function show($id)
    {
        $registro = Registro::findOrFail($id); // Encuentra el registro o devuelve un 404
        return view('registros.show', compact('registro')); // Devuelve la vista con el registro
    }
}

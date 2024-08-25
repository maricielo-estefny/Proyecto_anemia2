<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Registro;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ReporteController extends Controller
{
    public function generar(Request $request)
    {
        $testType = $request->input('testType');
        
        // Filtrar registros por el tipo de prueba
        $registros = Registro::where('tipo_prediccion', $this->getTipoPrueba($testType))->get();

        // Cargar vista para PDF, incluyendo la variable $testType
        $pdf = PDF::loadView('reporte', [
            'registros' => $registros,
            'testType' => $testType
        ]);
        // Descargar PDF
        return $pdf->download('reporte_' . $testType . '.pdf');
    }

    private function getTipoPrueba($testType)
    {
        switch ($testType) {
            case 'Anemia':
                return 1;
            case 'Tipo de Anemia':
                return 2;
            case 'Grado de Severidad':
                return 3;
            default:
                return null;
        }
    }
}

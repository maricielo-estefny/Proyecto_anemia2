<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class Chat2Controller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(Request $request)
    {
        try {
            $response = OpenAI::images()->create([
                'prompt' => 'Hola, necesito que generes {} una imagen representativa de la salud de un paciente.  
                             Un niño de aproximadamente 120 cm de altura, con signos visibles de anemia. Su piel se ve pálida y ligeramente amarillenta, con ojeras marcadas debajo de los ojos. El niño parece débil y cansado, con una postura encorvada. Lleva ropa sencilla y su nivel de hemoglobina es de 9 g/dl, lo que se refleja en su apariencia frágil. El entorno es un espacio interior neutral, como un consultorio médico o una habitación tranquila, con una iluminación suave y natural que resalta sus características', // Texto descriptivo para la generación de la imagen
                'n' => 1, // Número de imágenes a generar
                'size' => '256x256', // Tamaño de la imagen especificado en 256x256
            ]);

            return response()->json([
                'url' => $response->data[0]->url ?? 'Error: no se pudo obtener una URL de imagen válida.'
            ]);
        } catch (Throwable $e) {
            return response()->json(['error' => "Error: " . $e->getMessage()], 500);
        }
    }
}


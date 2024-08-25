<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;  // Asegúrate de incluir este import
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class ChatController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function __invoke(Request $request): string
    {
        try {
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo-0125',
                'messages' => [
                    ['role' => 'system', 'content' => 'Hola, necesito que generes un informe de salud para un paciente. Primero
                                                       quiero que me muestres todititos los datos del paciente en una lista con los datos que te enviare. 
                                                       Luego quiero que el informe incluya recomendaciones 
                                                       nutricionales detalladas (por ejemplo, cuántos gramos al día de ciertos 
                                                       alimentos debe consumir), recomendaciones generales, y cuántas veces al 
                                                       mes debería volver al hospital para citas de seguimiento. También necesito que, por favor, 
                                                       escribas el informe como si fuera dirigido al paciente, con un 
                                                       mensaje de despedida diciendo Atentamente, los estudiantes de la Universidad Nacional 
                                                       de Trujillo.'],
                    ['role' => 'user', 'content' => $request->post('content')],
                ],
                'temperature' => 0,
                'max_tokens' => 2048,
            ]);

            // $responseimagen = OpenAI::images()->create([
            //     'model' => 'dall-e-2',          
            //     // 'model' => 'dall-e-3',
            //     'prompt' => 'give me a description of a child who has anemia for example Image of a child, 4 months old, tired, sad look, low lighting, at the bottom a danger sign, high resolution image, 4k, full of details, realistic', // Texto descriptivo para la generación de la imagen
            //     'n' => 1, // Número de imágenes a generar
            //     'size' => '256x256', // Tamaño de la imagen especificado en 1024x1024
            // ]);

            // $imageUrl = $responseimagen->data[0]->url ?? 'Error: no se pudo obtener una URL de imagen válida.';
            //         // Descargar la imagen y guardarla en la carpeta de imágenes
            // if ($imageUrl !== 'Error: no se pudo obtener una URL de imagen válida.') {
            //     $imageContents = file_get_contents($imageUrl);
            //     $imageName = 'imagen_generada_' . time() . '.png';
            //     $imagePath = public_path('Imagenes/' . $imageName);
            //     file_put_contents($imagePath, $imageContents);
            // }

            $generatedMessage = $response->choices[0]->message->content ?? 'Error: no se pudo obtener una respuesta válida.';

            // Enviar el mensaje a través de la API de WhatsApp
            $phone = $request->post('phone');  // Obtiene el número de teléfono del request
            $whatsappResponse = Http::post('http://149.50.139.202:3002/send', [
                'phone' =>'51'. $phone,
                'message' => $generatedMessage
                // 'mediaUrl'=> $responseimagen->data[0]->url ?? 'Error: no se pudo obtener una URL de imagen válida.'
            ]);
            // error_log('Generated Image URL: ' . $imageUrl);
            return $generatedMessage;
        } catch (Throwable $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
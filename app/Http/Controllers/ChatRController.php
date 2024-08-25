<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;  // Asegúrate de incluir este import
use OpenAI\Laravel\Facades\OpenAI;
use Throwable;

class ChatRController extends Controller
{
     /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    public function __invoke(Request $request)
    {
        try {
            // Decodifica los datos del paciente enviados desde el formulario
            $registro = json_decode($request->input('datos'), true);

            // Construir el mensaje con la información del paciente para enviarlo a OpenAI
            $patientInfo = implode(', ', [
                "Nombre: " . ($registro['nombre_apellido'] ?? 'N/A'),
                "DNI: " . ($registro['dni'] ?? 'N/A'),
                "Fecha: " . ($registro['fecha'] ?? 'N/A'),
                "Hora: " . ($registro['hora'] ?? 'N/A'),
                "Edad(meses): " . ($registro['edad'] ?? 'N/A'),
                "Sexo: " . (isset($registro['sexo']) ? ($registro['sexo'] == 'M' ? 'Hombre' : 'Mujer') : 'N/A'),
                "HMG: " . ($registro['hmg'] ?? 'N/A'),
                "Tipo de Prueba: " . ($registro['tipo_prediccion'] == 1 ? 'Anemia' : ($registro['tipo_prediccion'] == 2 ? 'Severidad' : 'Tipo de Anemia')),
                "Resultado de la prueba: " . ($registro['resultado'] ?? 'N/A')
            ]);

            // Realizar la solicitud a OpenAI para generar el informe
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo-0125',
                'messages' => [
                    ['role' => 'system', 'content' => 'Hola, necesito que generes un informe de salud para un paciente. 
                                                        Con los datos que te enviare. Quiero que el informe incluya recomendaciones 
                                                        nutricionales detalladas (por ejemplo, cuántos gramos al día de ciertos 
                                                        alimentos debe consumir), recomendaciones generales, y cuántas veces al 
                                                        mes debería volver al hospital para citas de seguimiento. También, por favor, 
                                                        escribe el informe como si fuera dirigido al paciente o su cuidador, con un 
                                                        mensaje de despedida diciendo Atentamente, los estudiantes de la Universidad Nacional 
                                                        de Trujillo.'],
                    ['role' => 'user', 'content' => $patientInfo],
                ],
                'temperature' => 0,
                'max_tokens' => 2048,
            ]);

            // Obtener el mensaje generado por OpenAI
            $generatedMessage = $response->choices[0]->message->content ?? 'Error: no se pudo obtener una respuesta válida.';

            $responseimagen = OpenAI::images()->create([
                'model' => 'dall-e-2',
                'prompt' => 'give me a description of a child who has anemia for example Image of a child, 4 months old, tired, sad look, low lighting, at the bottom a danger sign, high resolution image, 4k, full of details, realistic', // Texto descriptivo para la generación de la imagen
                'n' => 1, // Número de imágenes a generar
                'size' => '256x256', // Tamaño de la imagen especificado en 256x256
            ]);

            $phone = $request->input('phone');
            // Enviar el mensaje generado a través de la API de WhatsApp
            $whatsappResponse = Http::post('http://149.50.139.202:3002/send', [
                'phone' => '51' . $phone,
                'message' => $generatedMessage,
                'mediaUrl'=> $responseimagen->data[0]->url ?? 'Error: no se pudo obtener una URL de imagen válida.',
            ]);

            // Verificar si el mensaje se envió correctamente a WhatsApp
            if ($whatsappResponse->successful()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Mensaje enviado con éxito a WhatsApp.',
                    'prediction' => $generatedMessage
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error al enviar el mensaje a WhatsApp.']);
            }
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => "Error: " . $e->getMessage()]);
        }
    }

    public function __invoke_image(Request $request)
    {
        try {
            // Decodifica los datos del paciente enviados desde el formulario
            $registro = json_decode($request->input('datos'), true);

            // Construir el mensaje con la información del paciente para enviarlo a OpenAI
            $patientInfo = implode(', ', [
                "Nombre: " . ($registro['nombre_apellido'] ?? 'N/A'),
                "DNI: " . ($registro['dni'] ?? 'N/A'),
                "Fecha: " . ($registro['fecha'] ?? 'N/A'),
                "Hora: " . ($registro['hora'] ?? 'N/A'),
                "Edad(meses): " . ($registro['edad'] ?? 'N/A'),
                "Sexo: " . (isset($registro['sexo']) ? ($registro['sexo'] == 'M' ? 'Hombre' : 'Mujer') : 'N/A'),
                "HMG: " . ($registro['hmg'] ?? 'N/A'),
                "Tipo de Prueba: " . ($registro['tipo_prediccion'] == 1 ? 'Anemia' : ($registro['tipo_prediccion'] == 2 ? 'Severidad' : 'Tipo de Anemia')),
                "Resultado de la prueba: " . ($registro['resultado'] ?? 'N/A')
            ]);

            // Realizar la solicitud a OpenAI para generar el informe
            $response = OpenAI::chat()->create([
                'model' => 'gpt-3.5-turbo-0125',
                'messages' => [
                    ['role' => 'system', 'content' => 'Hola, necesito que generes un informe de salud para un paciente. 
                                                        Con los datos que te enviare. Quiero que el informe incluya recomendaciones 
                                                        nutricionales detalladas (por ejemplo, cuántos gramos al día de ciertos 
                                                        alimentos debe consumir), recomendaciones generales, y cuántas veces al 
                                                        mes debería volver al hospital para citas de seguimiento. También, por favor, 
                                                        escribe el informe como si fuera dirigido al paciente o su cuidador, con un 
                                                        mensaje de despedida diciendo Atentamente, los estudiantes de la Universidad Nacional 
                                                        de Trujillo.'],
                    ['role' => 'user', 'content' => $patientInfo],
                ],
                'temperature' => 0,
                'max_tokens' => 2048,
            ]);

            // Obtener el mensaje generado por OpenAI
            $generatedMessage = $response->choices[0]->message->content ?? 'Error: no se pudo obtener una respuesta válida.';

            $responseimagen = OpenAI::images()->create([
                'prompt' => 'Pinguno beautiful', // Texto descriptivo para la generación de la imagen
                'n' => 1, // Número de imágenes a generar
                'size' => '256x256', // Tamaño de la imagen especificado en 256x256
            ]);

            $phone = $request->input('phone');
            // Enviar el mensaje generado a través de la API de WhatsApp
            $whatsappResponse = Http::post('http://localhost:3002/send', [
                'phone' => '51' . $phone,
                'message' => $generatedMessage,
                 'mediaUrl'=> $responseimagen->data[0]->url ?? 'Error: no se pudo obtener una URL de imagen válida.',
            ]);

            // Verificar si el mensaje se envió correctamente a WhatsApp
            if ($whatsappResponse->successful()) {
                return response()->json([
                    'success' => true, 
                    'message' => 'Mensaje enviado con éxito a WhatsApp.',
                    'prediction' => $generatedMessage
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Error al enviar el mensaje a WhatsApp.']);
            }
        } catch (Throwable $e) {
            return response()->json(['success' => false, 'message' => "Error: " . $e->getMessage()]);
        }
    }
}

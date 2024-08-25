<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de Imágenes</title>
</head>
<body>
    <h1>Generador de Imágenes con DALL·E 2</h1>
    
    <form action="/generate-image" method="POST">
        @csrf
        <button type="submit">Generar Imagen</button>
    </form>

    @if(isset($url))
        <div>
            <h3>Imagen Generada:</h3>
            <img src="{{ session('url') }}" alt="Imagen Generada" style="max-width: 100%;">
        </div>
    @endif

    @if(isset($error))
        <div>
            <p>Error: {{ $error }}</p>
        </div>
    @endif
</body>
</html>
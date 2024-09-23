<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba Tecnica DNA MUSIC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="flex items-center justify-center min-h-screen">
        <div class="flex flex-col lg:flex-row max-w-5xl mx-auto p-8 bg-white rounded-lg shadow-lg">
            <!-- Contenedor Izquierdo -->
            <div class="flex-1 p-8 text-center">
                <h1 class="text-5xl font-bold mb-4">Prueba técnica DNA MUSIC</h1>
                <p class="text-lg mb-4">Por José Bohórquez, desarrollador full stack</p>

                <!-- Botones -->
                <div class="flex justify-between mt-6">
                    <a href="{{ route('login') }}" class="bg-blue-500 text-white px-4 py-2 rounded-xl hover:bg-blue-600">Ingresar</a>
                    <a href="{{ route('register') }}" class="bg-green-500 text-white px-4 py-2 rounded-xl hover:bg-green-600">Registrarme</a>
                </div>
            </div>

            <!-- Contenedor Derecho -->
            <div class="flex-1 p-8 flex justify-center items-center">
                <img src="{{ asset('foto/foto.webp') }}" alt="José Bohórquez" class="rounded-full w-56 h-56 object-cover">
            </div>
        </div>
    </div>
</body>
</html>

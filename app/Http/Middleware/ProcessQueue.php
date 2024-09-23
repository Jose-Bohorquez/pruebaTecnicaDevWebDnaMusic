<?php

// app/Http/Middleware/ProcessQueue.php

namespace App\Http\Middleware;

use Closure;

class ProcessQueue
{
    public function handle($request, Closure $next)
    {
        // Ejecuta el comando para procesar la cola
        exec('php /ruta/a/tu/proyecto/artisan queue:work --tries=3 > /dev/null 2>&1 &');

        return $next($request);
    }
}

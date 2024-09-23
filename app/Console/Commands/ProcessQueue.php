<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProcessQueue extends Command
{
    protected $signature = 'app:process-queue';
    protected $description = 'Process the mail queue';

    public function handle()
    {
        // Llama a la función queue:work para procesar la cola
        Artisan::call('queue:work --queue=default --sleep=3 --tries=3');
        $this->info('Queue processed successfully!');
    }
}

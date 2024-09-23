<?php
// app/Console/Commands/ProcessQueueCommand.php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessQueueCommand extends Command
{
    protected $signature = 'queue:process';

    protected $description = 'Process the queue';

    public function handle()
    {
        // Lógica para procesar la cola
        \Artisan::call('queue:work', ['--tries' => 3]);
    }
}

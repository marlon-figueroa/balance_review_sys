<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnviarRecordatoriosVencimiento extends Command
{
    protected $signature = 'app:recordatorios-vencimiento';

    protected $description = 'Reservado para alertas de revisiones de balance (MVP sin cola).';

    public function handle(): int
    {
        $this->info('No hay recordatorios configurados en el MVP.');

        return self::SUCCESS;
    }
}

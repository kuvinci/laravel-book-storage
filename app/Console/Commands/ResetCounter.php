<?php

namespace App\Console\Commands;

use App\Models\Options;
use Illuminate\Console\Command;

class ResetCounter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:reset-counter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Options::setOption('counter', 0);
    }
}

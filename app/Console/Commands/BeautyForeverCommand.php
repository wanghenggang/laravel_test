<?php

namespace App\Console\Commands;

use App\Services\BeautyService;
use Illuminate\Console\Command;

class BeautyForeverCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:beauty';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        (new BeautyService())->spider();
        $this->info('ok');

        return true;
    }
}

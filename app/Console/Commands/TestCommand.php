<?php

namespace App\Console\Commands;

use App\Services\DataService;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return bool|int
     */
    public function handle(): bool|int
    {
        //DataService::insertUser();
        DataService::updateUser();
        $this->info('over');

        return true;
    }
}

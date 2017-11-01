<?php

namespace App\Console\Commands;

use App;
use App\Mail\EmployeeScores;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use DB;

class MemberAccCommand extends Command
{
    protected $signature = 'member:acc';

    protected $description = 'Generate member:acc';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        (new App\Jobs\MemberAccJob)->handle();
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserDelete extends Command
{
    use SoftDeletes;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:cron';

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
        return User::onlyTrashed()->forceDelete();
    }
}

<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class random_command extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:random_command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Random commands that need to be run on the server';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::create([
            "name"=> "Chris Rocha",
            "email"=> "crocha@rocketflood.com",
            "password"=> bcrypt("password")
        ]);
    }
}

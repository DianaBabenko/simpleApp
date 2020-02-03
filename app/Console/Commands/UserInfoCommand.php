<?php

namespace App\Console\Commands;

use App\Mail\Greeting;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UserInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:info {email} {name} {number}';

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
        $email = $this->argument('email');
        $name = $this->argument('name');
        $number = $this->argument('number');

        Mail::to($email)->send(new Greeting($name, $number));

        $this->info('sent');
    }
}

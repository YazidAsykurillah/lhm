<?php

namespace App\Console\Commands\User;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Deposit;
class RegisterDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:register-deposit';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //
        $users = User::all();
        foreach($users as $user){
            Deposit::updateOrCreate(
                ['user_id'=>$user->id],
                ['user_id'=>$user->id],
            );
        }
    }
}

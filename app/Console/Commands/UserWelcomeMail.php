<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class UserWelcomeMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automail:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send welcome email when user is registered';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = Invitation::all();
           foreach ($user as $all)
           {
            $future_stamp =strtotime('+5 minutes', strtotime($all->user_registered_at));
            $now_stamp    = date("Y-m-d H:i:s");

            if(strtotime($future_stamp) == strtotime($now_stamp) ){
             Mail::raw("Welcome! You are successfully registered", function($message) use ($all)
             {
                 $message->from('admin@gmail.com');
                 $message->to($all->email)->subject('Welcome');
             });
            }
            
         }
         $this->info('Minute Update has been send successfully');
    }
}

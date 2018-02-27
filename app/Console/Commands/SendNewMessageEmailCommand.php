<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Participant_marketer;
use App\Admin;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

class SendNewMessageEmailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:newmessage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a email for new message which is unreaded 2 hour from send time.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        
        if(Schema::hasTable('participants')){
            $this->users = Participant_marketer::where('unread' , 1)
                                        ->where('user_type' , 'influencer')
                                        ->get();
        }
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //for checking that if messaegs in not readed in 2 hour an email will be send 
        if(Schema::hasTable('participants')){ 
            $this->users->each(function($user_value) {
                $temp_create_at = $user_value->created_at;
                $created_at_user_two_hours = $user_value->created_at->addHour(2);
                $created_at_user_three_hours = $temp_create_at->addHour(2)->addMinute();
                if(Carbon::now() > $created_at_user_two_hours){
                    if(Carbon::now() > $created_at_user_three_hours){

                    }else{
                        $user = User::findOrFail($user_value->user_id);
                        $admin_marketer = Participant_marketer::where('thread_id' , $user_value->thread_id)
                                            ->where('user_type' , 'marketer')
                                            ->first();  
                        $admin = Admin::findOrFail($admin_marketer->user_id);

                        //send user an email here...
                        \Mail::send('email.new_messages', ['user' => $user , 'admin' => $admin], function ($m) use ($user) {
                            $m->to($user->email, $user->name)->subject('You have New massage!');
                        });
                    }
                }
     
            });
        }
    }
}

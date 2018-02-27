<?php

namespace App\Helpers;


class CommonFunctions {
	// \App\Helpers\CommonFunctions
    public static function newMessageCount($user_type)
    {
        if($user_type == 'marketer'){
            return \App\Participant_marketer::where('to_user' , \Auth::user()->id)
                                        ->where('user_type' , $user_type)
                                        ->where('unread' , 1)
                                        ->count();
        }else{
            return \App\Participant_marketer::where('to_user' , \Auth::guard('jobseeker')->user()->id)
                                        ->where('user_type' , $user_type)
                                        ->where('unread' , 1)
                                        ->count();
        }
    }
}
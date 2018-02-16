@extends('layouts.master3')

@section('content')
    @include('messenger_influencer.partials.flash')

    <!-- each('messenger_marketer.partials.thread', $threads, 'thread', 'messenger_marketer.partials.no-threads') -->
    <?php 
    // vv($threads);
	    foreach ($threads as $key => $value) {
    		$unread_var = false;
    		$user_data = "";
    		// $user_influencer = "";
	    	if(!$value->participants_only_marketer->isEmpty()){
	    		foreach ($value->participants_only_marketer as $user) {
	    			if($user->unread == 1 && $user->user_type == 'marketer'){
				    	$unread_var = true;
	    			}
	    			if($user->user_type == 'marketer'){
				    	$user_data = $user->user_id;
				    }else{
				    	$user_data = "none";
				    }

				    // if($user->user_type == 'influencer'){
				    // 	$user_influencer = $user->user_id;
				    // }else{
				    // 	$user_influencer = "none";
				    // }
				}
	    	}
	    	if(!empty($user_data)){
	?>
			<div class="media alert {{ $unread_var ? 'alert-info' : ''}} ">
			    <h4 class="media-heading">
			        {{$key+1}} <a href="{{ route('messages_influencer.show', $value->id) }}">{{ $value->subject }}</a>
			        <!-- ( $value->userUnreadMessagesCount(Auth::guard('jobseeker')->user()->id)  unread)</h4> -->
			    <p>
			       {{ $value->messages[0]->body }}
			    <p>
<!-- 			    	<small><strong>Creator:</strong>
 			        	 \App\User::where(['id' => $user_influencer])->pluck('first_name')->first() 
			        </small> -->

			        <small><strong>From:</strong>
 			        	{!! \App\Admin::where(['id' => $user_data])->pluck('first_name')->first() !!}
			        </small>
			    </p>
			    <p>
			        <!-- <small><strong>Participants:</strong> 
			        	{!! \App\Admin::where(['id' => $user_data])->pluck('first_name')->first() !!}
			        </small> -->
			    </p>
			</div>
  	<?php
  			}else{
  				{{ 'Empty inbox'; }}
  			}
	    }
    ?> 


@stop

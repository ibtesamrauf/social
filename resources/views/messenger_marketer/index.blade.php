@extends('layouts.master2')

@section('content')
    @include('messenger_marketer.partials.flash')

    <!-- each('messenger_marketer.partials.thread', $threads, 'thread', 'messenger_marketer.partials.no-threads') -->
    <?php 
    // vv($threads);
	    foreach ($threads as $key => $value) {
    		$unread_var = false;
    		$user_data = "";

	    	if(!$value->participants_only_influencer->isEmpty()){
	    		foreach ($value->participants_only_influencer as $user) {
	    			if($user->unread == 1 && $user->user_type == 'influencer'){
				    	$unread_var = true;
	    			}
	    			if($user->user_type == 'influencer'){
				    	$user_data = $user->user_id;
				    }else{
				    	$user_data = "none";
				    }
				}
	    	}
	    	if(!empty($user_data)){
	?>	
			<div class="media alert {{ $unread_var ? 'alert-info' : ''}} ">
			    <h4 class="media-heading">
			        {{$key+1}} <a href="{{ route('messages_marketer.show', $value->id) }}">{{ $value->subject }}</a>
			        <!-- ( $value->userUnreadMessagesCount(Auth::guard('jobseeker')->user()->id)  unread)</h4> -->
			    <p>
			       {{ $value->messages[0]->body }} 
			    </p>

			    <p>
			        <!-- <small><strong>Creator:</strong>
			        	$value->creator()->first_name
			        </small> -->
			        <small><strong>From:</strong>
 			        	{!! \App\User::where(['id' => $user_data])->pluck('first_name')->first() !!}
			        </small>
			    </p>
<!-- 			    <p>
			        <small><strong>Participants:</strong> 
			        $value->participantsString(Auth::guard('jobseeker')->user()->id)
			        </small>
			    </p> -->
			</div>
  	<?php
  			}else{
  				{{ 'Empty inbox'; }}
  			}
	    }
    ?> 


@stop

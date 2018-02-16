@extends('layouts.master2')

@section('content')
    <div class="col-md-6">
        <h1>{{ $thread->subject }}</h1>
        <!-- each('messenger_marketer.partials.messages', $thread->messages, 'message') -->

        <?php 
        	foreach ($thread->messages as $key => $value) {
        		$temp_user_data = "";
        ?>	
		        <div class="media">
				    <a class="pull-left" href="#">
				    <?php 
				    if($value->user_type == 'marketer'){
				    	$temp_user_data = $value->marketer;
				    }elseif ($value->user_type == 'influencer') {
				    	$temp_user_data = $value->user;
				    }
			    	?> 
				        <img src="//www.gravatar.com/avatar/{{ md5($temp_user_data->email) }} ?s=64"
				             alt="{{ $temp_user_data->first_name }}" class="img-circle">
			    	
				    </a>
				    <div class="media-body">
				        <h5 class="media-heading">{{ $temp_user_data->first_name }} {{ $temp_user_data->last_name }} {{ $temp_user_data->email }}</h5>
				        <p>{{ $value->body }}</p>
				        <div class="text-muted">
				            <small>Posted {{ $value->created_at->diffForHumans() }}</small>
				        </div>
				    </div>
				</div>
		<?php
			}
		?>
        
        <h2>Add a new message</h2>
		<form action="{{ route('messages_marketer.update', $thread->id) }}" method="post">
		    {{ method_field('put') }}
		    {{ csrf_field() }}
		        
		    <!-- Message Form Input -->
		    <div class="form-group">
		        <textarea name="message" class="form-control">{{ old('message') }}</textarea>
		    </div>


		    <!-- Submit Form Input -->
		    <div class="form-group">
		        <button type="submit" class="btn btn-primary form-control">Submit</button>
		    </div>
		</form>
    </div>
@stop

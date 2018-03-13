<div class="panel-body">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="col-md-12">
        <h1>{{ $thread->subject }}</h1>
        <!-- each('messenger_marketer.partials.messages', $thread->messages, 'message') -->

        <?php 
        	foreach ($thread->messages as $key => $value) {
        		$temp_user_data = "";
        ?>	
		        <div class="media">
				    <a class="pull-left" >
				    <?php 
				    if($value->user_type == 'marketer'){
				    	$temp_user_data = $value->marketer;
				    	if(!empty($temp_user_data->profile_picture)){
				    		$profile_image = 'uploads/'.$temp_user_data->profile_picture;
				    	}else{
				    		$profile_image = "img/default-profile-image.png";
				    	}
				    }elseif ($value->user_type == 'influencer') {
				    	$temp_user_data = $value->user;
				    	if(!empty($temp_user_data->profile_picture)){
				    		$profile_image = 'uploads/'.$temp_user_data->profile_picture;
				    	}else{
				    		$profile_image = "img/default-profile-image.png";
				    	}
				    }
			    	?> 
			    		<img src="{{ asset($profile_image) }}"
				             class="img-thumbnail img-circle" style="width: 95px;">

				        <!-- <img src="//www.gravatar.com/avatar/{{ md5($temp_user_data->email) }} ?s=64"
				             alt="{{ $temp_user_data->first_name }}" class="img-circle"> -->
			    	
				    </a>
				    <div class="media-body">
				        <h4 class="media-heading"><strong>From:</strong> {{ $temp_user_data->first_name }} {{ $temp_user_data->last_name }} {{ $temp_user_data->email }}</h4>
				        <h5><strong>Message:</strong> {{ $value->body }}</h5>
				        <div class="text-muted">
				            <small>Posted {{ $value->created_at->diffForHumans() }}</small>
				        </div>
				    </div>
				</div>
		<?php
			}
		?>
        
        <h4>Add a new message</h4>
		<form action="{{ route('messages_marketer.update', $thread->id) }}" method="post">
		    {{ method_field('put') }}
		    {{ csrf_field() }}
		        
		    <!-- Message Form Input -->
		    <div class="form-group">
		        <textarea name="message" rows="6" class="form-control">{{ old('message') }}</textarea>
		    </div>


		    <!-- Submit Form Input -->
		    <div class="col-md-2 form-group">
		        <button type="submit" class="btn btn-primary form-control">Submit</button>
		    </div>
		</form>
    </div>
</div>
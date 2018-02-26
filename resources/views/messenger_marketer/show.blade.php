@extends('layouts.app')

@section('content')

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<div class="main">
    <section class="module bg-dark-30" data-background="{{ asset('assets/images/section-4.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Inbox</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">Inbox</div>

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
										    <a class="pull-left" href="#">
										    <?php 
										    if($value->user_type == 'marketer'){
										    	$temp_user_data = $value->marketer;
										    	$profile_image = 'uploads/default-profile.png';

										    }elseif ($value->user_type == 'influencer') {
										    	$temp_user_data = $value->user;
										    	$profile_image = 'uploads/'.$temp_user_data->profile_picture;
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
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>

@endsection



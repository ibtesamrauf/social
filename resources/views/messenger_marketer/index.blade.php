@extends('layouts.app')

@section('content')

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<div class="main">
    <section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
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
                        <div class="panel-heading">Inbox @include('messenger_marketer.unread-count')</div>

                        <div class="panel-body">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            <?php 
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
										        <!-- $key+1 -->
										        <a href="{{ route('messages_marketer.show',['belongsto1' => $value->id, 'id' => $value->id]) }}">{{ $value->subject }}</a>
										        <!-- ( $value->userUnreadMessagesCount(Auth::guard('jobseeker')->user()->id)  unread)</h4> -->
										    <p>
										    <?php //var_dump(count($value->messages)); ?>
										       {{ $value->messages[count($value->messages)-1]->body }} 
										    </p>

										    <p>
										        <small><strong>From:</strong>
							 			        	{!! \App\User::where(['id' => $user_data])->pluck('first_name')->first() !!}
										        </small>
										    </p>
										</div>
						  	<?php
						  			}else{
						  				{{ 'Empty inbox'; }}
						  			}
							    }
						    ?> 
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



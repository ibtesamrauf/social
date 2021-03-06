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
                        <div class="panel-heading">Inbox @include('messenger_influencer.unread-count')</div>

                        <div class="panel-body">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            <?php 
                            	if($threads->isEmpty()){
	                            	echo 'Empty inbox';
	                            }
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
							    		if(!$value->participants_only_my_messages_influencer->isEmpty()){
							?>
											<div class="media alert {{ $unread_var ? 'alert-info' : ''}} ">
											    <h4 class="media-heading">
											        <!-- $key+1 -->
											        <a href="{{ route('messages_influencer.show', $value->id) }}">{{ $value->subject }}</a>
											        <!-- ( $value->userUnreadMessagesCount(Auth::guard('jobseeker')->user()->id)  unread)</h4> -->
											    <p>
											       {{ $value->messages[0]->body }}
											    <p>
								<!-- 			    	<small><strong>Creator:</strong>
								 			        	 \App\User::where(['id' => $user_influencer])->pluck('first_name')->first() 
											        </small> -->

											        <small><strong>From:</strong>
								 			        	{!! \App\Admin::where(['id' => $user_data])->pluck('first_name')->first() !!} 
								 			        	{!! \App\Admin::where(['id' => $user_data])->pluck('last_name')->first() !!}
											        </small>
											    </p>
											    <p>
											        <!-- <small><strong>Participants:</strong> 
											        	{!! \App\Admin::where(['id' => $user_data])->pluck('first_name')->first() !!}
											        </small> -->
											    </p>
											</div>
						  	<?php
						  				}
						  			}else{
						  				echo 'Empty inbox';
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

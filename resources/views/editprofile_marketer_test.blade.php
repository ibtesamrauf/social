@extends('layouts.app')

@section('content')
<div class="main">
        <section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Update-Profile</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
		    <div class="container">
		        <div class="row">
		            <div class="col-md-12">
		                <div class="panel panel-default">
		                    <div class="panel-heading">Update Profile</div>
		                    <div class="panel-body">
		                        @if (session('status'))
							        <div class="alert alert-success">
							            {{ session('status') }}
							        </div>
						        @endif
		                        @if ($errors->any())
		                            <ul class="alert alert-danger">
		                                @foreach ($errors->all() as $error)
		                                    <li>{{ $error }}</li>
		                                @endforeach
		                            </ul>
		                        @endif
		                        <form action="editprofile_marketer_post" method="POST" enctype="multipart/form-data" class="form-horizontal">
									{{ csrf_field() }}
									<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
									    {!! Form::label('first_name', 'first_name', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									        <input class="form-control" name="first_name" type="text" value="{{ Auth::guard('jobseeker')->user()->first_name }}" id="first_name">
									        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>

									<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
									    {!! Form::label('last_name', 'last_name', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									        <input class="form-control" name="last_name" type="text" value="{{ Auth::guard('jobseeker')->user()->last_name }}" id="last_name">
									        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>

									<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
									    {!! Form::label('phone_number', 'phone_number', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									        <input class="form-control" name="phone_number" type="text" value="{{ Auth::guard('jobseeker')->user()->phone_number }}" id="phone_number">
									        {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>

									<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
									    {!! Form::label('email', 'email', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									        <input class="form-control" readonly name="email" type="text" value="{{ Auth::guard('jobseeker')->user()->email }}" id="email">
									        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>

									<div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
									    {!! Form::label('country', 'country', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
											{!! Form::select('country', $country, Auth::guard('jobseeker')->user()->country, array('class' => 'form-control')) !!}
									        {!! $errors->first('country', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>


									<?php 
										
									if(strpos(Auth::guard('jobseeker')->user()->profile_picture,'http') !== false){
										$temp_image = Auth::guard('jobseeker')->user()->profile_picture;
									}else{
										$temp_image = asset('uploads/'.Auth::guard('jobseeker')->user()->profile_picture);
									}
									?>
									<div class="form-group {{ $errors->has('profile_picture') ? 'has-error' : ''}}">
									    {!! Form::label('profile_picture', 'profile_picture', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									    	<img src="{{ $temp_image }}" style="width:150px">
									        <input class="form-control" type="file" id="file" name="file">
									        {!! $errors->first('profile_picture', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>


									<div class="form-group {{ $errors->has('youtube_page_url') ? 'has-error' : ''}}">
									    {!! Form::label('youtube_page_url', 'Previous Campaign', ['class' => 'col-md-4 control-label']) !!}
									    <div class="col-md-6">
									    	<?php 
		                                        if(Auth::guard('jobseeker')->user()->Maeketer_previously_campaign->isEmpty()){
		                                            echo "No portfolio";
		                                        }else{
		                                    ?>
			                                        <table class="table" id="table_previous_campaign">
			                                            <th>S.no</th>
			                                            <th>Client</th>
			                                            <th>link</th>
			                                            <th>details</th>
			                                            <th>Action</th>
			                                            @foreach(Auth::guard('jobseeker')->user()->Maeketer_previously_campaign as $key => $previously_campaign)
			                                                <tr>
			                                                    <td>{{ $key+1 }}</td>
			                                                    <td>{{ $previously_campaign->influencer_used }}</td>
			                                                    <td>{{ $previously_campaign->campaign_link }}</td>
			                                                    <td>{{ $previously_campaign->description }}</td>
		                                                    	<td>
						                                            <a href="{{ url('/edit_previous_campaign_marketer/' . $previously_campaign->id) }}" title="Edit User" class="btn btn-primary btn-xs" >
						                                            	<i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit
					                                            	</a>
						                                            <a href="{{ url('/delete_previous_campaign_marketer/' . $previously_campaign->id) }}" class="btn btn-danger btn-xs" title="Delete User">
							                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Delete
						                                            </a>
		                                                    	</td> 
			                                                </tr>
			                                            @endforeach
			                                        </table>
													<div class="col-md-9">
			                                        </div>
													<div class="col-md-2">
														<input class="btn btn-secondary" id="add_previous_campaign" name="add_previous_campaign" type="button" value="Add">
													</div>
		                                    <?php    
		                                        } 
		                                    ?>
									        {!! $errors->first('youtube_page_url', '<p class="help-block">:message</p>') !!}
									    </div>
									</div>
							
									<hr>
									<div class="form-group">
									    <div class="col-md-offset-4 col-md-4">
									        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
									    </div>
									</div>
								</form>
							</div>
		                </div>
		            </div>
		        </div>
		    </div>
	    </section>
		@include('layouts.footer')
	</div>
	<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<script type="text/javascript">
	    $( document ).ready(function() {
	        $( "#add_another" ).click(function() {
	          $( "#previously_campaigns" ).append('<br><div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}"><input id="client[]" type="text" class="form-control" name="client[]" value="" placeholder="Client" autofocus>@if ($errors->has('client'))<span class="help-block"><strong>{{ $errors->first('client') }}</strong></span>@endif</div><div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}"><input id="link[]" type="text" class="form-control" name="link[]" value="" placeholder="Link" autofocus>@if ($errors->has('link'))<span class="help-block"><strong>{{ $errors->first('link') }}</strong></span>@endif</div><div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}"><input id="details[]" type="text" class="form-control" name="details[]" value="" placeholder="Details" autofocus>@if ($errors->has('details'))<span class="help-block"><strong>{{ $errors->first('details') }}</strong></span>@endif</div>'); 
	        });

	        var rowCount = $('#table_previous_campaign tr').length;
			var count = rowCount-1;
	        $( "#add_previous_campaign" ).click(function() {
	        	count = count + 1;
	          	$( "#table_previous_campaign" ).append('<tr>'+
	          					'<td>'+count+'</td>'+
                            	'<td><input type="text" name="previously_campaign_client[]" id="previously_campaign_client[]" ></td>'+
                                '<td><input type="text" name="previously_campaign_link[]" id="previously_campaign_link[]" ></td>'+
                                '<td><input type="text" name="previously_campaign_details[]" id="previously_campaign_details[]" ></td>'+
                                '</tr'); 
	        });

	        var rowCount_portfolio = $('#table_portfolio tr').length;
			var count_portfolio = rowCount_portfolio-1;
	        $( "#add_portfolio" ).click(function() {
	        	count_portfolio = count_portfolio + 1;
	          	$( "#table_portfolio" ).append('<tr>'+
	          					'<td>'+count_portfolio+'</td>'+
                                '<td><input type="text" name="portfolio_link[]" id="portfolio_link[]" ></td>'+
                                '<td><input type="text" name="portfolio_description[]" id="portfolio_description[]" ></td>'+
                                '</tr'); 
	        });
	        
	    });
	</script>

@endsection

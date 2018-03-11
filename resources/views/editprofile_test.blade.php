@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pages</div>
                    <div class="panel-body">
                        <a href="{{ url('/buildpages') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />
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
                        <form action="editprofile_post" method="POST" class="form-horizontal">
							{{ csrf_field() }}
							<div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}}">
							    {!! Form::label('first_name', 'first_name', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        <input class="form-control" name="first_name" type="text" value="{{ Auth::user()->first_name }}" id="first_name">
							        {!! $errors->first('first_name', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}}">
							    {!! Form::label('last_name', 'last_name', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        <input class="form-control" name="last_name" type="text" value="{{ Auth::user()->last_name }}" id="last_name">
							        {!! $errors->first('last_name', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<div class="form-group {{ $errors->has('phone_number') ? 'has-error' : ''}}">
							    {!! Form::label('phone_number', 'phone_number', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        <input class="form-control" name="phone_number" type="text" value="{{ Auth::user()->phone_number }}" id="phone_number">
							        {!! $errors->first('phone_number', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
							    {!! Form::label('email', 'email', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        <input class="form-control" readonly name="email" type="text" value="{{ Auth::user()->email }}" id="email">
							        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<?php 
								
							if(strpos(Auth::user()->profile_picture,'http') !== false){
								$temp_image = Auth::user()->profile_picture;
							}else{
								$temp_image = asset('uploads/'.Auth::user()->profile_picture);
							}
							?>
							<div class="form-group {{ $errors->has('profile_picture') ? 'has-error' : ''}}">
							    {!! Form::label('profile_picture', 'profile_picture', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							    	<img src="{{ $temp_image }}" style="width:150px">
							        <input class="form-control" name="profile_picture" type="file" value="{{ Auth::user()->profile_picture }}" id="profile_picture">
							        {!! $errors->first('profile_picture', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<!-- <div class="form-group {{ $errors->has('role') ? 'has-error' : ''}}">
							    {!! Form::label('role', 'role', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        <input class="form-control" readonly name="role" type="text" value="Infulencer" id="role">
							        {!! $errors->first('role', '<p class="help-block">:message</p>') !!}
							    </div>
							</div> -->
							<div class="form-group{{ $errors->has('hashtags') ? ' has-error' : '' }}">
								{!! Form::label('hashtags', 'Hashtags', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
			                        <input id="hashtags" placeholder="Hashtags" type="text" class="form-control" name="hashtags" value="{{ old('hashtags') }}" autofocus>
							    </div>

		                        @if ($errors->has('hashtags'))
		                            <span class="help-block">
		                                <strong>{{ $errors->first('hashtags') }}</strong>
		                            </span>
		                        @endif
		                    </div>

							<div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
							    {!! Form::label('preferred_medium', 'Your hashtags', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
								    <ul style="overflow-x: hidden; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">

							    	@foreach(Auth::user()->Users_Roles_hashtags as $hashtags)
	                                    <li class="list-group-item text-right">
	                                        <span class="pull-left">
	                                            <strong class="">
	                                                {!! \App\Hashtags::findOrFail($hashtags->hashtags_id)->tags; !!}
	                                            </strong>
	                                        </span> 
	                                        <a href="\users_preferred_medium_remove/{{ $hashtags->id }}" class="btn btn-danger">REMOVE</a>
	                                    </li>
                                    @endforeach
								    </ul>
							    </div>
							</div>

							<div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
							    {!! Form::label('preferred_medium', 'Prefered medium from DB', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
								    <ul style="overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
								    <?php
								    $temp = array();
								    foreach (Auth::user()->Users_preferred_medium as $key => $value) {
								     	$temp[] = $value->preferred_medium_id;
								     } 
								    // vv($temp);
								    ?>
								    	@foreach($preferred_medium as $key => $value)
								    		@if(!in_array($value->id,$temp))
			                                <li class="list-group-item text-right">
			                                    <span class="pull-left">
			                                        <strong class="">
			                                        {{ $value->preferred_medium_title }}
			                                        </strong><br>
			                                    </span>
			                                    <a href="\users_preferred_medium_add/{{ $value->id }}" class="btn btn-primary">ADD</a>
			                                </li>
			                                @endif
			                            @endforeach
								    </ul>
							    </div>
							</div>

							<div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
							    {!! Form::label('preferred_medium', 'Your Prefered Medium', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
								    <ul style="overflow-x: hidden; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
								    	@foreach(Auth::user()->Users_preferred_medium as $preferred_medium)
								    		<li class="list-group-item text-right">
			                                    <span class="pull-left">
			                                        <strong class="">
			                                        {!! \App\Preferred_medium::findOrFail($preferred_medium->preferred_medium_id)->preferred_medium_title; !!}
			                                        </strong>
			                                    </span>
			                                    <a href="\users_preferred_medium_remove/{{ $preferred_medium->id }}" class="btn btn-danger">REMOVE</a>
			                                </li>
	                                    @endforeach
								    </ul>
							        {!! $errors->first('preferred_medium', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<div class="form-group {{ $errors->has('youtube_page_url') ? 'has-error' : ''}}">
							    {!! Form::label('youtube_page_url', 'Portfolio', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							    	<?php 
                                        if(Auth::user()->Users_portfolio->isEmpty()){
                                            echo "No portfolio";
                                        }else{
                                    ?>
	                                        <table class="table">
	                                            <th>S.no</th>
	                                            <th>Link</th>
	                                            <th>Description</th>
	                                            <th>Action</th>
	                                            @foreach(Auth::user()->Users_portfolio as $key => $portfolio)
	                                                <tr>
	                                                    <td>
	                                                    	{{ $portfolio->id }}
	                                                    </td>
	                                                    <td>
	                                                    	<input type="text" value="{{ $portfolio->link }}" name="portfolio_link_{{ $portfolio->id }}" id="portfolio_link_{{ $portfolio->id }}" >
                                                    	</td>
	                                                    <td>
	                                                    	<input type="text" value="{{ $portfolio->description }}" name="portfolio_description_{{ $portfolio->id }}" id="portfolio_description_{{ $portfolio->id }}" >
                                                    	</td>
                                                    	<td>
	                                                    	<input type="text" value="{{ $portfolio->description }}" name="portfolio_description_{{ $portfolio->id }}" id="portfolio_description_{{ $portfolio->id }}" >
                                                    	</td>
	                                                </tr>
	                                            @endforeach
	                                        </table>
                                    <?php    
                                        } 
                                    ?>
							        {!! $errors->first('youtube_page_url', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

							<div class="form-group {{ $errors->has('instagram_page_url') ? 'has-error' : ''}}">
							    {!! Form::label('instagram_page_url', 'Previous Campaign', ['class' => 'col-md-4 control-label']) !!}
							    <div class="col-md-6">
							        {!! Form::text('instagram_page_url', null, ['class' => 'form-control']) !!}
							        {!! $errors->first('instagram_page_url', '<p class="help-block">:message</p>') !!}
							    </div>
							</div>

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
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                @if(Session::has('alert'))
                <div class="alert alert-success">
                    {{ Session::get('alert') }}
                    @php
                    Session::forget('alert');
                    @endphp
                </div>
                @endif
                <div class="panel-heading">Register</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name or social media account name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('my_assets') ? ' has-error' : '' }}">
                            <label for="my_assets" class="col-md-4 control-label">My assets</label>

                            <div class="col-md-6">
                                <!-- <input id="my_assets" type="email" class="form-control" name="email" value="{{ old('email') }}" required> -->
                                <select name="my_assets" class="form-control" id="my_assets">
                                    <option value="Instagram‎">Instagram‎</option>
                                    <option value="Bussiness">Bussiness</option>
                                    <option value="YouTube‎">YouTube‎</option>
                                    <option value="Facebook‎">Facebook‎</option>
                                    <option value="Twitter‎">Twitter‎</option>
                                    <option value="Blog‎">Blog‎</option>
                                    <option value="Other‎">Other‎</option>
                                </select>

                                @if ($errors->has('my_assets'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('my_assets') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('hashtags') ? ' has-error' : '' }}">
                            <label for="hashtags" class="col-md-4 control-label">Hashtags</label>

                            <div class="col-md-6">
                                    @foreach($hashtags as $tags)
                                        <input type="checkbox" value="{{ $tags->id }}" name="hashtags[]" id="hashtags[]"> {{ $tags->tags }}<br>
                                    @endforeach
                                <!-- <select name="hashtags" class="form-control" id="hashtags"> -->
<!--                                     <option value="Academics">Academics</option>
                                    <option value="Bussiness">Bussiness</option>
                                    <option value="Media">Media</option>
                                    <option value="Music">Music</option>
                                    <option value="News and journalism">News and journalism</option>
                                    <option value="Politics">Politics</option>
                                    <option value="Sports">Sports</option> -->
                                <!-- </select> -->
                                @if ($errors->has('hashtags'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('hashtags') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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
                <div class="panel-heading">Register as a Marketer</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('/jobseeker_register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

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

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('countery') ? ' has-error' : '' }}">
                            <label for="countery" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <select name="countery" class="form-control" id="countery">
                                    <option value="Pakistan">Pakistan</option>
                                    <option value="India">India</option>
                                    <option value="America">America</option>
                                    <option value="Russia">Russia</option>
                                </select>
                                @if ($errors->has('countery'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('countery') }}</strong>
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


                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Agency / Company details</p>                               
                            </div>
                        </div>
                        <hr>


                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                            <label for="company_name" class="col-md-4 control-label">Agency / Company name</label>

                            <div class="col-md-6">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
                            <label for="logo" class="col-md-4 control-label">Logo</label>

                            <div class="col-md-6">
                                <input id="logo" type="file"  name="logo" value="{{ old('logo') }}" required autofocus>

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">
                            <label for="website" class="col-md-4 control-label">Website</label>

                            <div class="col-md-6">
                                <input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" required autofocus>

                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('facebook_url') ? ' has-error' : '' }}">
                            <label for="facebook_url" class="col-md-4 control-label">Facebook.com/</label>

                            <div class="col-md-6">
                                <input id="facebook_url" type="text" class="form-control" name="facebook_url" value="{{ old('facebook_url') }}" required autofocus>

                                @if ($errors->has('facebook_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                            <label for="twitter_url" class="col-md-4 control-label">Twitter.com</label>

                            <div class="col-md-6">
                                <input id="twitter_url" type="text" class="form-control" name="twitter_url" value="{{ old('twitter_url') }}" required autofocus>

                                @if ($errors->has('twitter_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Have you used influencers in previous campaigns?</p>                               
                            </div>
                        </div>
                        <hr>

                        <div class="form-group{{ $errors->has('campaigns') ? ' has-error' : '' }}">
                            <label for="campaigns" class="col-md-4 control-label">Option</label>

                            <div class="col-md-6">
                                <input id="campaigns" type="radio"  name="campaigns" value="{{ old('campaigns') }}" placeholder="" autofocus>Yes &nbsp&nbsp
                                <input id="campaigns" type="radio"  name="campaigns" value="{{ old('campaigns') }}" placeholder="" autofocus>No

                                @if ($errors->has('campaigns'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaigns') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('influencer_used') ? ' has-error' : '' }}">
                            <label for="influencer_used" class="col-md-4 control-label">Influencer used</label>

                            <div class="col-md-6">
                                <input id="influencer_used" type="text" class="form-control" name="influencer_used" value="{{ old('influencer_used') }}" required autofocus>

                                @if ($errors->has('influencer_used'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('influencer_used') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">
                            <label for="link_p" class="col-md-4 control-label">Link</label>

                            <div class="col-md-6">
                                <input id="link_p" type="text" class="form-control" name="link_p" value="{{ old('link_p') }}" required autofocus>

                                @if ($errors->has('link_p'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_p') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}">
                            <label for="description_p" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="description_p" type="text" class="form-control" name="description_p" value="{{ old('description_p') }}" required autofocus>

                                @if ($errors->has('description_p'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_p') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}">

                            <div class="col-md-6">
                                <button></button>
                                @if ($errors->has('description_p'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_p') }}</strong>
                                    </span>
                                @endif
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

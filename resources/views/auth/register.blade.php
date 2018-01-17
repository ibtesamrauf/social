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
                            <label for="countery" class="col-md-4 control-label">Countery</label>

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

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-4 control-label">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Your alias, company , how you are known etc" required autofocus>

                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('my_assets') ? ' has-error' : '' }}">
                            <label for="my_assets" class="col-md-4 control-label">My assets</label>

                            <div class="col-md-6">
                                <!-- <input id="my_assets" type="email" class="form-control" name="email" value="{{ old('email') }}" required> -->
                                <input type="checkbox" value="Instagram‎" name="my_assets[]" id="my_assets[]">Instagram‎<br>                                
                                <input type="checkbox" value="Bussiness" name="my_assets[]" id="my_assets[]">Bussiness<br>
                                <input type="checkbox" value="YouTube‎" name="my_assets[]" id="my_assets[]">YouTube‎<br>
                                <input type="checkbox" value="Facebook‎" name="my_assets[]" id="my_assets[]">Facebook‎<br>
                                <input type="checkbox" value="Twitter‎" name="my_assets[]" id="my_assets[]">Twitter‎<br>
                                <input type="checkbox" value="Blog‎" name="my_assets[]" id="my_assets[]">Blog‎<br>
                                <input type="checkbox" value="Other‎" name="my_assets[]" id="my_assets[]">Other‎<br>

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
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Enter hashtags like #new #old #fancy #buy" required autofocus>

                                @foreach($hashtags as $tags)
                                    <!-- <input type="checkbox" value="{{ $tags->id }}" name="hashtags[]" id="hashtags[]"> {{ $tags->tags }}<br> -->
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
                        
                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">

                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Where can we find you?</p>                               
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('faebook_url') ? ' has-error' : '' }}">
                            <label for="faebook_url" class="col-md-4 control-label">Facebook.com/</label>

                            <div class="col-md-6">
                                <input id="faebook_url" type="text" class="form-control" name="faebook_url" value="{{ old('faebook_url') }}" placeholder="Page url" autofocus>

                                @if ($errors->has('faebook_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('faebook_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('instagram_url') ? ' has-error' : '' }}">
                            <label for="instagram_url" class="col-md-4 control-label">Instagram.com/</label>

                            <div class="col-md-6">
                                <input id="instagram_url" type="text" class="form-control" name="instagram_url" value="{{ old('instagram_url') }}" placeholder="Profile url" autofocus>

                                @if ($errors->has('instagram_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('instagram_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                            <label for="youtube_url" class="col-md-4 control-label">Youtube.com/</label>

                            <div class="col-md-6">
                                <input id="youtube_url" type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="channel url" autofocus>

                                @if ($errors->has('youtube_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('youtube_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                            <label for="twitter_url" class="col-md-4 control-label">Twitter.com/</label>

                            <div class="col-md-6">
                                <input id="twitter_url" type="text" class="form-control" name="twitter_url" value="{{ old('twitter_url') }}" placeholder="Profile url" autofocus>

                                @if ($errors->has('twitter_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('soundcloud_url') ? ' has-error' : '' }}">
                            <label for="soundcloud_url" class="col-md-4 control-label">Soundcloud.com/</label>

                            <div class="col-md-6">
                                <input id="soundcloud_url" type="text" class="form-control" name="soundcloud_url" value="{{ old('soundcloud_url') }}" placeholder="Profile url" autofocus>

                                @if ($errors->has('soundcloud_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('soundcloud_url') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('website_blog') ? ' has-error' : '' }}">
                            <label for="website_blog" class="col-md-4 control-label">Website / blog</label>

                            <div class="col-md-6">
                                <input id="website_blog" type="text" class="form-control" name="website_blog" value="{{ old('website_blog') }}" placeholder="Url" autofocus>

                                @if ($errors->has('website_blog'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website_blog') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('monthly_visitors') ? ' has-error' : '' }}">
                            <label for="monthly_visitors" class="col-md-4 control-label">Snapchat</label>

                            <div class="col-md-6">
                                <input id="monthly_visitors" type="text" class="form-control" name="monthly_visitors" value="{{ old('monthly_visitors') }}" placeholder="Url" autofocus>

                                @if ($errors->has('monthly_visitors'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('monthly_visitors') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <!-- <label for="title" class="col-md-4 control-label"></label> -->

                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">What is your preferred medium of content (tick all that apply)</p>                               
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('preferred_medium') ? ' has-error' : '' }}">
                            <label for="preferred_medium" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                @foreach($preferred_medium as $preferred_medium_value)
                                    <!-- <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]"> {{ $preferred_medium_value->preferred_medium_title }}<br> -->
                                @endforeach
                                
                                <input type="checkbox" value="1" name="preferred_medium[]" id="preferred_medium[]">Recorded Video<br>
                                <input type="checkbox" value="2" name="preferred_medium[]" id="preferred_medium[]">Live Video<br>
                                <input type="checkbox" value="3" name="preferred_medium[]" id="preferred_medium[]">Photos<br>
                                <input type="checkbox" value="4" name="preferred_medium[]" id="preferred_medium[]">Blog Posts<br>
                                <input type="checkbox" value="5" name="preferred_medium[]" id="preferred_medium[]">Tweets<br>
                                <input type="checkbox" value="6" name="preferred_medium[]" id="preferred_medium[]">Long Form Articles<br>
                   
                                @if ($errors->has('preferred_medium'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('preferred_medium') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Portfolio: (optional)</p>                               
                            </div>
                        </div>
                        <hr>

                        <div class="form-group{{ $errors->has('link_p[]') ? ' has-error' : '' }}">
                            <label for="link_p[]" class="col-md-4 control-label">link 1</label>

                            <div class="col-md-6">
                                <input id="link_p[]" type="text" class="form-control" name="link_p[]" value="{{ old('link_p[]') }}" placeholder="" autofocus>

                                @if ($errors->has('link_p[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_p[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description[]') ? ' has-error' : '' }}">
                            <label for="description[]" class="col-md-4 control-label">Description 1</label>

                            <div class="col-md-6">
                                <input id="description[]" type="text" class="form-control" name="description[]" value="{{ old('description[]') }}" placeholder="" autofocus>

                                @if ($errors->has('description[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('link_p[]') ? ' has-error' : '' }}">
                            <label for="link_p[]" class="col-md-4 control-label">link 2</label>

                            <div class="col-md-6">
                                <input id="link_p[]" type="text" class="form-control" name="link_p[]" value="{{ old('link_p[]') }}" placeholder="" autofocus>

                                @if ($errors->has('link_p[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_p[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description[]') ? ' has-error' : '' }}">
                            <label for="description[]" class="col-md-4 control-label">Description 2</label>

                            <div class="col-md-6">
                                <input id="description[]" type="text" class="form-control" name="description[]" value="{{ old('description[]') }}" placeholder="" autofocus>

                                @if ($errors->has('description[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('link_p[]') ? ' has-error' : '' }}">
                            <label for="link_p[]" class="col-md-4 control-label">link 3</label>

                            <div class="col-md-6">
                                <input id="link_p[]" type="text" class="form-control" name="link_p[]" value="{{ old('link_p[]') }}" placeholder="" autofocus>

                                @if ($errors->has('link_p[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link_p[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description[]') ? ' has-error' : '' }}">
                            <label for="description[]" class="col-md-4 control-label">Description 3</label>

                            <div class="col-md-6">
                                <input id="description[]" type="text" class="form-control" name="description[]" value="{{ old('description[]') }}" placeholder="" autofocus>

                                @if ($errors->has('description[]'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description[]') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Have you worked in any campaigns previously?</p>                               
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


                        <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                            <label for="client" class="col-md-4 control-label">Client</label>

                            <div class="col-md-6">
                                <input id="client" type="text" class="form-control" name="client" value="{{ old('client') }}" placeholder="" autofocus>

                                @if ($errors->has('client'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">
                            <label for="link" class="col-md-4 control-label">Link</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ old('link') }}" placeholder="" autofocus>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                            <label for="details" class="col-md-4 control-label">Details</label>

                            <div class="col-md-6">
                                <input id="details" type="text" class="form-control" name="details" value="{{ old('details') }}" placeholder="" autofocus>

                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description_3') }}</strong>
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

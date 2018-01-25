@extends('layouts.app')

@section('content')


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#add_another" ).click(function() {
          $( "#previously_campaigns" ).append('<br><div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}"><label for="client" class="col-md-4 control-label">Client</label><div class="col-md-6"><input id="client[]" type="text" class="form-control" name="client[]" value="" placeholder="" autofocus>@if ($errors->has('client'))<span class="help-block"><strong>{{ $errors->first('client') }}</strong></span>@endif</div></div><div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}"><label for="link" class="col-md-4 control-label">Link</label><div class="col-md-6"><input id="link[]" type="text" class="form-control" name="link[]" value="" placeholder="" autofocus>@if ($errors->has('link'))<span class="help-block"><strong>{{ $errors->first('link') }}</strong></span>@endif</div></div><div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}"><label for="details" class="col-md-4 control-label">Details</label><div class="col-md-6"><input id="details[]" type="text" class="form-control" name="details[]" value="" placeholder="" autofocus>@if ($errors->has('details'))<span class="help-block"><strong>{{ $errors->first('details') }}</strong></span>@endif</div></div>'); 
        });
    
        $("#previously_campaigns_div").css("display" , "block");

        $( 'input[type=radio][name=campaigns]' ).on('change',function() {
            // console.log(this.value+"change");
            if (this.value == 'yes') {
                $("#previously_campaigns_div").css("display" , "block");
            }
            else if (this.value == 'no') {
                $("#previously_campaigns_div").css("display" , "none");
            }
        });                                  

        $("#previously_campaigns_div").css("display" , "none");

        $( "#add_another_portfolio" ).click(function() {
            $( "#portfolio_div" ).append('<div class="form-group"><label for="link_p" class="col-md-4 control-label">link</label><div class="col-md-6"><input id="link_p[]" type="text" class="form-control" name="link_p[]"  placeholder="" ></div></div><div class="form-group"><label for="description" class="col-md-4 control-label">Description</label><div class="col-md-6"><input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="" ></div></div><br>'); 
        });
    });
    

</script>


<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
        @if( count( $errors ) > 0 )
           @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
        @endif
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

                        <div class="form-group">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">General</p>                               
                            </div>
                        </div>
                        <!-- <hr> -->

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First Name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last Name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file" class="col-md-4 control-label">Profile picture</label>

                            <div class="col-md-6">
                                <input id="file" type="file"  name="file"  required >
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

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <select name="country" class="form-control" id="country">
                                    @foreach($country1 as $country_value)
                                        <option value="{{ $country_value->id }}">{{ $country_value->country_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
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

                        
                        <div class="form-group{{ $errors->has('hashtags') ? ' has-error' : '' }}">
                            <label for="hashtags" class="col-md-4 control-label">Hashtags</label>

                            <div class="col-md-6">
                                <input id="hashtags" type="text" class="form-control" name="hashtags"  placeholder="Enter Hashtags that you would relate to your profile, content etc." required autofocus>

                                
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
                        <div class="form-group">

                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Where can we find you?</p>                               
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('faebook_url') ? ' has-error' : '' }}">
                            <label for="faebook_url" style=" padding-right: 0px; " class="col-md-4 control-label">Facebook.com/</label>

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
                            <label for="instagram_url" style=" padding-right: 0px; " class="col-md-4 control-label">Instagram.com/</label>

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
                            <label for="youtube_url" style=" padding-right: 0px; " class="col-md-4 control-label">Youtube.com/</label>

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
                            <label for="twitter_url" style=" padding-right: 0px; " class="col-md-4 control-label">Twitter.com/</label>

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
                            <label for="soundcloud_url" style=" padding-right: 0px; " class="col-md-4 control-label">Soundcloud.com/</label>

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
                            <label for="website_blog" style=" padding-right: 0px; " class="col-md-4 control-label">Website / blog</label>

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
                            <label for="monthly_visitors" style=" padding-right: 0px; " class="col-md-4 control-label">blog average monthly visitors</label>

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
                        <div class="form-group">
                            <!-- <label for="" class="col-md-4 control-label"></label> -->

                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">What is your preferred medium of content (tick all that apply)</p>                               
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('preferred_medium') ? ' has-error' : '' }}">
                            <label for="preferred_medium" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                @foreach($preferred_medium_value as $preferred_medium_value)
                                    <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]"> {{ $preferred_medium_value->preferred_medium_title }}<br>
                                    <?php 
                                        if($preferred_medium_value->preferred_medium_title  == "Others"){
                                    ?>
                                        <span><input id="others" name="others" type="text"></span>
                                    <?php
                                        }
                                    ?>
                                @endforeach    
                                    <!-- <input type="checkbox" value="other" name="preferred_medium[]" id="preferred_medium[]"> {{ $preferred_medium_value->preferred_medium_title }}<br> -->

                                @if ($errors->has('preferred_medium'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('preferred_medium') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <hr>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Portfolio: (optional)</p>                               
                            </div>
                        </div>
                        <hr>
                        <div id="portfolio_div">
                            <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">
                                <label for="link_p" class="col-md-4 control-label">link</label>

                                <div class="col-md-6">
                                    <input id="link_p[]" type="text" class="form-control" name="link_p[]"  placeholder="" >

                                    @if ($errors->has('link_p'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('link_p') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="" >

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">
                                <label for="link_p" class="col-md-4 control-label">link</label>

                                <div class="col-md-6">
                                    <input id="link_p[]" type="text" class="form-control" name="link_p[]" value="" placeholder="" >

                                    @if ($errors->has('link_p'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('link_p') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="" >

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">
                                <label for="link_p" class="col-md-4 control-label">link</label>

                                <div class="col-md-6">
                                    <input id="link_p[]" type="text" class="form-control" name="link_p[]" value="" placeholder="" >

                                    @if ($errors->has('link_p'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('link_p') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <label for="description" class="col-md-4 control-label">Description</label>

                                <div class="col-md-6">
                                    <input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="" >

                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="" class="col-md-4 control-label"></label>
                            <div class="col-md-6">
                                <a id="add_another_portfolio" class="btn btn-primary">Add Another</a>
                            </div>
                        </div>

                        <hr>
                        <div class="form-group">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Have you worked in any campaigns previously?</p>                               
                            </div>
                        </div>
                        <hr>
                        
                        <div class="form-group{{ $errors->has('campaigns') ? ' has-error' : '' }}">
                            <label for="campaigns" class="col-md-4 control-label">Option</label>

                            <div class="col-md-6">
                                <input id="campaigns" type="radio" name="campaigns" value="yes" placeholder="" >Yes &nbsp&nbsp
                                <input id="campaigns" type="radio" checked name="campaigns" value="no" placeholder="" >No

                                @if ($errors->has('campaigns'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaigns') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        

                        <div id="previously_campaigns_div" style=" display:none; ">
                            <div id="previously_campaigns">
                                <div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}">
                                    <label for="client" class="col-md-4 control-label">Client</label>

                                    <div class="col-md-6">
                                        <input id="client[]" type="text" class="form-control" name="client[]" value="" placeholder="" autofocus>

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
                                        <input id="link[]" type="text" class="form-control" name="link[]" value="" placeholder="" autofocus>

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
                                        <input id="details[]" type="text" class="form-control" name="details[]" value="" placeholder="" autofocus>

                                        @if ($errors->has('details'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('details') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <a id="add_another" class="btn btn-primary">Add Another</a>
                                </div>
                            </div>

                        </div>

                        <hr>
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

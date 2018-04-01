@extends('layouts.app')

@section('content')
    
    <div class="main">
        <section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Login-Register</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
          <div class="container">
            @if(Session::has('alert'))
                <div class="alert alert-success">
                    {{ Session::get('alert') }}
                    @php
                    Session::forget('alert');
                    @endphp
                </div>
            @endif
            <div class="row">
              <div class="col-sm-8 col-sm-offset-2 mb-sm-40" align="center">
                <h3 class="font-alt">General</h3>
                <hr class="divider-w mb-10">
                <!-- <form class="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data"> -->
                <form class="form-horizontal" method="POST" action="{{ url('/jobseeker_register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">

                            <input id="first_name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" placeholder="First Name" required autofocus>

                            @if ($errors->has('first_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('first_name') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">

                                <input id="name1" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name" required autofocus>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                        </div>
                        

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="Phone number" required autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">

                                <select name="country" class="form-control" id="country">
                                    <option>Select</option>
                                    @foreach($country as $country_value)
                                        <option value="{{ $country_value->id }}" @if (old('country') == $country_value->id) selected="selected" @endif>{{ $country_value->country_name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input id="password" placeholder="Password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group">
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required>
                        </div>


                        <hr>
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <div class="col-md-12">
                                <p align="center" style=" font-size: 22px; ">Agency / Company details</p>                               
                            </div>
                        </div>
                        <hr>


                        <div class="form-group{{ $errors->has('company_name') ? ' has-error' : '' }}">
                                <input id="company_name" type="text" class="form-control" name="company_name" value="{{ old('company_name') }}" placeholder="Agency / Company name" required autofocus>

                                @if ($errors->has('company_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('company_name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">

                                <input id="logo" type="file" class="form-control" name="logo" required autofocus>

                                @if ($errors->has('logo'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('logo') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">

                                <input id="website" placeholder="Website" type="text" class="form-control" name="website" value="{{ old('website') }}" required autofocus>

                                @if ($errors->has('website'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('website') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('facebook_url') ? ' has-error' : '' }}">

                                <input id="facebook_url" placeholder="Facebook.com" type="text" class="form-control" name="facebook_url" value="{{ old('facebook_url') }}" required autofocus>

                                @if ($errors->has('facebook_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('facebook_url') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <!-- <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}"> -->
                                <input id="twitter_url" placeholder="Twitter.com" type="hidden" class="form-control" name="twitter_url" value="tweet" autofocus>

                        <!-- </div> -->

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                                <input id="description" placeholder="Description" type="text" class="form-control" name="description" value="{{ old('description') }}" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
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
                                <input id="campaigns" type="radio" name="campaigns" value="yes" placeholder="" autofocus>Yes &nbsp&nbsp
                                <input id="campaigns1" type="radio" checked name="campaigns" value="no" placeholder="" autofocus>No

                                @if ($errors->has('campaigns'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('campaigns') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div id="previously_campaigns_div" style=" display:none; ">
                            <div id="previously_campaigns">
                                <div class="form-group{{ $errors->has('influencer_used') ? ' has-error' : '' }}">
                                        <input id="influencer_used[]" type="text" class="form-control" name="influencer_used[]" placeholder="Influencer used"  autofocus>

                                        @if ($errors->has('influencer_used'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('influencer_used') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="campaign_link_div" >
                                    <div class="form-group{{ $errors->has('campaign_link') ? ' has-error' : '' }}">
                                            <input id="campaign_link[]" type="text" class="form-control" placeholder="Campaign Link" name="campaign_link[]" autofocus>
                                            <a class="add_another_link btn btn-primary" >+</a>
                                            @if ($errors->has('campaign_link'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('campaign_link') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}">
                                        <input id="description_p[]" type="text" class="form-control" name="description_p[]" placeholder="Description" autofocus>

                                        @if ($errors->has('description_p'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description_p') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            
                            </div>

                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                                <label for="details" class="col-md-4 control-label"></label>
                                <div class="col-md-6">
                                    <a id="add_another" class="btn btn-primary">Add Another</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                    <div class="form-group">                    
                        <button type="submit" class="btn btn-block btn-round btn-b">
                            Register
                        </button>
                    </div>
                </form>
                <hr>
                    
                <div class="form-group">
                    <div class="">
                        <!-- <a href="{{ url('/auth_marketer/github') }}" class="btn btn-github"><i class="fa fa-github"></i> Github</a> -->
                        <a href="{{ url('/auth_marketer/facebook') }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                        <a href="{{ url('/auth_marketer/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>
                        <!-- <a href="{{ url('/auth_marketer/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a> -->

                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        @include('layouts.footer')
      </div>
      <div class="scroll-up">
        <a href="#totop">
            <i class="fa fa-angle-double-up">
            
            </i>
        </a>
      </div>


<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#add_another" ).click(function() {
            console.log("asdasd");
            $( "#previously_campaigns" ).append('<br><div class="form-group{{ $errors->has('influencer_used') ? ' has-error' : '' }}"><input id="influencer_used[]" type="text" class="form-control" name="influencer_used[]" placeholder="Influencer used" autofocus>@if ($errors->has('influencer_used'))<span class="help-block"><strong>{{ $errors->first('influencer_used') }}</strong></span>@endif</div><div class="campaign_link_div1"><div class="form-group{{ $errors->has('campaign_link') ? ' has-error' : '' }}"><input id="campaign_link[]" type="text" class="form-control" placeholder="Campaign Link" name="campaign_link[]"   autofocus><a id="add_another_link1"class="btn btn-primary" >+</a>@if ($errors->has('campaign_link'))<span class="help-block"><strong>{{ $errors->first('campaign_link') }}</strong></span>@endif</div></div><div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}"><input id="description_p[]" type="text" class="form-control" name="description_p[]" placeholder="Description" autofocus>@if ($errors->has('description_p'))<span class="help-block"><strong>{{ $errors->first('description_p') }}</strong></span>@endif</div>'); 
        });
    
        $("#previously_campaigns_div").css("display" , "block");

        $( 'input[type=radio][name=campaigns]' ).on('change',function() {
            console.log(this.value+"change");
            if (this.value == 'yes') {
                $("#previously_campaigns_div").css("display" , "block");
            }
            else if (this.value == 'no') {
                $("#previously_campaigns_div").css("display" , "none");
            }
        });  

        $( ".add_another_link" ).click(function() {
            console.log("asdsd");
            $( ".campaign_link_div" ).append('<div class="form-group{{ $errors->has('campaign_link') ? ' has-error' : '' }}"><input placeholder="Campaign Link" id="campaign_link[]" type="text" class="form-control" name="campaign_link[]"  required autofocus>@if ($errors->has('campaign_link'))<span class="help-block"><strong>{{ $errors->first('campaign_link') }}</strong></span>@endif</div>'); 
        });


        $( "#add_another_link1" ).click(function() {
            console.log("new new new");
        });

        $("#previously_campaigns_div").css("display" , "none");
    });
</script>

@endsection

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

                                <input id="logo" type="file" class="form-control" name="logo" value="{{ old('logo') }}" required autofocus>

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

                        <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                                <input id="twitter_url" placeholder="Twitter.com" type="text" class="form-control" name="twitter_url" value="{{ old('twitter_url') }}" required autofocus>

                                @if ($errors->has('twitter_url'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('twitter_url') }}</strong>
                                    </span>
                                @endif
                        </div>

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
                                <input id="campaigns" type="radio" name="campaigns" value="yes{{ old('campaigns') }}" placeholder="" autofocus>Yes &nbsp&nbsp
                                <input id="campaigns1" type="radio" checked name="campaigns" value="no{{ old('campaigns') }}" placeholder="" autofocus>No

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
                                        <input id="influencer_used" type="text" class="form-control" name="influencer_used" placeholder="Influencer used" value="{{ old('influencer_used') }}" autofocus>

                                        @if ($errors->has('influencer_used'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('influencer_used') }}</strong>
                                            </span>
                                        @endif
                                </div>

                                <div class="campaign_link_div" >
                                    <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">
                                            <input id="link_p" type="text" class="form-control" placeholder="Campaign Link" name="link_p" value="{{ old('link_p') }}" autofocus>
                                            <a class="add_another_link btn btn-primary" >+</a>
                                            @if ($errors->has('link_p'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('link_p') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>

                                <div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}">
                                        <input id="description_p" type="text" class="form-control" name="description_p" placeholder="Description" value="{{ old('description_p') }}" autofocus>

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
              </div>
            </div>
          </div>
        </section>
        <div class="module-small bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">About Titan</h5>
                  <p>The languages only differ in their grammar, their pronunciation and their most common words.</p>
                  <p>Phone: +1 234 567 89 10</p>Fax: +1 234 567 89 10
                  <p>Email:<a href="#">somecompany@example.com</a></p>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Recent Comments</h5>
                  <ul class="icon-list">
                    <li>Maria on <a href="#">Designer Desk Essentials</a></li>
                    <li>John on <a href="#">Realistic Business Card Mockup</a></li>
                    <li>Andy on <a href="#">Eco bag Mockup</a></li>
                    <li>Jack on <a href="#">Bottle Mockup</a></li>
                    <li>Mark on <a href="#">Our trip to the Alps</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Blog Categories</h5>
                  <ul class="icon-list">
                    <li><a href="#">Photography - 7</a></li>
                    <li><a href="#">Web Design - 3</a></li>
                    <li><a href="#">Illustration - 12</a></li>
                    <li><a href="#">Marketing - 1</a></li>
                    <li><a href="#">Wordpress - 16</a></li>
                  </ul>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="widget">
                  <h5 class="widget-title font-alt">Popular Posts</h5>
                  <ul class="widget-posts">
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-1.jpg" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="#">Designer Desk Essentials</a></div>
                        <div class="widget-posts-meta">23 january</div>
                      </div>
                    </li>
                    <li class="clearfix">
                      <div class="widget-posts-image"><a href="#"><img src="assets/images/rp-2.jpg" alt="Post Thumbnail"/></a></div>
                      <div class="widget-posts-body">
                        <div class="widget-posts-title"><a href="#">Realistic Business Card Mockup</a></div>
                        <div class="widget-posts-meta">15 February</div>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <hr class="divider-d">
        <footer class="footer bg-dark">
          <div class="container">
            <div class="row">
              <div class="col-sm-6">
                <p class="copyright font-alt">&copy; 2017&nbsp;<a href="index.html">TitaN</a>, All Rights Reserved</p>
              </div>
              <div class="col-sm-6">
                <div class="footer-social-links"><a href="#"><i class="fa fa-facebook"></i></a><a href="#"><i class="fa fa-twitter"></i></a><a href="#"><i class="fa fa-dribbble"></i></a><a href="#"><i class="fa fa-skype"></i></a>
                </div>
              </div>
            </div>
          </div>
        </footer>
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
            $( "#previously_campaigns" ).append('<br><div class="form-group{{ $errors->has('influencer_used') ? ' has-error' : '' }}"><input id="influencer_used" type="text" class="form-control" name="influencer_used" value="{{ old('influencer_used') }}" placeholder="Influencer used" autofocus>@if ($errors->has('influencer_used'))<span class="help-block"><strong>{{ $errors->first('influencer_used') }}</strong></span>@endif</div><div class="campaign_link_div1"><div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}"<input id="link_p" type="text" class="form-control" placeholder="Campaign Link" name="link_p" value="{{ old('link_p') }}"  autofocus><a id="add_another_link1"class="btn btn-primary" >+</a>@if ($errors->has('link_p'))<span class="help-block"><strong>{{ $errors->first('link_p') }}</strong></span>@endif</div></div><div class="form-group{{ $errors->has('description_p') ? ' has-error' : '' }}"><input id="description_p" type="text" class="form-control" name="description_p" placeholder="Description" value="{{ old('description_p') }}" autofocus>@if ($errors->has('description_p'))<span class="help-block"><strong>{{ $errors->first('description_p') }}</strong></span>@endif</div>'); 
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
            $( ".campaign_link_div" ).append('<div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}"><input placeholder="Campaign Link" id="link_p" type="text" class="form-control" name="link_p" value="{{ old('link_p') }}" required autofocus>@if ($errors->has('link_p'))<span class="help-block"><strong>{{ $errors->first('link_p') }}</strong></span>@endif</div>'); 
        });


        $( "#add_another_link1" ).click(function() {
            console.log("new new new");
        });

        $("#previously_campaigns_div").css("display" , "none");
    });
</script>

@endsection

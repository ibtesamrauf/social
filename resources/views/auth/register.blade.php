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
                <h3 class="font-alt">Register</h3>
                <hr class="divider-w mb-10">
                <form class="form" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                <!-- <form class="form"> -->
                  
                  <!-- <div class="form-group">
                    <input class="form-control" id="E-mail" type="text" name="email" placeholder="Email"/>
                  </div> -->
















                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                        <input id="first_name" placeholder="First Name" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>
                        @if ($errors->has('first_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('first_name') }}</strong>
                            </span>
                        @endif
                    </div>



                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                        <input id="last_name" placeholder="Last Name" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>

                        @if ($errors->has('last_name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('last_name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">    
                        <input id="phone_number" placeholder="Phone number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                        @if ($errors->has('phone_number'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone_number') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input id="email" placeholder="E-Mail Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <!-- <label for="file" class="col-md-4 control-label">Profile picture</label> -->

                        <!-- <div class="col-md-6"> -->
                            <input id="file" placeholder="Profile Picture" class="form-control" type="file"  name="file" value="{{old('file')}}" required >
                        <!-- </div> -->
                    </div>

                    <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                        <select name="country" class="form-control" id="country">
                            <option>Select</option>
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

                    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                        <input id="title" placeholder="Title" type="text" class="form-control" name="title" value="{{ old('title') }}" placeholder="Your alias, company , how you are known etc" required autofocus>
                        @if ($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>

                        
                    <div class="form-group{{ $errors->has('hashtags') ? ' has-error' : '' }}">
                        <input id="hashtags" placeholder="Hashtags" type="text" class="form-control" name="hashtags" value="{{ old('hashtags') }}"  placeholder="Enter Hashtags that you would relate to your profile, content etc." required autofocus>
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
                    <div class="form-group">

                        <div class="col-md-12">
                            <p align="center" style=" font-size: 22px; ">Where can we find you?</p>                               
                        </div>
                    </div>
                    <hr>
                    
                    <div class="form-group{{ $errors->has('faebook_url') ? ' has-error' : '' }}">
                        <input id="faebook_url" placeholder="Facebook.com/" type="text" class="form-control" name="faebook_url" value="{{ old('faebook_url') }}" placeholder="Page url" autofocus>

                        @if ($errors->has('faebook_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('faebook_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('instagram_url') ? ' has-error' : '' }}">

                        <input id="instagram_url" placeholder="Instagram.com/" type="text" class="form-control" name="instagram_url" value="{{ old('instagram_url') }}" placeholder="Profile url" autofocus>

                        @if ($errors->has('instagram_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('instagram_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('youtube_url') ? ' has-error' : '' }}">
                       
                        <input id="youtube_url" placeholder="Youtube.com/" type="text" class="form-control" name="youtube_url" value="{{ old('youtube_url') }}" placeholder="channel url" autofocus>

                        @if ($errors->has('youtube_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('youtube_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('twitter_url') ? ' has-error' : '' }}">
                        
                        <input id="twitter_url" placeholder="Twitter.com/" type="text" class="form-control" name="twitter_url" value="{{ old('twitter_url') }}" placeholder="Profile url" autofocus>

                        @if ($errors->has('twitter_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('twitter_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('soundcloud_url') ? ' has-error' : '' }}">
                        
                        <input id="soundcloud_url" placeholder="Soundcloud.com/" type="text" class="form-control" name="soundcloud_url" value="{{ old('soundcloud_url') }}" placeholder="Profile url" autofocus>

                        @if ($errors->has('soundcloud_url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('soundcloud_url') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('website_blog') ? ' has-error' : '' }}">
                        
                        <input id="website_blog" type="text" class="form-control" name="website_blog" value="{{ old('website_blog') }}" placeholder="Website / blog" autofocus>

                        @if ($errors->has('website_blog'))
                            <span class="help-block">
                                <strong>{{ $errors->first('website_blog') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('monthly_visitors') ? ' has-error' : '' }}">
                        
                        <input id="monthly_visitors" type="text" class="form-control" name="monthly_visitors" value="{{ old('monthly_visitors') }}" placeholder="blog average monthly visitors" autofocus>

                        @if ($errors->has('monthly_visitors'))
                            <span class="help-block">
                                <strong>{{ $errors->first('monthly_visitors') }}</strong>
                            </span>
                        @endif
                    </div>

                    
                    <hr>
                    <div class="form-group">
                        <!-- <label for="" class="col-md-4 control-label"></label> -->

                        <div class="col-md-12">
                            <p align="center" style=" font-size: 22px; ">What is your preferred medium of content <span style=" font-size: 18px; "> (tick all that apply) </span></p>                               
                        </div>
                    </div>
                    <hr>
                    
                    <div class="form-group{{ $errors->has('preferred_medium') ? ' has-error' : '' }}">
                        <table>
                            @foreach($preferred_medium_value as $preferred_medium_value)
                            <tr>
                                <td>
                                    <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]" autofocus @if (old('preferred_medium') == $preferred_medium_value->id) selected="selected" @endif> {{ $preferred_medium_value->preferred_medium_title }}<br>
                                    <?php 
                                        if($preferred_medium_value->preferred_medium_title  == "Others"){
                                    ?>
                                        <span><input id="others" name="others" type="text"></span>
                                    <?php
                                        }
                                    ?>
                                </td>
                            </tr>
                            @endforeach    
                        </table>
                                <!-- <input type="checkbox" value="other" name="preferred_medium[]" id="preferred_medium[]"> {{ $preferred_medium_value->preferred_medium_title }}<br> -->

                            @if ($errors->has('preferred_medium'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('preferred_medium') }}</strong>
                                </span>
                            @endif
                    </div>
                        
                    <hr>
                    <div class="form-group">
                        <div class="col-md-12">
                            <p align="center" style=" font-size: 22px; ">Portfolio <span style=" font-size: 18px; "> optional</span> </p>                               
                        </div>
                    </div>
                    <hr>
                    <div id="portfolio_div">
                        <div class="form-group{{ $errors->has('link_p') ? ' has-error' : '' }}">    
                            <input id="link_p[]" type="text" class="form-control" name="link_p[]"  placeholder="link" >

                            @if ($errors->has('link_p'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('link_p') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="Description" >

                            @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                            @endif
                        </div>
                        <br>
                        
                    </div>

                    <div class="form-group">
                        <a id="add_another_portfolio" class="btn btn-primary">Add Another</a>
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

                                <input id="client[]" type="text" class="form-control" name="client[]" value="" placeholder="Client" autofocus>

                                @if ($errors->has('client'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('client') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}">

                                <input id="link[]" type="text" class="form-control" name="link[]" value="" placeholder="Link" autofocus>

                                @if ($errors->has('link'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('link') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">

                                <input id="details[]" type="text" class="form-control" name="details[]" value="" placeholder="Details" autofocus>

                                @if ($errors->has('details'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('details') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <a id="add_another" class="btn btn-primary">Add Another</a>
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
        @include('layouts.footer')
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
    

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#add_another" ).click(function() {
          $( "#previously_campaigns" ).append('<br><div class="form-group{{ $errors->has('client') ? ' has-error' : '' }}"><input id="client[]" type="text" class="form-control" name="client[]" value="" placeholder="Client" autofocus>@if ($errors->has('client'))<span class="help-block"><strong>{{ $errors->first('client') }}</strong></span>@endif</div><div class="form-group{{ $errors->has('link') ? ' has-error' : '' }}"><input id="link[]" type="text" class="form-control" name="link[]" value="" placeholder="Link" autofocus>@if ($errors->has('link'))<span class="help-block"><strong>{{ $errors->first('link') }}</strong></span>@endif</div><div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}"><input id="details[]" type="text" class="form-control" name="details[]" value="" placeholder="Details" autofocus>@if ($errors->has('details'))<span class="help-block"><strong>{{ $errors->first('details') }}</strong></span>@endif</div>'); 
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
            $( "#portfolio_div" ).append('<div class="form-group"><input id="link_p[]" type="text" class="form-control" name="link_p[]"  placeholder="link" ></div><div class="form-group"><input id="description[]" type="text" class="form-control" name="description[]" value="" placeholder="Description" ></div><br>'); 
        });
    });
    

</script>


@endsection

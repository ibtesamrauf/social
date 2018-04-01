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
              <div class="col-sm-8 col-sm-offset-2 mb-sm-40">
                <h4 class="font-alt">Login</h4>
                <hr class="divider-w mb-10">
                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                        <input id="email" placeholder="E-Mail Address" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
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
                        <div class="col-md-6 col-md-offset-4">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" placeholder="" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>

                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>
                    </div>

                </form>
                <hr>
                <?php 
                    $fb = new \Facebook\Facebook([
                        'app_id' =>  env('FACEBOOK_APP_ID' , '717877275077234'),
                        'app_secret' => env('FACEBOOK_APP_SECRET' , '495ca21fbdff25278903cc08ae2a48f3'),
                        'default_graph_version' => env('FACEBOOK_APP_default_graph_version' , 'v2.10'),
                    ]);

                    $helper = $fb->getRedirectLoginHelper();
                    if (isset($_GET['state'])) 
                    { 
                        $helper->getPersistentDataHandler()->set('state', $_GET['state']); 
                    }
                    $permissions = ['manage_pages', 'publish_pages',
                            'ads_management','pages_messaging','pages_show_list','read_custom_friendlists',
                            'user_friends','email','user_photos','user_likes','user_posts',
                            'user_videos','user_birthday']; // Optional permissions
                    $loginUrl = $helper->getLoginUrl(env('FACEBOOK_REDIRECT_URL_MANNUAL_LOGIN' , 'http://influence-laravel-theme.com/facebook_test_callback'), $permissions);
                ?>                    
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-2">
                        <!-- <a href="{{ url('/auth/github') }}" class="btn btn-github"><i class="fa fa-github"></i> Github</a> -->
                        <a href="{{ $loginUrl }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
                        <a href="{{ url('/auth/google') }}" class="btn btn-google"><i class="fa fa-google"></i> Google</a>
                        <!-- <a href="{{ url('/auth/twitter') }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a> -->
                    </div>
                </div>
              </div>
              

            </div>
          </div>
        </section>
        @include('layouts.footer')
      </div>
      <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>








<!-- 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                @if(Session::has('alert'))
                    <div class="alert alert-success">
                        {{ Session::get('alert') }}
                        @php
                        Session::forget('alert');
                        @endphp
                    </div>
                @endif
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> -->
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">/</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                    <center>
                        <h1>{{ env('APP_NAME') }}</h1>
                        <a class="btn btn-success" href="{{ route('register') }}">Register as an Influencer</a>
                        <br>
                        <br>
                        <a class="btn btn-warning" href="/jobseeker_register">Register as a Marketer</a>
                        <br>
                        <br>
                        <a class="btn btn-warning" href="/jobseeker_login">Login as Marketer</a>
                    </center>

                  
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

            <div class="content">
                <div class="title m-b-md">
                    
                </div>
            </div>
     
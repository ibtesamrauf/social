@extends('layouts.app')

@section('content')
<br><br><br>
<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Instagram Profile</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      <tr>
                        <td><img src="{{$instagram_page_data[0]->image}}" style=" width: 150px; "></td>
                        <td><h1>{{ $instagram_page_data[0]->name}}</h1></td>
                      </tr>
                      <tr>
                        <td style="width:18%">Followers</td>
                        <td>{{ $instagram_page_data[0]->followed_by}}</td>
                      </tr>
                      <tr>
                        <td>Following</td>
                        <td>{{ $instagram_page_data[0]->follows}}</td>
                      </tr>                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Youtube channel</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                      <tr>
                        <td><img src="{{$youtube_page_data[0]->image}}" style=" width: 150px; "></td>
                        <td><h1>{{ $youtube_page_data[0]->name}}</h1></td>
                      </tr>
                      <tr>
                        <td style="width:18%">Subscriber</td>
                        <td>{{ $youtube_page_data[0]->subscriberCount}}</td>
                      </tr>
                      <!-- <tr>
                        <td>About your page</td>
                        <td>{{ $youtube_page_data[0]->images}}</td>
                      </tr> -->                     
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

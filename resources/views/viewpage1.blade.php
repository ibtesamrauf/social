@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">My Page</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($user_page_data->isEmpty())
                        
                      <a href="/buildpage" class="btn btn-primary">Create your page first</a>

                    @else
                    <a class="btn btn-primary" href="{{ url('/buildpages/' . $user_page_data[0]->id . '/edit') }}" title="Edit User">Edit page</a>

                    <table class="table">
                      <tr>
                        <td colspan="2"><h1>{{ $user_page_data[0]->page_title}}</h1></td>
                      </tr>
                      <tr>
                        <td style="width:18%">Description</td>
                        <td>{{ $user_page_data[0]->page_description}}</td>
                      </tr>
                      <tr>
                        <td>About your page</td>
                        <td>{{ $user_page_data[0]->page_about_your_self}}</td>
                      </tr>

                      <tr>
                        <td colspan="2"><br></td>
                      </tr>
                      
                      <tr>
                        <td colspan="2">Youtube Channel data</td>
                      </tr>
                      
                      <tr>
                        <td>
                          <img src="{{$youtube_response_page_image}}">
                        </td>
                        <td>
                          <ul>
                            <li>
                              subscriberCount : {{ $youtube_response->statistics->subscriberCount }}
                            </li>
                            
                            <li>
                              videoCount : {{ $youtube_response->statistics->videoCount }}
                            </li>
                            
                            <li>
                              viewCount : {{ $youtube_response->statistics->viewCount }}
                            </li>
                            
                            <li>
                              commentCount : {{ $youtube_response->statistics->commentCount }}
                            </li>
                          </ul>
                        </td>
                      </tr>

                      <tr>
                        <td colspan="2">Facebook Page data</td>
                      </tr>
                      
                      <tr>
                        <td>
                          <img src="{{$facebook_response_page_image}}">
                        </td>
                        <td>
                          <ul>
                            <li>
                              Name : {{ $facebook_response->name }}
                            </li>
                            
                            <li>
                              Likes : {{ $facebook_response->fan_count }}
                            </li>
                            
                            <li>
                              Link : {{ $facebook_response->link }}
                            </li>
                            
                          </ul>
                        </td>
                      </tr>
                      <!-- <tr><td><br></td></tr> -->
              

                      

                    </table>
                    <br>
                    <li><a href="/upload_youtube_video" class="btn btn-primary">upload youtube videos</a></li>
                    <br>
                    @foreach ($user_videos_data as $video)
                        <script type="text/javascript">
                          get_youtube_video_data("<?php echo $video->videos_url; ?>","<?php echo $video->id; ?>");
                        </script>
                        <br>
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-4" id="video-data-{{ $video->id }}"></div>
                                <ul class="col-xs-8" id="video-data-ul-{{ $video->id }}"></ul>
                            </div>
                        </div>
                        <br>
                        <!-- <img src="http://img.youtube.com/vi/{{ $video->videos_url }}/0.jpg"> -->
                        <!-- {{ $video->videos_url }} -->
                    @endforeach
                    @endif
                    <!-- <div id="player"></div> -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: '1G4isv_Fylg',
          events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
          }
        });
      }

      // 4. The API will call this function when the video player is ready.
      function onPlayerReady(event) {
        event.target.playVideo();
      }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 6000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
</script>

<!-- https://www.googleapis.com/youtube/v3/channels?part=statistics&id=UC20vb-R_px4CguHzzBPhoyQ&key=AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE -->
<script>
    /*
     * YouTube: Retrieve Title, Description and Thumbnail
     * http://salman-w.blogspot.com/2010/01/retrieve-youtube-video-title.html
     */
    function get_youtube_video_data(youtube_video_id,count) 
    {  
      $(function() {
          $.getJSON("https://www.googleapis.com/youtube/v3/videos", {
            key: "AIzaSyAg_FC0M57hpDOSnCgCjiXlnHdr979nEJE",
            part: "snippet,statistics",
            id: youtube_video_id//videoid
          }, function(data) {
            console.log(data);
            if (data.items.length === 0) {
              $("<p style='color: #F00;'>Video not found.</p>").appendTo("#video-data-"+count);
              return;
            }
            $("<img>", {
              src: data.items[0].snippet.thumbnails.medium.url,
              width: data.items[0].snippet.thumbnails.medium.width,
              height: data.items[0].snippet.thumbnails.medium.height
            }).appendTo("#video-data-"+count);
            $("<br><br><a href='/delete_youtube_video/" + youtube_video_id + "/" + count + "' class='btn btn-danger'>Delete video</a>").appendTo("#video-data-"+count);

            $("<h1></h1>").text(data.items[0].snippet.title).appendTo("#video-data-ul-"+count);
            // $("<p></p>").text(data.items[0].snippet.description).appendTo("#video-data-"+count);
            $("<li></li>").text("Published at: " + data.items[0].snippet.publishedAt).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("View count: " + data.items[0].statistics.viewCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Favorite count: " + data.items[0].statistics.favoriteCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Like count: " + data.items[0].statistics.likeCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Dislike count: " + data.items[0].statistics.dislikeCount).appendTo("#video-data-ul-"+count);
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $("<p style='color: #F00;'></p>").text(jqXHR.responseText || errorThrown).appendTo("#video-data-"+count);
          });
      });
    }
  </script>


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

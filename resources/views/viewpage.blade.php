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


<script>
    /*
     * YouTube: Retrieve Title, Description and Thumbnail
     * http://salman-w.blogspot.com/2010/01/retrieve-youtube-video-title.html
     */
    function get_youtube_video_data(youtube_video_id,count) 
    {  
      $(function() {
        // $("#search-txt").on("keypress", function(e) {
        //   if (e.which === 13) {
        //     e.preventDefault();
        //     $("#search-btn").trigger("click");
        //   }
        // });
        // $("#search-btn").on("click", function() {
          // $("#video-data-1, #video-data-2").empty();
          // var videoid = $("#search-txt").val();
          // var matches = videoid.match(/^http:\/\/www\.youtube\.com\/.*[?&]v=([^&]+)/i) || videoid.match(/^http:\/\/youtu\.be\/([^?]+)/i);
          // if (matches) {
          //   videoid = matches[1];
          // }
          // if (videoid.match(/^[a-z0-9_-]{11}$/i) === null) {
          //   $("<p style='color: #F00;'>Unable to parse Video ID/URL.</p>").appendTo("#video-data-1");
          //   return;
          // }
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
            $("<h1></h1>").text(data.items[0].snippet.title).appendTo("#video-data-"+count);
            $("<p></p>").text(data.items[0].snippet.description).appendTo("#video-data-"+count);
            $("<li></li>").text("Published at: " + data.items[0].snippet.publishedAt).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("View count: " + data.items[0].statistics.viewCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Favorite count: " + data.items[0].statistics.favoriteCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Like count: " + data.items[0].statistics.likeCount).appendTo("#video-data-ul-"+count);
            $("<li></li>").text("Dislike count: " + data.items[0].statistics.dislikeCount).appendTo("#video-data-ul-"+count);
          }).fail(function(jqXHR, textStatus, errorThrown) {
            $("<p style='color: #F00;'></p>").text(jqXHR.responseText || errorThrown).appendTo("#video-data-"+count);
          });
        // });
      });
    }
  </script>


<div class="container">
    <div class="row">
        <!-- <div class="col-md-8 col-md-offset-2"> -->
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <li><a href="/upload_youtube_video">upload youtube videos</a></li>
                    @foreach ($user_videos_data as $video)
                        <script type="text/javascript">
                          get_youtube_video_data("<?php echo $video->videos_url; ?>","<?php echo $video->id; ?>");
                        </script>
                        <div id="video-data-{{ $video->id }}"></div>
                        <ul id="video-data-ul-{{ $video->id }}"></ul>
                        <!-- <img src="http://img.youtube.com/vi/{{ $video->videos_url }}/0.jpg"> -->
                        <!-- {{ $video->videos_url }} -->
                    @endforeach

                    <!-- <div id="player"></div> -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')


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


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form class="form-horizontal" method="POST" action="/buildpage_form">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('page_title') ? ' has-error' : '' }}">
                            <label for="page_title" class="col-md-4 control-label">Page Title</label>

                            <div class="col-md-6">
                                <input id="page_title" type="text"   class="form-control" name="page_title" value="{{{ isset($user_page_data->page_title) ? $user_page_data->page_title : '' }}}{{ old('page_title') }}" required autofocus>

                                @if ($errors->has('page_title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('page_description') ? ' has-error' : '' }}">
                            <label for="page_description" class="col-md-4 control-label">Description</label>

                            <div class="col-md-6">
                                <input id="page_description" type="text" class="form-control" name="page_description" value="{{{ isset($user_page_data->page_description) ? $user_page_data->page_description : '' }}}{{ old('page_description') }}" required>

                                @if ($errors->has('page_description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('page_about_your_self') ? ' has-error' : '' }}">
                            <label for="page_about_your_self" class="col-md-4 control-label">About your Page</label>

                            <div class="col-md-6">
                                <input id="page_about_your_self" type="text" class="form-control" name="page_about_your_self" value="{{{ isset($user_page_data->page_about_your_self) ? $user_page_data->page_about_your_self : '' }}}{{ old('page_about_your_self') }}" required>

                                @if ($errors->has('page_about_your_self'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('page_about_your_self') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create Page
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- <li><a href="/upload_youtube_video">upload youtube videos</a></li> -->
                    <!-- <div id="player"></div> -->
                </div>



            </div>
        </div>
    </div>
</div>
@endsection

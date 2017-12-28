@extends('layouts.app')

@section('content')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Upload Video
                    <span style=" padding-left: 83%; ">
                        <button type="button" id="add_vides_bar_button" name="add_vides_bar_button" class="btn btn-primary">
                            Add More+
                        </button>
                    </span>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form class="form-horizontal" id="create_text_field" method="POST" action="number_of_videos" >
                    <!-- <div class="form-horizontal"> -->
                        
                        {{ csrf_field() }}
                        <div class="bars">
                            
                        
                        <div class="form-group{{ $errors->has('number_of_videos') ? ' has-error' : '' }}">
                            <label for="number_of_videos" class="col-md-4 control-label">Enter video url 1</label>

                            <div class="col-md-6">
                                <input id="number_of_videos1" type="text" class="form-control" name="number_of_videos1" value="{{ old('number_of_videos') }}" required autofocus>

                                @if ($errors->has('number_of_videos'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number_of_videos') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('number_of_videos2') ? ' has-error' : '' }}">
                            <label for="number_of_videos2" class="col-md-4 control-label">Enter video url 2</label>

                            <div class="col-md-6">
                                <input id="number_of_videos2" type="text" class="form-control" name="number_of_videos2" value="{{ old('number_of_videos2') }}" autofocus>

                                @if ($errors->has('number_of_videos2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number_of_videos2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('number_of_videos3') ? ' has-error' : '' }}">
                            <label for="number_of_videos3" class="col-md-4 control-label">Enter video url 3</label>

                            <div class="col-md-6">
                                <input id="number_of_videos3" type="text" class="form-control" name="number_of_videos3" value="{{ old('number_of_videos3') }}" autofocus>

                                @if ($errors->has('number_of_videos3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('number_of_videos3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>

                    <!-- </div> -->
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        var count_temp = 3;
        $( "#add_vides_bar_button" ).click(function() {
            count_temp += 1;
            console.log(count_temp);            
            $( ".bars" ).append('<div class="form-group"><label for="number_of_videos' + count_temp + '" class="col-md-4 control-label">Enter video url ' + count_temp +'</label><div class="col-md-6"><input id="number_of_videos' + count_temp + '" type="text" class="form-control" name="number_of_videos' + count_temp + '"  autofocus></div></div>');
        });

    });
</script>


<script type="text/javascript">
    // $(document).ready(function() {
    //     $('#create_text_field').on('submit', function (e) {
    //         $.ajaxSetup({
    //             header:$('meta[name="_token"]').attr('content')
    //         })
    //         e.preventDefault();
    //         var title = $('#title').val();
    //         var body = $('#body').val();
    //         var published_at = $('#published_at').val();
    //         $.ajax({
    //             type: "GET",
    //             url: '/number_of_videos',
    //             data: {title: title, body: body, published_at: published_at},
    //             success: function( msg ) {
    //                 consolem.log(msg);
    //                 // $("#ajaxResponse").append("<div>"+msg+"</div>");
    //             }
    //         });
    //     });
    // });
</script>
@endsection

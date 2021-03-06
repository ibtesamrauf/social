@extends('layouts.app')

@section('content')

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<div class="main">
    <section class="module bg-dark-30" data-background="{{ asset('assets/images/section-4.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Inbox</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">Inbox</div>


                        <div class="panel-body">
						    @if (session('status'))
						    <div class="alert alert-success">
						        {{ session('status') }}
						    </div>
						    @endif
						    <div class="col-md-12">
						        <h1>{{ $thread->subject }}</h1>
					        	
					        	<div id="ajax_call_data">
		                        </div>
						        
						        <h4>Add a new message</h4>
								<form action="{{ route('messages_marketer.update', $thread->id) }}" id="message_form" method="post">
								    {{ method_field('put') }}
								    {{ csrf_field() }}
								        
								    <!-- Message Form Input -->
								    <div class="form-group">
								        <textarea name="message" rows="6" id="message" class="form-control">{{ old('message') }}</textarea>
								    </div>

								    <!-- Submit Form Input -->
								    <div class="col-md-2 form-group">
								        <button type="submit" class="btn btn-primary form-control">Submit</button>
								    </div>
								</form>
						    </div>
						</div>

                        <input type="hidden" id="belongsto1_var" value="{{ $belongsto1 }}"></span>
                        <input type="hidden" id="id_var" value="{{ $id }}"></span>
                        <input type="hidden" id="thread_id_var" value="{{ $thread->id }}"></span>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>

@endsection

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
	$( document ).ready(function() {
		var belongsto1_var = $('#belongsto1_var').val();
		var id_var = $('#id_var').val();
		var baseUrl = document.location.origin;
		
		$( "#ajax_call_data" ).load( "/messages_marketer_show_ajax/"+belongsto1_var+"/"+id_var );
		window.setInterval(function(){
			$( "#ajax_call_data" ).load( "/messages_marketer_show_ajax/"+belongsto1_var+"/"+id_var );
		}, 1500);

		$('#message_form').on('submit', function(e) {
	       	e.preventDefault(); 
	       	var message = $('#message').val();
	       	$('#message').val("");
	       	var thread_id_var = $('#thread_id_var').val();
	       	$.ajax({
				type: "PUT",
				url: baseUrl+'/messages_marketer/'+thread_id_var,
				data: { "_token": "{{ csrf_token() }}", "message":message},
				success: function( msg ) {
				   // alert( msg );
				}
	       	});
	   	});
	});
</script>



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

                        <div id="ajax_call_data">
                        </div>

                        <input type="hidden" id="belongsto1_var" value="{{ $belongsto1 }}"></span>
                        <input type="hidden" id="id_var" value="{{ $id }}"></span>

                        
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
		$( "#ajax_call_data" ).load( "/messages_marketer_show_ajax/"+belongsto1_var+"/"+id_var );
		window.setInterval(function(){
			$( "#ajax_call_data" ).load( "/messages_marketer_show_ajax/"+belongsto1_var+"/"+id_var );
		}, 3000);
	});
</script>



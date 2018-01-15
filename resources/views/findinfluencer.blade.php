@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Find Infulencer</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="/findinfulencer"  method="GET">
	                    <div class="form-group">
						    <label for="exampleInputEmail1">Search</label>
						    <?php
						    	$search_var = "";
							    if ( isset( $_GET['search'] ) ) {
								    // check emptiness after triming whitespace.
								    $search_var = $_GET['search'];
								}
							?>  
	                    	<input type="text" class="form-control" name="search" value="{{ $search_var ?  $search_var : '' }}" id="search" placeholder="Search">
						</div>
						<button type="submit" class="btn btn-primary">Start Search</button>
	                    
                    </form>
                </div>

                <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                @if ($user_page_data->isEmpty())
                                	@if (isset($user_page_data->search))
                                		<h2>{{ $user_page_data->search }}</h2>
                            		@else
	                                    <h2>NO influencer is register yet</h2>
	                                    <a href="/" class="btn btn-primary">Go back to home</a>
                                	@endif	
                                @else
                                <table class="table">
                                <!-- <th>User Name</th> -->
                                <th>Page title</th>
                                <th>About Them</th>
                                <th>Facebook Likes</th>
                                <th>Youtube Subscriber</th>
                                <th>Add to favorite</th>
                                <th>Message</th>
                                    @foreach ($user_page_data as $video)
                                        <tr>
                                            <!-- <td>
                                                {{ $video->Users->name }}    
                                            </td> -->
                                            <td>
                                                {{ $video->page_title }}
                                            </td>
                                            <td>
                                                {{ $video->page_about_your_self }}
   	                                        </td>
                                            <td>
                                                <!-- $video->Facebook_page[0]->likes -->
                                            </td>
                                            <td>
                                                <!-- $video->Youtube_page[0]->subscriberCount -->
                                            </td>
                                            <td>
                                           		<a href="#">
										          <span class="glyphicon glyphicon-star"></span>
										        </a>
                                            </td>
	                                        <td>
		                                        <a href="#">
										          <span class="glyphicon glyphicon-envelope"></span>
										        </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                @endif
                            </div>
                            @if ($user_page_data->isEmpty())
                            @else
                                {!! $user_page_data->render() !!} 
                            @endif
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

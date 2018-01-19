@extends('layouts.app')

@section('content')

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $( document ).ready(function() {
        $( "#add_another" ).click(function() {
          console.log("asdasd");
          $( "#div_criteria" ).append('<br>Traction of likes:<input type="text" class="form-control" placeholder="Enter number of likes">From:<select id="country" name="country" class="form-control"><option>likes on Facebook</option><option>followers on Twitter</option><option>followers on Instagram</option><option>Subscribers on Youtube</option><option>Followers on Soundcloud</option><option>Blog visitors per month</option></select>'); 
        });
    });
</script>



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
						    <label for="exampleInputEmail1">Keyword Search</label>
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
                    <br><br>
                    <!-- <form action="/findinfulencer"  method="GET"> -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Advanced Search</label>
                            <?php
                                $search_var = "";
                                if ( isset( $_GET['search'] ) ) {
                                    // check emptiness after triming whitespace.
                                    $search_var = $_GET['search'];
                                }
                            ?>  
                            <!-- <input type="text" class="form-control" name="search" value="{{ $search_var ?  $search_var : '' }}" id="search" placeholder="Search"> -->
                            <select id="country" name="country" class="form-control">
                                @foreach($country as $country_value)
                                    <option value="{{ $country_value->id }}">{{ $country_value->country_name }}</option>
                                @endforeach
                            </select>
                            <br>Prefered medium<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Recorded Video<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Live Video<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Photos<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Blog Posts<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Podcast<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Tweets / Comments<br>
                            <input id="prefered_medium[]" name="prefered_medium[]" type="checkbox">Long Form Articles<br>

                            <br>
                            <div id="div_criteria">
                                <table class="table">
                                    <th>Traction</th>
                                    <th colspan="4">Range</th>
                                    <th>Action</th>
                                    <tr>
                                        <td></td>
                                        <td>10000-20000</td>
                                        <td>20000-30000</td>
                                        <td>30000-40000</td>
                                        <td>40000-50000</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>likes on Facebook</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>followers on Twitter</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>followers on Instagram</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Subscribers on Youtube</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Followers on Soundcloud</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>Blog visitors per month</td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td><input type="checkbox"></td>
                                        <td>
                                            <input name="action" type="radio">or&nbsp
                                            <input name="action" type="radio">and
                                        </td>
                                    </tr>
                                    
                                </table>
                                <!-- Traction:
                                <input type="text" class="form-control" placeholder="Enter number of likes">
                                From:
                                <select id="country" name="country" class="form-control">
                                    <option>likes on Facebook</option>
                                    <option>followers on Twitter</option>
                                    <option>followers on Instagram</option>
                                    <option>Subscribers on Youtube</option>
                                    <option>Followers on Soundcloud</option>
                                    <option>Blog visitors per month</option>
                                </select> -->
                            </div>

                            <!-- <button class="btn btn-danger" id="add_another">Add new </button> -->

                        </div>
                        <button type="submit" class="btn btn-primary">Advance Search</button>
                        
                    <!-- </form> -->
                    

                </div>
                <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <h2>Results</h2>
                                		<!-- <h2> $user_page_data->search </h2> -->
                            	        <!-- <h2>NO influencer is register yet</h2> -->
	                                    <!-- <a href="/" class="btn btn-primary">Go back to home</a> -->
                                
                                <table class="table">
                                <!-- <th>User Name</th> -->
                                <th>Page title</th>
                                <th>About Them</th>
                                <th>Facebook Likes</th>
                                <th>Youtube Subscriber</th>
                                <th>Add to favorite</th>
                                <th>Message</th>
                                        <tr>
                                            
                                            <td>
                                                page_title 
                                            </td>
                                            <td>
                                                page_about_your_self
   	                                        </td>
                                            <td>
                                                Facebook_page likes
                                            </td>
                                            <td>
                                                Youtube_page subscriberCount
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
                                </table>
                            </div>
                        </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

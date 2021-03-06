@extends('layouts.app')

@section('content')

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<div class="main">
    <section class="module bg-dark-30" data-background="assets/images/section-4.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Find-Infulencer</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
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
                            <form action="/finde_influencer_test"  method="GET">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Keyword Search</label>
                                    <?php
                                    $search_var = "";
                                    if (isset($_GET['search'])) {
                                        // check emptiness after triming whitespace.
                                        $search_var = $_GET['search'];
                                    }
                                    ?>  
                                    <input type="text" class="form-control" name="search" value="{{ $search_var ?  $search_var : '' }}" id="search" placeholder="Search">
                                </div>
                                <button type="submit" class="btn btn-primary">Start Search</button>

                            </form>
                            <br><br>
                            <form action="/finde_influencer_test"  method="GET"> 
                            <input type="hidden" id="advance_search" value="include" name="advance_search">
                            <!-- <input type="button" id="hide" value="hide"> -->
                            <h4 id="hide" value="hide">Advanced Search
                                <span  id="advanced-search-span" class="fa fa-angle-down"></span>
                            </h4>
                            <div class="form-group Advance-search-class" style="display:none">
                                <label for="exampleInputEmail1">Advanced Search</label>


                                <div id="div_criteria">
                                    <table class="table">
                                        <!-- <th style="width: 7%;">Including</th> -->
                                        <th style="width: 58%;">Traction</th>
                                        <th style="width: 25%;">Medium</th>
                                        <th style="width: 10%;">Action</th>
                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td><input type="number" class="form-control" name="likes_on_Facebook" id="likes_on_Facebook" value="{{ Input::get('likes_on_Facebook') ? $_GET['likes_on_Facebook'] : ''}}" placeholder="Enter number of likes"></td>
                                            <td><input type="checkbox" {{ Input::get('likes_on_Facebook_checkbox') == 1 ? 'checked' : ''}} name="likes_on_Facebook_checkbox" value="1" id="likes_on_Facebook_checkbox" > on Facebook</td>
                                            <td>
                                                <select name="action_facebook">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->                                        
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td><input type="number" class="form-control" name="followers_on_Instagram" id="followers_on_Instagram" value="{{ Input::get('followers_on_Instagram') ? $_GET['followers_on_Instagram'] : ''}}" placeholder="Enter number of followers"></td>
                                            <td><input type="checkbox" {{ Input::get('followers_on_Instagram_checkbox') == 1 ? 'checked' : ''}} name="followers_on_Instagram_checkbox" value="1" id="followers_on_Instagram_checkbox"> on Instagram</td>
                                            <td>
                                                <select name="action_instagram">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="number" class="form-control" name="subscribers_on_Youtube" id="subscribers_on_Youtube" value="{{ Input::get('subscribers_on_Youtube') ? $_GET['subscribers_on_Youtube'] : ''}}" placeholder="Enter number of Subscribers"></td>
                                            <td><input type="checkbox" {{ Input::get('subscribers_on_Youtube_checkbox') == 1 ? 'checked' : ''}} name="subscribers_on_Youtube_checkbox" value="1" id="subscribers_on_Youtube_checkbox"> on Youtube</td>
                                            <td>
                                                <select name="action_youtube">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
                                                <!-- <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td><input type="number" class="form-control" name="followers_on_Twitter" id="followers_on_Twitter" value="{{ Input::get('followers_on_Twitter') ? $_GET['followers_on_Twitter'] : ''}}"  placeholder="Enter number of followers "></td>
                                            <td><input type="checkbox" {{ Input::get('followers_on_Twitter_checkbox') == 1 ? 'checked' : ''}} name="followers_on_Twitter_checkbox" value="1" id="followers_on_Twitter_checkbox"> on Twitter</td>
                                            <td>
                                                <select name="action_twitter">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="number" class="form-control" name="followers_on_Soundcloud" id="followers_on_Soundcloud" value="{{ Input::get('followers_on_Soundcloud') ? $_GET['followers_on_Soundcloud'] : ''}}" placeholder="Enter number of Followers"></td>
                                            <td><input type="checkbox" {{ Input::get('followers_on_Soundcloud_checkbox') == 1 ? 'checked' : ''}} name="followers_on_Soundcloud_checkbox" value="1" id="followers_on_Soundcloud_checkbox"> on Soundcloud</td>

                                            <td>
                                                <select name="action_soundcloud">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
        <!--                                         <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="number" class="form-control" name="Blog_visitors_per_month" id="Blog_visitors_per_month" value="{{ Input::get('Blog_visitors_per_month') ? $_GET['Blog_visitors_per_month'] : ''}}" placeholder="Enter number of "></td>
                                            <td><input type="checkbox" {{ Input::get('Blog_visitors_per_month_checkbox') == 1 ? 'checked' : ''}} name="Blog_visitors_per_month_checkbox" value="1" id="Blog_visitors_per_month_checkbox"> Blog visitors per month</td>

                                            <td>
                                                <select name="action_blogs">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
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

                                <?php
                                $search_var = "";
                                if (isset($_GET['search'])) {
                                    // check emptiness after triming whitespace.
                                    $search_var = $_GET['search'];
                                }
                                ?>  
                                <!-- <input type="text" class="form-control" name="search" value="{{ $search_var ?  $search_var : '' }}" id="search" placeholder="Search"> -->
                                Country: <select id="country" name="country" class="form-control">
                                    <option >Select</option>
                                    @foreach($country as $country_value)
                                    <option value="{{ $country_value->id }}" @if (Input::get('country') == $country_value->id) selected="selected" @endif >{{ $country_value->country_name }}</option>
                                    @endforeach
                                </select>
                                <br>Prefered medium<br>
                                @foreach($preferred_medium_value as $preferred_medium_value)
                                    <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]" 
                                    @if (!empty(Input::get('preferred_medium'))) @if (in_array( $preferred_medium_value->id, Input::get('preferred_medium'))) checked="checked" @endif @endif > {{ $preferred_medium_value->preferred_medium_title }}<br>
                                @endforeach    

                                <br>
                            <button type="submit" class="btn btn-primary">Advance Search</button>
                            </div>

                            </form> 


                        </div>
                        <div class="panel-body">
                            <div class="container" style=" width: 100%; ">
                                <div class="row">
                                    <h2>Results</h2>
                                    <!-- <h2> $user_page_data->search </h2> -->
                                    <!-- <h2>NO influencer is register yet</h2> -->
                                    <!-- <a href="/" class="btn btn-primary">Go back to home</a> -->
                                    <?php //vv($search_page_data); ?>
                                    <table id="example" cellspacing="0" width="100%" class="table table-borderless display">
                                        <thead>
                                            <th>S.no</th>
                                            <th>Page title</th>
                                            <th>Likes & Subscribers</th>
                                            <!-- <th>Social Media Platform</th> -->
                                            <th>Image</th>
                                            <th>Add to favorite</th>
                                            <th>Message</th>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        if(!empty($search_page_data)){
                                            $array_for_page_name = array();
                                            $temp_count = 1;
                                            $temp_name_array = array();
                                            foreach ($search_page_data as $key => $value) {
                                                $temp_name_array[] = $value->name;
                                            }
                                            $counter_for_loop = 0;
                                            $y = 0; 
                                            foreach ($search_page_data as $key => $data) {
                                                if(isset($data->name)){
                                                    $array_for_page_name[] = $data->name;
                                                }   
                                                $flag_to_break = false;
                                                $temp_count = $temp_count + 1;


                                                if($y >=  $temp_count){
                                                    continue;
                                                }else{
                                                    $y = 0;
                                                    $counter_for_loop += 1;
                                                }
                                            ?>
                                                <!-- onclick="window.location='/viewprofile_from_find_influencer/{{ $data->user_id }}';" -->
                                                <tr onclick="window.location='/viewprofile_from_find_influencer/{{ $data->user_id }}';">        
                                                    <td>
                                                        {{ $counter_for_loop }}
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            if(isset($data->name)){
                                                                echo $data->name; 
                                                            }                                                        
                                                        ?> 
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            // $array =  (array) $array_for_page_name;
                                                            $counts = array_count_values($temp_name_array);
                                                            if($counts[$data->name] > 1){
                                                                // echo ($counts[$data->name]);
                                                                // v('in array'.$data->name);
                                                                $key = $key+$counts[$data->name];
                                                                $flag_to_break = true;
                                                                if($y == 0){
                                                                    $y = ($temp_count+$counts[$data->name])-1;
                                                                }
                                                                // if(isset($data->likes)){
                                                                //     echo $data->likes."<br>"; 
                                                                // }else if (isset($data->followed_by)) {
                                                                //     echo $data->followed_by."<br>";
                                                                // }elseif (isset($data->subscriberCount)) {
                                                                //     echo $data->subscriberCount."<br>";
                                                                // }
                                                                // echo "<br>".($y-2)."<br>";
                                                                // echo ($temp_count-1)."<br>";
                                                                for ($i=$temp_count-2; $i <= $y-2 ; $i++) { 
                                                                    $temp = ""; 
                                                                    if(isset($search_page_data[$i]->likes)){
                                                                        echo "Facebook likes: ";
                                                                        $temp = "Facebook";
                                                                        echo $search_page_data[$i]->likes."<br>"; 

                                                                    }else if (isset($search_page_data[$i]->followed_by)) {
                                                                        echo "Instagram Followers: ";
                                                                        $temp = "Instagram";
                                                                        echo $search_page_data[$i]->followed_by."<br>";

                                                                    }elseif (isset($search_page_data[$i]->subscriberCount)) {
                                                                        echo "Youtube Subscriber: ";
                                                                        $temp = "Youtube";
                                                                        echo $search_page_data[$i]->subscriberCount."<br>";

                                                                    }
                                                                    elseif (isset($search_page_data[$i]->followers_count)) {
                                                                        echo "Twitter Subscriber: ";
                                                                        $temp = "Twitter";
                                                                        echo $search_page_data[$i]->followers_count."<br>";
                                                                    }

                                                                    // if(isset($search_page_data[$i]->likes)){
                                                                    //     echo $search_page_data[$i]->likes."<br>"; 
                                                                    // }else if (isset($search_page_data[$i]->followed_by)) {
                                                                    //     echo $search_page_data[$i]->followed_by."<br>";
                                                                    // }elseif (isset($search_page_data[$i]->subscriberCount)) {
                                                                    //     echo $search_page_data[$i]->subscriberCount."<br>";
                                                                    // }
                                                                }

                                                            }else{
                                                                $temp = ""; 
                                                                if(isset($data->likes)){
                                                                    echo "Facebook likes: ";
                                                                    $temp = "Facebook";
                                                                }else if (isset($data->followed_by)) {
                                                                    echo "Instagram Followers: ";
                                                                    $temp = "Instagram";
                                                                }elseif (isset($data->subscriberCount)) {
                                                                    echo "Youtube Subscriber: ";
                                                                    $temp = "Youtube";
                                                                }elseif (isset($data->followers_count)) {
                                                                    echo "Twitter Subscriber: ";
                                                                    $temp = "Twitter";
                                                                }
                                                                if(isset($data->likes)){
                                                                    echo $data->likes; 
                                                                }else if (isset($data->followed_by)) {
                                                                    echo $data->followed_by;
                                                                }elseif (isset($data->subscriberCount)) {
                                                                    echo $data->subscriberCount;
                                                                }elseif (isset($data->followers_count)) {
                                                                    echo $data->followers_count;
                                                                }
                                                            }

                                                            // if(isset($data->likes)){
                                                            //     echo $data->likes; 
                                                            // }else if (isset($data->followed_by)) {
                                                            //     echo $data->followed_by;
                                                            // }elseif (isset($data->subscriberCount)) {
                                                            //     echo $data->subscriberCount;
                                                            // }
                                                        ?> 
                                                    </td>
                                                    <!-- <td> -->
                                                        <?php 
                                                            // $temp = ""; 
                                                            // if(isset($data->likes)){
                                                            //     echo "Facebook";
                                                            //     $temp = "Facebook";
                                                            // }else if (isset($data->followed_by)) {
                                                            //     echo "Instagram";
                                                            //     $temp = "Instagram";
                                                            // }elseif (isset($data->subscriberCount)) {
                                                            //     echo "Youtube";
                                                            //     $temp = "Youtube";
                                                            // }
                                                        ?> 
                                                    <!-- </td> -->
                                                    <td>
                                                        <img src="{{ isset($data->image) ? $data->image : ''}}" style=" max-width: 190px; " class="img-thumbnail">
                                                    </td>

                                                    <td>
                                                        <a href="#">
                                                            <span class="glyphicon glyphicon-star"></span> 
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a href="<?php  if(Auth::guest()){
                                                                            if (Auth::guard('jobseeker')->check()) { 
                                                                                if(isset($data->user_id)){ 
                                                                                    echo "/messages_marketer/". $temp.',,'.$data->id.',,'.$data->user_id ."/create"; 
                                                                                } 
                                                                            }else{
                                                                                echo '/jobseeker_register';
                                                                            } 
                                                                        } 
                                                                ?>">
                                                            <span class="glyphicon glyphicon-envelope"></span>
                                                        </a>
                                                    </td>
                                                </tr>
                                        <?php    

                                            }
                                        }else{
                                            echo "Nothing";
                                        }
                                        ?>
                                        </tbody>

                                    </table>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
<script type="text/javascript">
    $(document).ready(function() {
        $.noConflict();
        $('#example').DataTable();
        $("#hide").click(function(){
            $(".Advance-search-class").toggle();
            console.log($("#advanced-search-span").attr('class'));
            if( $("#advanced-search-span").attr('class') == 'fa fa-angle-down'){

                $( "#advanced-search-span" ).removeClass('fa fa-angle-down');
                $( "#advanced-search-span" ).addClass('fa fa-angle-up');
            }else{
                $( "#advanced-search-span" ).removeClass('fa fa-angle-up');
                $( "#advanced-search-span" ).addClass('fa fa-angle-down');
            }
        });
        var url_full = window.location.href; 
        
        if (~url_full.indexOf("advance_search=include")){
            $(".Advance-search-class").css('display','block');
        }
    } );
</script>

@endsection

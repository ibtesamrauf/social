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
                            <div class="form-group">
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
                                    <option value="{{ $country_value->id }}">{{ $country_value->country_name }}</option>
                                    @endforeach
                                </select>
                                <br>Prefered medium<br>
                                @foreach($preferred_medium_value as $preferred_medium_value)
                                <?php
                                if ($preferred_medium_value->id == 8) {
                                    ?>
                                    <?php
                                } else {
                                    ?>
                                    <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]"> {{ $preferred_medium_value->preferred_medium_title }}<br>
                                    <?php
                                }
                                ?>
                                @endforeach    

                                <br>
                            </div>
                            <button type="submit" class="btn btn-primary">Advance Search</button>

                            </form> 


                        </div>
                        <div class="panel-body">
                            <div class="container" style=" width: 100%; ">
                                <div class="row">
                                    <h2>Results</h2>
                                    <!-- <h2> $user_page_data->search </h2> -->
                                    <!-- <h2>NO influencer is register yet</h2> -->
                                    <!-- <a href="/" class="btn btn-primary">Go back to home</a> -->

                                    <table id="example" cellspacing="0" width="100%" class="table table-borderless display">
                                        <thead>
                                            <th>S.no</th>
                                            <th>Page title</th>
                                            <th>Facebook Likes</th>
                                            <th>Image</th>
                                            <th>Add to favorite</th>
                                            <th>Message</th>
                                        </thead>
                                        <tbody>
                                            
                                        <?php 
                                        if(!empty($search_page_data)){
                                        ?>

                                        @foreach($search_page_data as $key => $data)
                                            <tr>        
                                                <td>
                                                    {{ $key + 1 }}
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
                                                        if(isset($data->likes)){
                                                            echo $data->likes; 
                                                        }else if (isset($data->followed_by)) {
                                                            echo $data->followed_by;
                                                        }elseif (isset($data->subscriberCount)) {
                                                            echo $data->subscriberCount;
                                                        }
                                                    ?> 
                                                </td>
                                                <td>
                                                    <img src="{{ isset($data->image) ? $data->image : ''}}" style=" max-width: 190px; " class="img-thumbnail">
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
                                        <?php
                                        }else{
                                            echo "Nothing";
                                        }
                                        ?>
                                        </tbody>

                                    </table>
                                    <?php if(!empty($search_page_data)){ ?>
                                        <div class="pagination-wrapper"> {!! $search_page_data->appends(Input::except('page'))->render() !!} </div>
                                    <?php } ?>
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
    } );
</script>

@endsection

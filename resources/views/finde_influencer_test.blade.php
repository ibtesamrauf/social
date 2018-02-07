@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#add_another").click(function () {
            console.log("asdasd");
            $("#div_criteria").append('<br>Traction of likes:<input type="text" class="form-control" placeholder="Enter number of likes">From:<select id="country" name="country" class="form-control"><option>likes on Facebook</option><option>followers on Twitter</option><option>followers on Instagram</option><option>Subscribers on Youtube</option><option>Followers on Soundcloud</option><option>Blog visitors per month</option></select>');
        });
    });
</script>



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
                            <form action="/findinfulencer"  method="GET">
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
                            <!-- <form action="/findinfulencer"  method="GET"> -->
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
                                            <td><input type="text" class="form-control" id="likes_on_Facebook" placeholder="Enter number of likes"></td>
                                            <td><input type="checkbox"> on Facebook</td>
                                            <td>
                                                <select name="action">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->                                        
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td><input type="text" class="form-control" id="followers_on_Twitter" placeholder="Enter number of followers "></td>
                                            <td><input type="checkbox"> on Twitter</td>
                                            <td>
                                                <select name="action">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->
                                            <td><input type="text" class="form-control" id="followers_on_Instagram" placeholder="Enter number of followers"></td>
                                            <td><input type="checkbox"> on Instagram</td>
                                            <td>
                                                <select name="action">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
    <!--                                             <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="text" class="form-control" id="subscribers_on_Youtube" placeholder="Enter number of Subscribers"></td>
                                            <td><input type="checkbox"> on Youtube</td>
                                            <td>
                                                <select name="action">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
                                                <!-- <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="text" class="form-control" id="followers_on_Soundcloud" placeholder="Enter number of Followers"></td>
                                            <td><input type="checkbox"> on Soundcloud</td>

                                            <td>
                                                <select name="action">
                                                    <option value="1">AND</option>
                                                    <option value="2">OR</option>
                                                </select>
        <!--                                         <input name="action" type="radio">or&nbsp
                                                <input name="action" type="radio">and -->
                                            </td>
                                        </tr>

                                        <tr>
                                            <!-- <td><input type="checkbox"></td> -->

                                            <td><input type="text" class="form-control" id="Blog_visitors_per_month" placeholder="Enter number of "></td>
                                            <td><input type="checkbox"> Blog visitors per month</td>

                                            <td>
                                                <select name="action">
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
    </section>
    @include('layouts.footer')
</div>
<div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>





@endsection

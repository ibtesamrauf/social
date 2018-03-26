@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br/>
            <br/>
            <br/>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Jobs</div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel-body">
                    {{old('search')}}
                        {!! Form::open(['method' => 'GET', 'url' => '/find_job_resource', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" id="search" value="{{request()->get('search')}}" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    search<i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="container">
                            <?php 
                                if(!$device->isEmpty()){
                            ?>
                                @foreach($device as $item)
                                    <?php 
                                        $check_variable = false;
                                        $check_variable_hashtags = false;
                                        foreach ($item->jobs_preferred_medium as $key => $value) {
                                            if(in_array($value->preferred_medium_id, $temp_users_preferred_medium)){
                                                $check_variable = true;
                                            }   
                                        }
                                        foreach ($item->jobs_hashtags as $key => $value) {
                                            if(in_array($value->hashtags_id, $temp_users_hashtags)){
                                                $check_variable_hashtags = true;
                                            }   
                                        }
                                        // if($check_variable && $check_variable_hashtags){
                                    ?>

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-8">
                                                        <h3>{{ strtoUpper($item->title) }}</h3>
                                                        <p>{{ $item->description }}</p>
                                                        <p> 
                                                            <span>Timing: </span>{{ $item->timing }}
                                                            &nbsp&nbsp&nbsp
                                                            <?php if(!empty($item->audience_all)){ ?>
                                                                &nbsp&nbsp<span>Audience: </span> 
                                                                <span>{{ $item->audience_all }}</span>
                                                            <?php } ?>

                                                            <?php if(!empty($item->audience_facebook)){ ?>
                                                                &nbsp&nbsp<span>Facebook Audience: </span> 
                                                                <span>{{ $item->audience_facebook }}</span>
                                                            <?php } ?>

                                                            <?php if(!empty($item->audience_instagram)){ ?>
                                                                &nbsp&nbsp<span>Instagram Audience: </span> 
                                                                <span>{{ $item->audience_instagram }}</span>
                                                            <?php } ?>

                                                            <?php if(!empty($item->audience_youtube)){ ?>
                                                                &nbsp&nbsp<span>Youtube Audience: </span> 
                                                                <span>{{ $item->audience_youtube }}</span>
                                                            <?php } ?>

                                                            <?php if(!empty($item->audience_twitter)){ ?>
                                                                &nbsp&nbsp<span>Twitter Audience: </span> 
                                                                <span>{{ $item->audience_twitter }}</span>
                                                            <?php } ?>

                                                        </p>
                                                        Hashtags
                                                        <ul class="list-inline">
                                                            <?php 
                                                                foreach ($item->jobs_hashtags as $key => $value) {
                                                                    $data = \App\Hashtags::select('tags')
                                                                    ->where('id',$value->hashtags_id)->first();
                                                            ?>
                                                                <li>
                                                                    <i class="glyphicon glyphicon-asterisk"></i>{{ $data->tags }} 
                                                                </li>
                                                            <?php
                                                                }
                                                            ?>
                                                        </ul>

                                                    <?php 
                                                        foreach ($item->jobs_preferred_medium as $key => $value) {
                                                            $data = \App\Preferred_medium::select('preferred_medium_title')
                                                            ->where('id',$value->preferred_medium_id)->first();
                                                    ?>
                                                        <div class="btn btn-default btn-xs"> {{ $data->preferred_medium_title }} </div>
                                                    <?php
                                                        }
                                                    ?>
                                                        <br>
                                                        <br>
                                                        <p>Posted {{ $item->created_at->diffForHumans() }}</p>
                                                    </div>
                                                    <div class="col-md-3" style="padding-top: 6%; ">
                                                        <?php 
                                                            if($check_variable && $check_variable_hashtags){
                                                        ?>
                                                                <a href="{{ url('/find_job_resource/' . $item->id) }}" title="View User">
                                                                    <button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View Job</button>
                                                                </a>
                                                                <a href="{{ url('/find_job_resource/' . $item->id . '/edit') }}" title="Edit User">
                                                                    <button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit / Apply for job</button>
                                                                </a>
                                                        <?php 
                                                            }else{
                                                        ?>
                                                                <a title="Edit User">
                                                                    <button class="btn btn-danger btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Not eligible for this job </button>
                                                                </a>
                                                        <?php
                                                            }
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                    <?php 
                                        // }
                                    ?>
                                @endforeach
                            <?php 
                                }else{
                            ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-9">
                                                <h3>No Jobs Found!</h3>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            ?>
                            <div class="pagination-wrapper"> {!! $device->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

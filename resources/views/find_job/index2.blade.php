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

                        {!! Form::open(['method' => 'GET', 'url' => '/job_post_resource', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
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

                                @foreach($device as $item)
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="col-md-9">
                                                <h3>{{ strtoUpper($item->title) }}</h3>
                                                <p>{{ $item->description }}</p>
                                                <p> 
                                                    <span>Timing: </span>{{ $item->timing }}
                                                    &nbsp&nbsp&nbsp<span>Sallery: </span> <span>{{ $item->sallery }}</span>
                                                </p>
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
                                            </div>
                                            <div class="col-md-3" style="padding-top: 6%; ">
                                                <a href="{{ url('/job_post_resource/' . $item->id) }}" title="View User"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View Job</button></a>
                                                <a href="{{ url('/job_post_resource/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit / Apply for job</button></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            <div class="pagination-wrapper"> {!! $device->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

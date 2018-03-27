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
                        <a href="{{ url('/job_post_resource') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <h3 style="text-align: center;">{{ strtoUpper($jobs->title) }}</h3>
                        {!! Form::open(['method' => 'GET', 'url' => '/job_post_resource', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <!-- <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    search<i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div> -->
                        {!! Form::close() !!}

                        <div class="">
                            <?php 
                                if(!$jobs->jobs_applicant->isEmpty()){
                            ?>
                                <table class="table table-borderless" style="width: 1073px;">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>P.No</th>
                                            <th>Country</th>
                                            <th>Applicant Name</th>
                                            <th>Applicant Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                
                                        @foreach($jobs->jobs_applicant as $item)
                                            <?php 
                                                $user = \App\User::where('id' , $item->applicant_id)->first();
                                            ?>
                                            <tr>
                                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone_number }}</td>
                                                <td>{{ \App\Country::where('id' , $user->country)->first()->country_name }}</td>
                                                <td>{{ $item->applicant_name }}</td>
                                                <td>{{ $item->applicant_description }}</td>
                                                <td>
                                                    <a href="{{ url('/viewprofile_from_find_influencer/' . $item->applicant_id) }}" title="View All Applicants"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View Profile</button></a>
                                                    <a href="{{ url('/job_post_resource/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            <?php                                
                                }else{
                                    echo "<h3 style='text-align: center;'>No one applied for this job yet.</h3>";
                                }
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

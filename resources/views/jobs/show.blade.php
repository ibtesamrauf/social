@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br />
            <br />
            <br />
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pages</div>
                    <div class="panel-body">

                        <a href="{{ url('/job_post_resource') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/job_post_resource/' . $facebook_page_data->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['job_post_resource', $facebook_page_data->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete User',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            ))!!}
                        {!! Form::close() !!}
                        <br/>
                        <br/>

                        <div class="table">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <th>Title</th>
                                        <td>{{ $facebook_page_data->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $facebook_page_data->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Timing</th>
                                        <td>{{ $facebook_page_data->timing }}</td>
                                    </tr>
                                    <tr>
                                        <th>Audience</th>
                                        <td>{{ $facebook_page_data->audience }}</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

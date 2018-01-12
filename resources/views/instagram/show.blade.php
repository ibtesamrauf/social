@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Pages</div>
                    <div class="panel-body">

                        <a href="{{ url('/buildpages') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <a href="{{ url('/buildpages/' . $user->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['buildpages', $user->id],
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
                                        <td>{{ $user->page_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Description</th>
                                        <td>{{ $user->page_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>About page</th>
                                        <td>{{ $user->page_about_your_self }}</td>
                                    </tr>
                                    <tr>
                                        <th>Facebook page url</th>
                                        <td>{{ $user->facebook_page_url }}</td>
                                    </tr>
                                    <tr>
                                        <th>Youtube page url</th>
                                        <td>{{ $user->youtube_page_url }}</td>
                                    </tr>
                                    <tr>
                                        <th>Instagram page url</th>
                                        <td>{{ $user->instagram_page_url }}</td>
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

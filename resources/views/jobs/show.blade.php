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
                                        <th style=" width: 36%; ">Title</th>
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
                                    <?php if(!empty($facebook_page_data->audience_all)){ ?>
                                    <tr>
                                        <th>Audience</th>
                                        <td>
                                            {{ $facebook_page_data->audience_all }}
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(!empty($facebook_page_data->audience_facebook)){ ?>
                                    <tr>
                                        <th>Facebook Audience</th>
                                        <td>
                                            {{ $facebook_page_data->audience_facebook }}
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(!empty($facebook_page_data->audience_instagram)){ ?>
                                    <tr>
                                        <th>Instagram Audience</th>
                                        <td>
                                            {{ $facebook_page_data->audience_instagram }}
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(!empty($facebook_page_data->audience_youtube)){ ?>
                                    <tr>
                                        <th>Youtube Audience</th>
                                        <td>
                                            {{ $facebook_page_data->audience_youtube }}
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <?php if(!empty($facebook_page_data->audience_twitter)){ ?>
                                    <tr>
                                        <th>Twitter Audience</th>
                                        <td>
                                            {{ $facebook_page_data->audience_twitter }}
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                    <tr>
                                        <th>Preferred Medium</th>
                                        <td>
                                            <?php   
                                                foreach ($preferred_medium_job_ids as $key => $value) {
                                                    # code...
                                                    // echo $value->hashtags_id;
                                                    echo \App\Preferred_medium::where('id' , $value->preferred_medium_id )->first()->preferred_medium_title;
                                                    echo "<br>";
                                                }
                                            ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Hashtags</th>
                                        <td>
                                            <?php   
                                                foreach ($hashtags_job_ids as $key => $value) {
                                                    # code...
                                                    // echo $value->hashtags_id;
                                                    echo \App\Hashtags::where('id' , $value->hashtags_id )->first()->tags;
                                                    echo "<br>";
                                                }
                                            ?>
                                        </td>
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

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br />
            <br />
            <br />
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Add</div>
                    <div class="panel-body">
                        <a href="{{ url('/job_post_resource') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                    
                        <br />
                        @if (session('status'))
                            <div class="alert alert-danger">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::open(['url' => '/job_post_resource', 'class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                            {!! Form::label('title', 'Title', ['class' => 'col-md-3 control-label']) !!}
                            <div class="input-group col-md-7">
                                {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                            {!! Form::label('description', 'Description', ['class' => 'col-md-3 control-label']) !!}
                            <div class="input-group col-md-7">
                                {{ Form::textarea('description', null, ['class' => 'form-control']) }}
                                {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('timing') ? 'has-error' : ''}}">
                            {!! Form::label('timing', 'Timing', ['class' => 'col-md-3 control-label']) !!}
                            <div class="input-group col-md-7">
                                {!! Form::text('timing', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('timing', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('audience_facebook') ? 'has-error' : ''}}">
                            {!! Form::label('audience_facebook', 'Audience', ['class' => 'col-md-3 control-label']) !!}
                            <div class="input-group col-md-7">
                                <table style=" width: 100%; ">
                                    <tr>
                                        <td style=" width: 25% ">
                                            {!! Form::label('audience_facebook', 'ALL', ['class' => 'col-md-3 control-label']) !!}
                                        </td>
                                        <td>
                                            {!! Form::number('audience_all', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('audience_all', '<p class="help-block">:message</p>') !!}
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td style=" width: 25% ">
                                            {!! Form::label('audience_facebook', 'Facebook Audience', ['class' => 'col-md-3 control-label']) !!}
                                        </td>
                                        <td>
                                            {!! Form::number('audience_facebook', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('audience_facebook', '<p class="help-block">:message</p>') !!}
                                        </td>                                        
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::label('audience_youtube', 'Youtube Audience', ['class' => 'col-md-3 control-label']) !!}
                                        </td>
                                        <td>
                                            {!! Form::number('audience_youtube', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('audience_youtube', '<p class="help-block">:message</p>') !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::label('audience_instagram', 'Instagram Audience', ['class' => 'col-md-3 control-label']) !!}                            
                                        </td>
                                        <td>
                                            {!! Form::number('audience_instagram', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('audience_instagram', '<p class="help-block">:message</p>') !!}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            {!! Form::label('audience_twitter', 'Twitter Audience', ['class' => 'col-md-3 control-label']) !!}
                                        </td>
                                        <td>
                                            {!! Form::number('audience_twitter', null, ['class' => 'form-control']) !!}
                                            {!! $errors->first('audience_twitter', '<p class="help-block">:message</p>') !!}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        
                        <div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
                            {!! Form::label('preferred_medium', 'Preferred medium', ['class' => 'col-md-3 control-label']) !!}

                            <div class="input-group col-md-7">

                                @foreach($preferred_medium as $preferred_medium_value)
                                <tr>
                                    <td>
                                        <input type="checkbox" value="{{ $preferred_medium_value->id }}" name="preferred_medium[]" id="preferred_medium[]" autofocus 
                                        <?php 
                                            $test = old('preferred_medium');
                                            if(!empty($test)){
                                                if (in_array($preferred_medium_value->id, $test)){
                                                    echo "Checked"; 
                                                } 
                                            }
                                        ?>
                                        > {{ $preferred_medium_value->preferred_medium_title }}<br>
                                        
                                    </td>
                                </tr>
                                @endforeach
                                {!! $errors->first('preferred_medium', '<p class="help-block">:message</p>') !!}    
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('jobs_hashtags') ? 'has-error' : ''}}">
                            {!! Form::label('jobs_hashtags', 'Hashtags', ['class' => 'col-md-3 control-label']) !!}

                            <div class="input-group col-md-7">
                                <ul style=" overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 10px; margin: 0; "> 
                                    @foreach($hashtags as $hashtags_value)
                                        <tr>
                                            <td>
                                            <li>
                                                
                                                <input type="checkbox" value="{{ $hashtags_value->id }}" name="jobs_hashtags[]" id="jobs_hashtags[]" autofocus 
                                                <?php 
                                                    $test = old('jobs_hashtags');
                                                    if(!empty($test)){
                                                        if (in_array($hashtags_value->id, $test)){
                                                            echo "Checked"; 
                                                        } 
                                                    }
                                                ?>
                                                > {{ $hashtags_value->tags }}<br>
                                                
                                            </li>
                                            </td>
                                        </tr>
                                    @endforeach    
                                </ul>
                                {!! $errors->first('jobs_hashtags', '<p class="help-block">:message</p>') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-offset-4 col-md-4">
                                {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

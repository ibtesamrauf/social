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

                        <?php 
                        // vv($jobs);
                        ?>
                        <div class="form-horizontal">
                            
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Title', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7" >
                                    <input type="text" class="form-control" readonly value="{{ strtoUpper($jobs->title) }}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Description', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                    <textarea readonly class="form-control" rows="10">{{ ($jobs->description) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Timing', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                    <input type="text" class="form-control" readonly value="{{ ($jobs->timing) }}">
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Hashtags', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                   
                                    <ul class="list-inline">
                                        <?php 
                                            foreach ($jobs->jobs_hashtags as $key => $value) {
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
                                </div>
                            </div>

                            
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Preferred Medium', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                   
                                    <?php 
                                        foreach ($jobs->jobs_preferred_medium as $key => $value) {
                                            $data = \App\Preferred_medium::select('preferred_medium_title')
                                            ->where('id',$value->preferred_medium_id)->first();
                                    ?>
                                        &nbsp&nbsp<div class="btn btn-default btn-xs"> {{ $data->preferred_medium_title }} </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                        </div>

                        {!! Form::open(['url' => '/apply_for_job_post', 'class' => 'form-horizontal', 'files' => true]) !!}
                            <input type="hidden" name="job_id" id="job_id" value="{{ $jobs->id }}">
                            <div class="form-group {{ $errors->has('applicant_name') ? 'has-error' : ''}}">
                                {!! Form::label('applicant_name', 'Applicant Name', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                    {!! Form::text('applicant_name', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('applicant_name', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('applicant_description') ? 'has-error' : ''}}">
                                {!! Form::label('applicant_description', 'Some description about your self or work', ['class' => 'col-md-3 control-label']) !!}
                                <div class="input-group col-md-7">
                                    {{ Form::textarea('applicant_description', null, ['class' => 'form-control']) }}
                                    {!! $errors->first('applicant_description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Apply', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

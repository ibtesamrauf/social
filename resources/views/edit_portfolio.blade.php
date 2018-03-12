@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

        <br /><br /><br />
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Portfolio</div>
                    <div class="panel-body">

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($data, [
                            'method' => 'POST',
                            'url' => ['/edit_portfolio_update', $data->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}
                            <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                                {!! Form::label('link', 'Link', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('link', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                {!! Form::label('description', 'Description', ['class' => 'col-md-4 control-label']) !!}
                                <div class="col-md-6">
                                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-4 col-md-4">
                                    {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Update', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

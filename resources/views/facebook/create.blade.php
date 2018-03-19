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

                        {!! Form::open(['url' => '/facebook_page_resource', 'class' => 'form-horizontal', 'files' => true]) !!}

                        <div class="form-group {{ $errors->has('page_url') ? 'has-error' : ''}}">
                            {!! Form::label('page_url', 'Page Url', ['class' => 'col-md-3 control-label']) !!}
                            <div class="input-group col-md-7">
                                <span class="input-group-addon" style="/* padding-right: 2px; */">https://www.facebook.com/</span>
                                {!! Form::text('page_url', null, ['class' => 'form-control']) !!}
                                {!! $errors->first('page_url', '<p class="help-block">:message</p>') !!}
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

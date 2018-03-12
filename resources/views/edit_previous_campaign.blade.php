@extends('layouts.app')

@section('content')
<div class="main">
        <section class="module bg-dark-30" data-background="{{ asset('assets/images/section-4.jpg') }}">
          <div class="container">
            <div class="row">
              <div class="col-sm-6 col-sm-offset-3">
                <h1 class="module-title font-alt mb-0">Update-Previous-Campaign</h1>
              </div>
            </div>
          </div>
        </section>
        <section class="module">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading">Previous Campaign</div>
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
                                    'url' => ['/edit_previous_campaign_update', $data->id],
                                    'class' => 'form-horizontal',
                                    'files' => true
                                ]) !!}
                                

                                <div class="form-group {{ $errors->has('client') ? 'has-error' : ''}}">
                                    {!! Form::label('client', 'Client', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('client', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('client', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('link') ? 'has-error' : ''}}">
                                    {!! Form::label('link', 'Link', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('link', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('link', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('details') ? 'has-error' : ''}}">
                                    {!! Form::label('details', 'Details', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('details', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
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
        </section>
        @include('layouts.footer')
    </div>
    <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
@endsection
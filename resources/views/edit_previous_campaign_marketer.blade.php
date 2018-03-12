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
                                    'url' => ['/edit_previous_campaign_update_marketer', $data->id],
                                    'class' => 'form-horizontal',
                                    'files' => true
                                ]) !!}
                                

                                <div class="form-group {{ $errors->has('influencer_used') ? 'has-error' : ''}}">
                                    {!! Form::label('influencer_used', 'Influencer Used', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('influencer_used', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('influencer_used', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>

                                <div class="form-group {{ $errors->has('campaign_link') ? 'has-error' : ''}}">
                                    {!! Form::label('campaign_link', 'Campaign Link', ['class' => 'col-md-4 control-label']) !!}
                                    <div class="col-md-6">
                                        {!! Form::text('campaign_link', null, ['class' => 'form-control']) !!}
                                        {!! $errors->first('campaign_link', '<p class="help-block">:message</p>') !!}
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
        </section>
        @include('layouts.footer')
    </div>
    <div class="scroll-up"><a href="#totop"><i class="fa fa-angle-double-up"></i></a></div>
@endsection
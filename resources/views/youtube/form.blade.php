<div class="form-group {{ $errors->has('page_title') ? 'has-error' : ''}}">
    {!! Form::label('page_title', 'Title', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('page_title', null, ['class' => 'form-control']) !!}
        {!! $errors->first('page_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('page_description') ? 'has-error' : ''}}">
    {!! Form::label('page_description', 'Description', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('page_description', null, ['class' => 'form-control']) !!}
        {!! $errors->first('page_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('page_about_your_self') ? 'has-error' : ''}}">
    {!! Form::label('page_about_your_self', 'About your self', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('page_about_your_self', null, ['class' => 'form-control']) !!}
        {!! $errors->first('page_about_your_self', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('facebook_page_url') ? 'has-error' : ''}}">
    {!! Form::label('facebook_page_url', 'Facebook page url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('facebook_page_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('facebook_page_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('youtube_page_url') ? 'has-error' : ''}}">
    {!! Form::label('youtube_page_url', 'Youtube page url', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('youtube_page_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('youtube_page_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('instagram_page_url') ? 'has-error' : ''}}">
    {!! Form::label('instagram_page_url', 'Instagram page url	', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-6">
        {!! Form::text('instagram_page_url', null, ['class' => 'form-control']) !!}
        {!! $errors->first('instagram_page_url', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
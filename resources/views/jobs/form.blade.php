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
        {!! Form::text('description', null, ['class' => 'form-control']) !!}
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

<div class="form-group {{ $errors->has('audience_all') ? 'has-error' : ''}}">
    {!! Form::label('audience_all', 'Audience all', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::number('audience_all', null, ['class' => 'form-control']) !!}
        {!! $errors->first('audience_all', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('audience_facebook') ? 'has-error' : ''}}">
    {!! Form::label('audience_facebook', 'Facebook Audience', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::number('audience_facebook', null, ['class' => 'form-control']) !!}
        {!! $errors->first('audience_facebook', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('audience_instagram') ? 'has-error' : ''}}">
    {!! Form::label('audience_instagram', 'Instagram Audience all', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::number('audience_instagram', null, ['class' => 'form-control']) !!}
        {!! $errors->first('audience_instagram', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('audience_youtube') ? 'has-error' : ''}}">
    {!! Form::label('audience_youtube', 'Youtube Audience', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::number('audience_youtube', null, ['class' => 'form-control']) !!}
        {!! $errors->first('audience_youtube', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group {{ $errors->has('audience_twitter') ? 'has-error' : ''}}">
    {!! Form::label('audience_twitter', 'Twitter Audience', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::number('audience_twitter', null, ['class' => 'form-control']) !!}
        {!! $errors->first('audience_twitter', '<p class="help-block">:message</p>') !!}
    </div>
</div>




<div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
    {!! Form::label('preferred_medium', 'Job Preferred medium', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        <ul style="overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
        
            @foreach($preferred_medium as $preferred_medium_value)
                <?php
                    if (in_array($preferred_medium_value->id, $temp)) {
                ?>
                        <li class="list-group-item text-right">
                            <span class="pull-left">
                                <strong class="">
                                {{ $preferred_medium_value->preferred_medium_title }}
                                </strong><br>
                            </span>
                            <a href="\job_post_resource_delete_preferred_medium/{{$user->id}}/{{ $preferred_medium_value->id }}" class="btn btn-danger">REMOVE</a>

                        </li>
                <?php
                    }
                ?>
            @endforeach  
        </ul>  
    </div>
</div>

<div class="form-group {{ $errors->has('preferred_medium') ? 'has-error' : ''}}">
    {!! Form::label('preferred_medium', 'Add Job Preferred medium', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        <ul style="overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
        
            @foreach($preferred_medium as $preferred_medium_value)
                <?php
                    if (!in_array($preferred_medium_value->id, $temp)) {
                ?>
                        <li class="list-group-item text-right">
                            <span class="pull-left">
                                <strong class="">
                                {{ $preferred_medium_value->preferred_medium_title }}
                                </strong><br>
                            </span>
                            <a href="\job_post_resource_add_preferred_medium/{{$user->id}}/{{ $preferred_medium_value->id }}" class="btn btn-primary">ADD</a>                            
                        </li>
                <?php
                    }
                ?>
            @endforeach  
        </ul>  
    </div>
</div>




<div class="form-group {{ $errors->has('hashtags_values') ? 'has-error' : ''}}">
    {!! Form::label('hashtags_values', 'Job Hashtags', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        <ul style="overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
        
            @foreach($hashtags as $preferred_medium_value)
                <?php
                    if (in_array($preferred_medium_value->id, $hashtags_id)) {
                ?>
                        <li class="list-group-item text-right">
                            <span class="pull-left">
                                <strong class="">
                                {{ $preferred_medium_value->tags }}
                                </strong><br>
                            </span>
                            <a href="\job_post_resource_delete_hashtags/{{$user->id}}/{{ $preferred_medium_value->id }}" class="btn btn-danger">REMOVE</a>

                        </li>
                <?php
                    }
                ?>
            @endforeach  
        </ul>  
    </div>
</div>

<div class="form-group {{ $errors->has('hashtags_values') ? 'has-error' : ''}}">
    {!! Form::label('hashtags_values', 'Add Job Hashtags', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        <ul style="overflow: scroll; overflow-x: hidden; height: 20em; line-height: 2em; border: 1px solid #ccc; padding: 0; margin: 0; ">
        
            @foreach($hashtags as $preferred_medium_value)
                <?php
                    if (!in_array($preferred_medium_value->id, $hashtags_id)) {
                ?>
                        <li class="list-group-item text-right">
                            <span class="pull-left">
                                <strong class="">
                                {{ $preferred_medium_value->tags }}
                                </strong><br>
                            </span>
                            <a href="\job_post_resource_add_hashtags/{{$user->id}}/{{ $preferred_medium_value->id }}" class="btn btn-primary">ADD</a>                            
                        </li>
                <?php
                    }
                ?>
            @endforeach  
        </ul>  
    </div>
</div>

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
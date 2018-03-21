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

<div class="form-group {{ $errors->has('sallery') ? 'has-error' : ''}}">
    {!! Form::label('sallery', 'Sallery', ['class' => 'col-md-3 control-label']) !!}
    <div class="input-group col-md-7">
        {!! Form::text('sallery', null, ['class' => 'form-control']) !!}
        {!! $errors->first('sallery', '<p class="help-block">:message</p>') !!}
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

<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
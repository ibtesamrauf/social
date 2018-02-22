@extends('layouts.master2') 

@section('content')
    <h2>Create a new message</h2>
    <form action="{{ route('messages_marketer.store') }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <h5>{{ $temp->name }}</h5>
                <input style="display:none" type="text" class="form-control" name="subject" placeholder="Subject" value="{{ $temp->name }}">
                <input style="display:none" type="text" class="form-control" name="belongsto1" placeholder="belongsto1" value="{{ $belongsto1 }}">
                       
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            <label title="{{ $user_id }}">
                <input style="display:none" type="checkbox" name="recipients[]" checked value="{{ $user_id }}">
            </label>
    
            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
    </form>
@stop

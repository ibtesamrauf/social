@extends('layouts.app')

@section('content')

<!-- <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->

<div class="main">
    <section class="module bg-dark-30" data-background="{{ asset('assets/images/section-4.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <h1 class="module-title font-alt mb-0">Inbox</h1>
                </div>
            </div>
        </div>
    </section>
    <section class="module">
        <div class="container">
            <div class="row">
                <div class="">
                    <div class="panel panel-default">
                        <div class="panel-heading">Inbox</div>

                        <div class="panel-body">
                            @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                            @endif
                            <div class="col-md-12">
                                <h2>Create a new message</h2>
                                <form action="{{ route('messages_marketer.store') }}" method="post">
                                    {{ csrf_field() }}
                                    <div class="col-md-6">
                                        <!-- Subject Form Input -->
                                        <div class="form-group">
                                            <label class="control-label">Subject</label>
                                            <h5>{{ !empty($temp->name) ? $temp->name : strtoUpper($temp->title)}}</h5>
                                            <input style="display:none" type="text" class="form-control" name="subject" placeholder="Subject" value="{{ !empty($temp->name) ? $temp->name : $temp->title}}">
                                            <input style="display:none" type="text" class="form-control" name="belongsto1" placeholder="belongsto1" value="{{ $belongsto1 }}">
                                                   
                                        </div>

                                        <!-- Message Form Input -->
                                        <div class="form-group">
                                            <label class="control-label">Message</label>
                                            <textarea name="message" style=" width: 120%; height: 154px; " class="form-control">{{ old('message') }}</textarea>
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
                            </div>
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




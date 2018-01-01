@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="">
            <div class="panel panel-default">
                <div class="panel-heading">Find Infulencer</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="panel-body">
                        <div class="container">
                            <div class="row">
                                <table class="table">
                                <th>Name</th>
                                <th>Page title</th>
                                <th>About Them</th>
                                    @foreach ($user_page_data as $video)
                                        <tr>
                                            <td>
                                                {{ $video->Users->name }}    
                                            </td>
                                            <td>
                                                {{ $video->page_title }}
                                            </td>
                                            <td>
                                                {{ $video->page_about_your_self }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                            {!! $user_page_data->render() !!} 
                        </div>
                        <!-- <img src="http://img.youtube.com/vi/{{ $video->videos_url }}/0.jpg"> -->
                        <!-- {{ $video->videos_url }} -->
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

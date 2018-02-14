@extends('layouts.master2')

@section('content')
    @include('messenger_marketer.partials.flash')

    @each('messenger_marketer.partials.thread', $threads, 'thread', 'messenger_marketer.partials.no-threads')
@stop

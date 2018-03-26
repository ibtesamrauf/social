@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <br />
            <br />
            <br />
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Job View</div>
                    <div class="panel-body">
                        <h3>{{ strtoUpper($facebook_page_data->title) }}</h3>
                        <p>{{ $facebook_page_data->description }}</p>
                        <p>
                            <span>Timing: {{ $facebook_page_data->timing }}</span>
                            &nbsp&nbsp
                            <span>Salery: {{ $facebook_page_data->sallery }}</span>
                        </p>
                        <span>Preffered Mediums</span>&nbsp&nbsp
                        <?php 
                            foreach ($facebook_page_data->jobs_preferred_medium as $key => $value) {
                                $data = \App\Preferred_medium::select('preferred_medium_title')
                                ->where('id',$value->preferred_medium_id)->first();
                        ?>
                            <div class="btn btn-default btn-xs"> {{ $data->preferred_medium_title }} </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<?php 
// $count = Auth::guard('jobseeker')->user()->newThreadsCount(); 
// $count = 1; 

$count = \App\Exceptions\Handler::newMessageCount('influencer');
// vv("asdsad");
?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif

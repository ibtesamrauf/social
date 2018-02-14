<?php 
// $count = Auth::user()->newThreadsCount(); 
$count = 1; 
?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif

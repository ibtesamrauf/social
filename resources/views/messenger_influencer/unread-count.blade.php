<?php 
	$count = \App\Helpers\CommonFunctions::newMessageCount('marketer');
	// v($count);
?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif

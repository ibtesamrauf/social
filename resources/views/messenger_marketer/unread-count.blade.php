<?php $count = \App\Helpers\CommonFunctions::newMessageCount('influencer'); ?>
@if($count > 0)
    <span class="label label-danger">{{ $count }}</span>
@endif

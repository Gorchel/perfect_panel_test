<?php
    use app\modules\orders\helpers\UrlHelper;
?>

<div class="dropdown">
    <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Mode
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <li class="active"><a href="<?php echo UrlHelper::getPathWithParams(['mode' => '-1']) ?>">All</a></li>
        <li><a href="<?php echo UrlHelper::getPathWithParams(['mode' => 0]) ?>">Manual</a></li>
        <li><a href="<?php echo UrlHelper::getPathWithParams(['mode' => 1]) ?>">Auto</a></li>
    </ul>
</div>
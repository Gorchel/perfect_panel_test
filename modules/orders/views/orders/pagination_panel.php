<?php

use yii\widgets\LinkPager;

$currentPage = $pagination->page;
$perPage = $pagination->defaultPageSize;

?>

<div class="row" id="pagination_panel">
    <div class="col-lg-6">
        <?= LinkPager::widget(
            [
                'pagination' => $pagination,
            ]
        ); ?>
    </div>
    <div class="col-lg-6 pull-right" id="pagination_panel_counter">
        <p class="text-right">
            <?php
            echo ($currentPage * $perPage) + 1 ?> to <?php
            echo(($currentPage + 1) * $perPage) ?>
            of <?php
            echo $pagination->totalCount ?>
        </p>
    </div>
</div>
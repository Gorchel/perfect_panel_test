<?php

use orders\helpers\UrlHelper;

$requestMode = Yii::$app->request->get('mode');
?>

<div class="dropdown">
    <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="true">
        <?php
        echo Yii::t('orders', 'orders.mode.mode') ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <?php
        foreach ($modes as $key => $mode) {
            $li = "<li class=" . ($requestMode == $key ? 'active' : '') . ">";
            $li .= "<a href=" . UrlHelper::getPathWithParams(['mode' => $key]) . ">";
            $li .= \Yii::t('orders', "orders.mode." . $mode['slug']);
            $li .= "</a></li>";

            echo $li;
        }
        ?>
    </ul>
</div>
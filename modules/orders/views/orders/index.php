<?php 

use app\modules\orders\assets\OrderAsset;
use yii\bootstrap\Button;
use yii\widgets\Menu;

OrderAsset::register($this); 

?>

<div class="row" id="status_panel">
    <?php
        echo Menu::widget([
            'options' => ['class' => 'nav nav-tabs p-b'],
            'items' => array_map(function( $status) {
                return ['label' => $status, 'url' => ['/orders/orders/index/'.strtolower(str_replace(' ','_',$status))]];
            }, $statuses),
        ]);
       
    ?>

    <h1><?= json_encode($statuses) ?></h1>
</div>
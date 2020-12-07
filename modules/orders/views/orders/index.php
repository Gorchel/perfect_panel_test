<?php 

use app\modules\orders\assets\OrderAsset;

OrderAsset::register($this); 

?>

<div class="row" id="status_panel">
    <?= $this->render('status_panel', [
        'statuses' => $statuses
    ]); ?>

    <?= $this->render('tables', [
        'ordersPaginationArray' => $ordersPaginationArray
    ]); ?>

    <h1><?= json_encode($statuses) ?></h1>
</div>
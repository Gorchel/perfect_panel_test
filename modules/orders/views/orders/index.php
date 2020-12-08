<?php 

use app\modules\orders\assets\OrderAsset;

OrderAsset::register($this); 

?>

<div class="row" id="status_panel">
    <?= $this->render('statuses/status_panel', [
        'statuses' => $statuses
    ]); ?>

    <?= $this->render('tables', [
        'ordersPaginationArray' => $ordersPaginationArray,
        'servicesList' => $servicesList
    ]); ?>
</div>

<?= $this->render('pagination_panel', [
    'ordersPaginationArray' => $ordersPaginationArray
]); ?>
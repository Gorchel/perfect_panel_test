<?php 

use app\modules\orders\assets\OrderAsset;

OrderAsset::register($this); 

?>

<div class="row" id="status_panel">
    <div class="col-lg-7">
        <?= $this->render('statuses/status_panel', [
            'statuses' => $statuses
        ]); ?>
    </div>
    <div class="col-lg-5">
        <?= $this->render('search_panel'); ?>
    </div>

    <?= $this->render('tables', [
        'ordersPaginationArray' => $ordersPaginationArray,
        'servicesList' => $servicesList
    ]); ?>
</div>

<?= $this->render('pagination_panel', [
    'ordersPaginationArray' => $ordersPaginationArray
]); ?>
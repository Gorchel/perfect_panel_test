<?php 

use app\modules\orders\assets\OrderAsset;

OrderAsset::register($this); 

?>
    <div class="row">
        <div class="col-lg-12 text-right">
            <?= $this->render('lang/switcher'); ?>
        </div>
    </div>
<div class="row">
    <div class="col-lg-12 text-right">
        <?= $this->render('export/link'); ?>
    </div>
</div>
<div class="row" id="status_panel">
    <div class="col-lg-8">
        <?= $this->render('statuses/status_panel', [
            'statuses' => $statuses
        ]); ?>
    </div>
    <div class="col-lg-4">
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
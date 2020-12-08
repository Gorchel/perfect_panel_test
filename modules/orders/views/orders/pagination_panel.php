<?php
    use yii\widgets\LinkPager;
?>

<div class="row" id="pagination_panel">
    <div class="col-lg-6">
        <?= LinkPager::widget([
            'pagination' => $ordersPaginationArray['pagination'],
        ]); ?>
    </div>
    <div class="col-lg-6 pull-right" id="pagination_panel_counter">
        <p class="text-right">
            <?php echo $ordersPaginationArray['preparePagination']['from']?> to <?php echo $ordersPaginationArray['preparePagination']['to']?>
            of <?php echo $ordersPaginationArray['preparePagination']['totalCount']?>
        </p>
    </div>
</div>
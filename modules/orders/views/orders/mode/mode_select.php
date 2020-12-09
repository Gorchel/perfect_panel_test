<?php
    use app\modules\orders\helpers\UrlHelper;

    $requestMode= Yii::$app->request->get('mode');
    $modes = [
        -1 => 'All',
        0 => 'Manual',
        1 => 'Auto',
    ];
?>

<div class="dropdown">
    <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <?php echo \Yii::t('orders', 'Mode') ?>
        <span class="caret"></span>
    </button>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
        <?php
            foreach ($modes as $key => $mode) {
                echo "<li class=".($requestMode == $key ? 'active' : '')."><a href=".UrlHelper::getPathWithParams(['mode' => $key]).">".\Yii::t('orders', $mode)."</a></li>";
            }
        ?>
    </ul>
</div>
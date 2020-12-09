<?php
    use yii\helpers\Html;
    use orders\helpers\UrlHelper;

    echo Html::a(\Yii::t('orders', 'orders.export.save'), [UrlHelper::getPathWithParams([], '/orders/export/make_links')], ['target'=>'_blank'])
?>



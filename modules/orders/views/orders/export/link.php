<?php
    use yii\helpers\Html;
    use orders\helpers\UrlHelper;

    echo Html::a(\Yii::t('orders', 'Save result'), [UrlHelper::getPathWithParams([], '/orders/export/make_links')], ['target'=>'_blank'])
?>



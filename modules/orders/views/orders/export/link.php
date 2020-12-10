<?php
    use yii\helpers\Html;
    use orders\helpers\UrlHelper;

    echo Html::a(\Yii::t('orders', 'orders.export.save'), [UrlHelper::getPathWithParams(['status' => Yii::$app->request->get('status')], '/orders/export/make_links')], ['target'=>'_blank'])
?>



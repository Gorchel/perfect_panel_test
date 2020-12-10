<?php

use orders\helpers\UrlHelper;
use yii\helpers\Html;

echo Html::a(
    Yii::t('orders', 'orders.export.save'),
    [
        UrlHelper::getPathWithParams(
            ['status' => Yii::$app->request->get('status')],
            '/orders/export/make_links'
        )
    ],
    ['target' => '_blank']
)
?>



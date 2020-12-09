<?php
    use yii\helpers\Html;

    foreach ($links as $link) {
        echo Html::a(Yii::t('orders', 'orders.export.save'), '/orders/export/download?path='.$link, ['target' => '_blank']);
        echo "<br/>";
    }
?>

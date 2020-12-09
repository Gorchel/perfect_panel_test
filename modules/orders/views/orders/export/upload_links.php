<?php
    use yii\helpers\Html;

    foreach ($links as $link) {
        echo Html::a('Save result', '/orders/export/upload?path='.$link, ['target' => '_blank']);
        echo "<br/>";
    }
?>

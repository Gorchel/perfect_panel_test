<?php
    use yii\helpers\Html;
    use app\modules\orders\helpers\UrlHelper;

    foreach ($links as $link) {
        echo Html::a('Save result', '/orders/export/upload?path='.$link, ['target' => '_blank']);
        echo "<br/>";
    }
?>

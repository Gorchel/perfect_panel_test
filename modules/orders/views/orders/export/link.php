<?php
    use yii\helpers\Html;
    use app\modules\orders\helpers\UrlHelper;

    echo Html::a('Save result', [UrlHelper::getPathWithParams([], '/orders/orders/export')], ['target'=>'_blank'])
?>



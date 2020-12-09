<?php
    use yii\helpers\Html;
    use app\modules\orders\helpers\UrlHelper;

    echo Html::a(\Yii::t('common', 'Save result'), [UrlHelper::getPathWithParams([], '/orders/export/make_links')], ['target'=>'_blank'])
?>



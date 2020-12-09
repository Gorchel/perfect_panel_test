<?php
  use app\modules\orders\helpers\UrlHelper;
  use yii\helpers\Html;

  echo Html::a('en', [UrlHelper::getPathWithParams(['lang' => 'en'])]);
  echo " / ";
  echo Html::a('ru', [UrlHelper::getPathWithParams(['lang' => 'ru'])]);
?>
<?php

namespace app\modules\orders\assets;

use yii\web\AssetBundle;
class OrderAsset extends AssetBundle
{
    // the alias to your assets folder in your file system
    public $sourcePath = '@app/modules/orders/assets';
    // finally your files.. 
    public $css = [
      './assets/css/custom.css',
    ];
    // public $js = [
    //   'js/first-js-file.js',
    //   'js/second-js-file.js',
    // ];
    // that are the dependecies, for makeing your Asset bundle work with Yii2 framework
    // public $depends = [
    //     'yii\web\YiiAsset',
    //     'yii\bootstrap\BootstrapAsset',
    // ];
} 
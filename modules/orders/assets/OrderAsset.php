<?php

namespace orders\assets;

use yii\web\AssetBundle;
class OrderAsset extends AssetBundle
{
    // the alias to your assets folder in your file system
    public $sourcePath = '@app/modules/orders/assets';
    // finally your files..
    public $css = [
      './css/custom.css',
    ];
} 
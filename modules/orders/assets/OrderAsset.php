<?php

namespace orders\assets;

use yii\web\AssetBundle;

/**
 * Class OrderAsset
 * @package orders\assets
 */
class OrderAsset extends AssetBundle
{
    // the alias to your assets folder in your file system
    /**
     * @var string
     */
    public $sourcePath = '@app/modules/orders/assets';
    // finally your files..
    /**
     * @var string[]
     */
    public $css = [
        './css/custom.css',
    ];
} 
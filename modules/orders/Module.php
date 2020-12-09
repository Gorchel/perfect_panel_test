<?php

namespace orders;

use Yii;
use yii\base\Module as ParentModule;

/**
 * order_list module definition class
 */
class Module extends ParentModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'orders\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main';

        Yii::configure($this, require(__DIR__ . '/config/main.php'));
//        Yii::setPathOfAlias('mynamespace', '/var/www/common/mynamespace/');
    }

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}

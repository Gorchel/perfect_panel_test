<?php

namespace app\modules\orders;

use yii\helpers\VarDumper;

/**
 * order_list module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\orders\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->layout = 'main';

        \Yii::configure($this, require(__DIR__ . '/config/main.php'));

        $this->setAliases([
            'OrderAsset' => __DIR__ . '/assets'
        ]);

        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
    }

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}

<?php

namespace app\modules\orders;

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
    }

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}

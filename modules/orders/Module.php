<?php

namespace orders;

use orders\classes\lang\LanguageSetter;
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

        $langSwitcher = new LanguageSetter($_ENV['LOCAL_LANG']);
        $langSwitcher->set();
    }

    public $depends = [
        'yii\bootstrap\BootstrapAsset',
    ];
}

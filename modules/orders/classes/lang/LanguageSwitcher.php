<?php

namespace app\modules\orders\classes\lang;

use Yii;
use app\modules\orders\classes\export\types\TypeInterface;
use yii\helpers\VarDumper;

/**
 * Class LanguageSwitcher
 * @package app\modules\orders\classes\lang
 */
class LanguageSwitcher
{
    /**
     * @var string
     */
    protected $lang;

    /**
     * LanguageSwitcher constructor.
     * @param string $lang
     */
    public function __construct(?string $lang = null)
    {
        switch($lang) {
            case 'ru':
                $this->lang = 'ru-RU';
                break;
            case 'en':
                $this->lang = 'en-en';
                break;
        }
    }

    /**
     *
     */
    public function switching() {
        $session = Yii::$app->session;

        if (!empty($this->lang)) {
            \Yii::$app->language = $this->lang;
            $session->set('language', $this->lang);
        } else {
            \Yii::$app->language = $session->get('language');
        }

    }
}
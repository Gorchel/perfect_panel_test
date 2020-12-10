<?php

namespace orders\classes\lang;

use Yii;

/**
 * Class LanguageSetter
 * @package orders\classes\lang
 */
class LanguageSetter
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
     * Set localization
     */
    public function set() {
        if (!empty($this->lang)) {
            Yii::$app->language = $this->lang;
        }
    }
}
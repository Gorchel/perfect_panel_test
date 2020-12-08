<?php

namespace app\modules\orders\helpers;

use yii\helpers\Url;

/**
 * Class UrlHelper
 * @package app\modules\orders\helpers
 */
class UrlHelper
{
    /**
     * @param array $newParam
     * @return array|false|int|string|null
     */
    public static function getPathWithParams(array $newParam = [])
    {
        $params = self::getParamsFromPath($newParam);
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        return $path.'?'.http_build_query($params);
    }

    /**
     * @param array $newParam
     * @return array|false|int|string|null
     */
    protected static function getParamsFromPath(array $newParam = [])
    {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
        $params = [];

        parse_str($url, $params);

        if (!empty($newParam)) {
            $params[key($newParam)] = $newParam[key($newParam)];
        }

        return $params;
    }
}

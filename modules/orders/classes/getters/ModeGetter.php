<?php

namespace orders\classes\getters;

/**
 * Class ModeGetter
 * @package orders\classes\getters
 */
class ModeGetter
{
    /**
     * @return string[][]
     */
    public static function getModes()
    {
        return [
            -1 => ['slug' => 'all', 'key' => 'All'],
            0 => ['slug' => 'manual', 'key' => 'Manual'],
            1 => ['slug' => 'auto', 'key' => 'Auto'],
        ];
    }

    /**
     * @return array
     */
    public static function getKeys()
    {
        return array_keys(self::getModes());
    }
}
<?php

namespace orders\classes\getters;

/**
 * Class FilterGetter
 * @package orders\classes\getters
 */
class FilterGetter
{
    /**
     * @var array|\string[][]
     */
    private static array $searchTypes = [
        1 => ['key' => 'orders_id', 'name' => 'Order Id'],
        2 => ['key' => 'link', 'name' => 'Link Id'],
        3 => ['key' => 'user_name', 'name' => 'Username'],
    ];

    /**
     * @return array|\string[][]
     */
    public static function getSearchTypes()
    {
        return self::$searchTypes;
    }
}
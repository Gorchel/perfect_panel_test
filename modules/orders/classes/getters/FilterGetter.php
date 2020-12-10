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

    /**
     * @return string[]
     */
    public static function filterFields()
    {
        return [
            'status',
            'mode',
            'service_id',
            'search',
            'search-type',
        ];
    }

    /**
     * @return array
     */
    public static function getRules()
    {
        return [
            ['mode', 'in', ['range' => ModeGetter::getKeys()]],
            ['status', 'in', ['range' => StatusGetter::getListByKey('slug')]],
            ['status', 'string'],
            [['mode', 'service_id', 'status_id'], 'integer'],
        ];
    }

    /**
     * differs from getRules
     * validation is performed if the key field exists
     */
    public static function getSearchingRules()
    {
        return [
            'search-type' => [['search', 'search-type'], 'required'],
        ];
    }
}
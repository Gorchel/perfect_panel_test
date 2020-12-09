<?php

namespace orders\classes\getters;

/**
 * Class FilterGetter
 * @package orders\classes\getters
 */
class FilterGetter
{
    public const SEARCH_TYPES = [
        1 => ['key' => 'orders_id', 'name' => 'Order Id'],
        2 => ['key' => 'link', 'name' => 'Link Id'],
        3 => ['key' => 'user_name', 'name' => 'Username'],
    ];
}
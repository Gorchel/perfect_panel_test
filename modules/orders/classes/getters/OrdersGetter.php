<?php

namespace orders\classes\getters;

/**
 * Class OrdersGetter
 *
 * @package orders\classes\getters
 */
class OrdersGetter
{
    /**
     * @return mixed
     */
    public static function getPerPage()
    {
        return $_ENV['ORDERS_PER_PAGE'];
    }
}
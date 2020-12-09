<?php

namespace orders\classes\orders;

use \yii\web\Request;

/**
 * Class OrderManager
 *
 * Generates data for the table
 *
 * @package orders\classes\orders
 */
class OrderManager
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function handle()
    {
        //Get Pagination List
        $ordersGetter = new OrdersGetter($this->request);
        $paginationList = $ordersGetter->getPaginationList();

        //preparation of pagination data
        $perPage = $_ENV['ORDERS_PER_PAGE'];

        $preparePagination = [
            'totalCount' => $paginationList['pagination']->totalCount,
            'from' => ($paginationList['pagination']->page * $perPage) + 1,
            'to' => ($paginationList['pagination']->page + 1) * $perPage,
        ];

        //get orders
        $orders = $paginationList['orders'];

        return [
            'orders' => $orders,
            'pagination' => $paginationList['pagination'],
            'preparePagination' => $preparePagination
        ];
    }
}
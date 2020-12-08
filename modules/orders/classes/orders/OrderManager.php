<?php

namespace app\modules\orders\classes\orders;

use app\modules\orders\classes\statuses\StatusGetter;
use yii\helpers\VarDumper;
use \yii\web\Request;
use Yii;

/**
 * Class OrderManager
 * @package app\modules\orders\classes\orders
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
        $perPage = Yii::$app->getModule('orders')->params['pagination']['per_page'];

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
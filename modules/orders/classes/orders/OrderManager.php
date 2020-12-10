<?php

namespace orders\classes\orders;

use yii\base\DynamicModel;

/**
 * Class OrderManager
 *
 * Generates data for the pagination for table
 *
 * @package orders\classes\orders
 */
class OrderManager
{

    /**
     * @var DynamicModel|null
     */
    protected ?DynamicModel $filterModel;

    /**
     * OrderManager constructor.
     * @param DynamicModel|null $filterModel
     */
    public function __construct(?DynamicModel $filterModel = null)
    {
        $this->filterModel = $filterModel;
    }

    /**
     * Return list of orders and pagination class
     *
     * @return array
     */
    public function handle()
    {
        //Get Pagination List
        $ordersQueryManager = new OrderQueryManager($this->filterModel);
        $paginationList = $ordersQueryManager->getPaginationList();

        //get orders
        $orders = $paginationList['orders'];

        return [
            'orders' => $orders,
            'pagination' => $paginationList['pagination'],
        ];
    }
}
<?php

namespace orders\classes\orders;

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
     * @var array
     */
    protected array $filters;

    /**
     * OrderManager constructor.
     * @param array $filters
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Return list of orders and pagination class
     *
     * @return array
     */
    public function handle()
    {
        //Get Pagination List
        $ordersQueryManager = new OrderQueryManager($this->filters);
        $paginationList = $ordersQueryManager->getPaginationList();

        //get orders
        $orders = $paginationList['orders'];

        return [
            'orders' => $orders,
            'pagination' => $paginationList['pagination'],
        ];
    }
}
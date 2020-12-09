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
    protected $filters;

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
        $ordersGetter = new OrderQueryManager($this->filters);
        $paginationList = $ordersGetter->getPaginationList();

        //get orders
        $orders = $paginationList['orders'];

        return [
            'orders' => $orders,
            'pagination' => $paginationList['pagination'],
        ];
    }
}
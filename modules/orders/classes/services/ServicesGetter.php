<?php

namespace orders\classes\services;

use orders\classes\statuses\StatusGetter;
use yii\db\Query;

    /**
 * Class ServicesGetter
 * @package orders\classes\services
 */
class ServicesGetter
{
    /**
     * @var
     */
    protected $request;

    /**
     * OrdersGetter constructor.
     * @param $request
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     */
    public function getOrdersServicesList()
	{
	    $list = $this->getList();

		return $list;
	}

    /**
     * @return array
     */
    protected function getList()
    {
        $query = (new Query());
        $query->select(['services.id as id, services.name as name, COUNT(orders.id) as count'])
            ->from('services')
            ->rightJoin('orders', '`orders`.`service_id` = `services`.`id`');

        $this->filter($query);

        return $query->groupBy('orders.service_id')
            ->all();
    }

    /**
     * @param $query
     */
    protected function filter(&$query)
    {
        if (!is_null($this->request->get('status'))) {
            $statusGetter = new StatusGetter;
            $statusId = $statusGetter->transformStatus2Key($this->request->get('status'));
            $query->where(['orders.status' => $statusId]);
        }
    }
}
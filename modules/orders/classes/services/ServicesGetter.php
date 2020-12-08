<?php

namespace app\modules\orders\classes\services;

use app\modules\orders\classes\statuses\StatusGetter;

/**
 * Class ServicesGetter
 * @package app\modules\orders\classes\services
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
//        $list = $this->makePrettyList($list);

		return $list;
	}

    /**
     * @return array
     */
    protected function getList()
    {
        $query = (new \yii\db\Query());
        $query->select(['services.id as id, services.name as name, COUNT(orders.id) as count'])
            ->from('services')
            ->rightJoin('orders', '`orders`.`service_id` = `services`.`id`');

        $this->filter($query);

        return $query->groupBy('orders.service_id')
            ->all();
    }


    /**
     * @param array $list
     * @return array
     */
    protected function makePrettyList(array $list): array
    {
        $prettyList = [];

        if (!empty($list)) {
            foreach ($list as $itemArr) {
                $prettyList[$itemArr['id']] = [
                    'name' => $itemArr['name'],
                    'count' => $itemArr['count'],
                ];
            }
        }

        return $prettyList;
    }

    /**
     * @param $query
     */
    protected function filter(&$query)
    {
        if (!is_null($this->request->get('status'))) {
            $statusGetter = new StatusGetter;
            $status_id = $statusGetter->transformStatus2Key($this->request->get('status'));
            $query->where(['orders.status' => $status_id]);
        }
    }
}
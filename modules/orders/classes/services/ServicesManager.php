<?php

namespace orders\classes\services;

use yii\db\Query;

/**
 * Class ServicesManager
 *
 * Return filtered services
 *
 * @package orders\classes\services
 */
class ServicesManager
{

    /**
     * @var array
     */
    protected array $filters;

    /**
     * ServicesManager constructor.
     * @param array $filters
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Make Query to database
     *
     * @return array
     */
    public function getList()
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
     * Filtered services from database
     *
     * @param $query
     */
    protected function filter(&$query)
    {
        if (isset($this->filters['status_id'])) {
            $query->andWhere(['status' => $this->filters['status_id']]);
        }
    }
}
<?php

namespace orders\classes\services;

use yii\base\DynamicModel;
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
     * @var DynamicModel|null
     */
    protected ?DynamicModel $filterModel;

    /**
     * ServicesManager constructor.
     * @param DynamicModel|null $filterModel
     */
    public function __construct(?DynamicModel $filterModel = null)
    {
        $this->filterModel = $filterModel;
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
        if (!empty($this->filterModel)) {
            if (isset($this->filterModel->status_id)) {
                $query->andWhere(['status' => $this->filterModel->status_id]);
            }
        }
    }
}
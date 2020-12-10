<?php

namespace orders\classes\orders;

use orders\classes\getters\OrdersGetter;
use orders\models\Orders;
use yii\data\Pagination;
use yii\db\ActiveQuery;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/**
 * Class OrderQueryManager
 *
 * make pagination orders query with filters
 *
 * @package orders\classes\orders
 */
class OrderQueryManager
{

    /**
     * @var array
     */
    protected array $filters;


    /**
     * OrderQueryManager constructor.
     * @param array $filters
     */
    public function __construct(array $filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * @return ActiveQuery
     */
    public function getQuery()
    {
        $query = Orders::find();

        $query->with(['users', 'services']);

        $this->filter($query);

        return $query;
    }

    /**
     * @return array
     */
    public function getPaginationList()
    {
        $query = $this->getQuery();

        $pagination = new Pagination(
            [
                'defaultPageSize' => OrdersGetter::getPerPage(),
                'pageSizeLimit' => [1, 100],
                'totalCount' => $query->count(),
                'route' => Url::to(['/orders']),
            ]
        );

        $query->offset($pagination->offset)
            ->limit($pagination->limit)
            ->orderBy(['orders.id' => SORT_DESC]);

        return [
            'orders' => $query->all(),
            'pagination' => $pagination,
        ];
    }

    /**
     * @param $query
     */
    protected function filter(&$query)
    {
        if (isset($this->filters['status_id'])) {
            $query->where(['status' => $this->filters['status_id']]);
        }

        if (isset($this->filters['mode']) && !is_null($this->filters['mode']) && $this->filters['mode'] >= 0) {
            $query->where(['mode' => $this->filters['mode']]);
        }

        if (isset($this->filters['service_id']) && !empty($this->filters['service_id'])) {
            $query->where(['service_id' => $this->filters['service_id']]);
        }

        if (
            isset($this->filters['search-type']) &&
            isset($this->filters['search']) &&
            !empty($this->filters['search-type'])
        ) {
            switch ($this->filters['search-type']) {
                case 1:
                    $value = intval($this->filters['search']);

                    if (!empty($value)) {
                        $query->where(['id' => $value]);
                    }
                    break;
                case 2:
                    $value = $this->filters['search'];

                    $query->where(['like', 'link', $value]);
                    break;
                case 3:
                    $value = $this->filters['search'];

                    $query->joinWith(
                        [
                            'users' => function ($query) use ($value) {
                                $query->where(['like', 'CONCAT(users.first_name," ",users.last_name)', $value]);
                                $query->orWhere(['like', 'CONCAT(users.last_name," ",users.first_name)', $value]);
                            },
                        ]
                    );
                    break;
            }
        }
    }
}
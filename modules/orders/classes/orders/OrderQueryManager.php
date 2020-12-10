<?php

namespace orders\classes\orders;

use orders\classes\getters\OrdersGetter;
use orders\models\Orders;
use yii\base\DynamicModel;
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
     * @var ?DynamicModel|null
     */
    protected ?DynamicModel $filterModel;

    /**
     * OrderQueryManager constructor.
     * @param DynamicModel|null $filterModel
     */
    public function __construct(?DynamicModel $filterModel = null)
    {
        $this->filterModel = $filterModel;
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
        if (!empty($this->filterModel)) {
            if (isset($this->filterModel->status_id)) {
                $query->andWhere(['status' => $this->filterModel->status_id]);
            }

            if (isset($this->filterModel->mode)) {
                $query->andWhere(['mode' => $this->filterModel->mode]);
            }

            if (isset($this->filterModel->service_id)) {
                $query->andWhere(['service_id' => $this->filterModel->service_id]);
            }

            switch ($this->filterModel['search-type']) {
                case 1:
                    $value = intval($this->filterModel['search']);

                    if (!empty($value)) {
                        $query->andWhere(['id' => $value]);
                    }
                    break;
                case 2:
                    $value = $this->filterModel['search'];

                    $query->andWhere(['like', 'link', $value]);
                    break;
                case 3:
                    $value = $this->filterModel['search'];

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
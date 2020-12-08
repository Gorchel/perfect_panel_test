<?php

namespace app\modules\orders\classes\orders;

use app\modules\orders\classes\statuses\StatusGetter;
use app\modules\orders\models\Orders;
use yii\data\Pagination;
use Yii;
use yii\helpers\VarDumper;

/**
 * Class OrdersGetter
 * @package app\modules\orders\classes\orders
 */
class OrdersGetter
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
     * @return \yii\db\ActiveQuery
     */
    public function getQuery()
    {
        $query = Orders::find();

        $query->with(['users','services']);

        $this->filter($query);

        return $query;
    }

    /**
     * @return array
     */
    public function getPaginationList()
    {
        $query = $this->getQuery();

        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->getModule('orders')->params['pagination']['per_page'],
            'pageSizeLimit' => [1, 100],
            'totalCount' => $query->count(),
        ]);

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
        if (!is_null($this->request->get('status'))) {
            $statusGetter = new StatusGetter;
            $status_id = $statusGetter->transformStatus2Key($this->request->get('status'));
            $query->where(['status' => $status_id]);
        }

        if (!is_null($this->request->get('mode')) && $this->request->get('mode') >= 0) {
            $query->where(['mode' => $this->request->get('mode')]);
        }

        if (!empty($this->request->get('service_id'))) {
            $query->where(['service_id' => $this->request->get('service_id')]);
        }

        //searching
        if (!empty($this->request->get('search-type'))) {
            switch ($this->request->get('search-type')) {
                case 1:
                    $value = intval($this->request->get('search'));

                    if (!empty($value)) {
                        $query->where(['id' => $value]);
                    }
                    break;
                case 2:
                    $value = $this->request->get('search');

                    $query->where(['like','link',$value]);
                    break;
                case 3:
                    $value = $this->request->get('search');

                    $query->joinWith([
                        'users' => function($query) use ($value) {
                            $query->where(['like', 'CONCAT(users.first_name," ",users.last_name)', $value]);
                        },
                    ]);
                    break;
            }
        }
    }
}
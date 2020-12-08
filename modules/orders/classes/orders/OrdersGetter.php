<?php

namespace app\modules\orders\classes\orders;

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
     * @return array
     */
    public function getPaginationList()
    {
        $query = Orders::find();

        $query->with(['users','services']);

        $this->filter($query);

        $pagination = new Pagination([
            'defaultPageSize' => Yii::$app->getModule('orders')->params['pagination']['per_page'],
            'pageSizeLimit' => [1, 100],
            'totalCount' => $query->count(),
        ]);

        $query->offset($pagination->offset)
            ->limit($pagination->limit);

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
        if (!is_null($this->request->get('status_id'))) {
            $query->where(['status' => $this->request->get('status_id')]);
        }

        if (!is_null($this->request->get('mode')) && $this->request->get('mode') >= 0) {
            $query->where(['mode' => $this->request->get('mode')]);
        }

        if (!empty($this->request->get('service_id'))) {
            $query->where(['service_id' => $this->request->get('service_id')]);
        }
    }
}
<?php

namespace app\modules\orders\classes\orders;

use app\modules\orders\models\Orders;
use app\modules\orders\classes\statuses\StatusGetter;
use yii\helpers\VarDumper;
use yii\data\Pagination;
use Yii;

class OrderManager
{	
	public function getPagginationList($request)
	{
		$query = Orders::find();

		$pagination = new Pagination([
            'defaultPageSize' => Yii::$app->getModule('orders')->params['pagination']['per_page'],
            'totalCount' => $query->count(),
        ]);

		$this->filter($query, $request);

		$query->offset($pagination->offset)
        	->limit($pagination->limit);

        $orders = $query->all();

		return [
			'orders' => $orders,
			'pagination' => $pagination,
		];
	}

	protected function filter(&$query, $request)
	{	
		if (!empty($request->get('status'))) {
			$statusGetter = new StatusGetter;
			$query->where(['status' => $statusGetter->transformStatus2Key($request->get('status'))]);
		}
	}
}
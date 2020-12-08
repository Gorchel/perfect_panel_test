<?php

namespace app\modules\orders\controllers;

use app\modules\orders\classes\services\ServicesGetter;
use yii\web\Controller;
use app\modules\orders\classes\statuses\StatusGetter;
use yii\helpers\VarDumper;
use app\modules\orders\classes\orders\OrderManager;
use app\modules\orders\helpers\UrlHelper;
use Yii;

/**
 * Default controller for the `order_list` module
 */
class OrdersController extends Controller
{

    /**
     * @return string
     */
    public function actionIndex()
    {
    	$orderManager = new OrderManager(Yii::$app->request);
        $ordersPaginationArray = $orderManager->handle();

    	$statusGetter = new StatusGetter;

        //get service list
        $serviceGetter = new ServicesGetter($this->request);
        $servicesList = $serviceGetter->getOrdersServicesList();

        return $this->render('index', [
        	'statuses' => $statusGetter->getList(),
            'servicesList' => $servicesList,
            'ordersPaginationArray' => $ordersPaginationArray,
        ]);
    }
}

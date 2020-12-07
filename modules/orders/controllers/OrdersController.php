<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;
use app\modules\orders\classes\statuses\StatusGetter;
use yii\helpers\VarDumper;
use app\modules\orders\classes\orders\OrderManager;
use Yii;

/**
 * Default controller for the `order_list` module
 */
class OrdersController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {	
    	$orderManager = new OrderManager;

    	VarDumper::dump($orderManager->getPagginationList(Yii::$app->request));

    	$statusGetter = new StatusGetter;

    	// Yii::$app->request->get('status')

        return $this->render('index', [
        	'statuses' => $statusGetter->getList(),
        ]);
    }
}

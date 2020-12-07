<?php

namespace app\modules\orders\controllers;

use yii\web\Controller;

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
        return $this->render('index');
    }
}

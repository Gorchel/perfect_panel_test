<?php

namespace orders\controllers;

use orders\classes\orders\ExportCsv;
use orders\classes\services\ServicesGetter;
use yii\web\Controller;
use orders\classes\statuses\StatusGetter;
use orders\classes\orders\OrderManager;
use orders\classes\upload\UploadManager;
use orders\classes\lang\LanguageSwitcher;
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
        $langSwitcher = new LanguageSwitcher(Yii::$app->request->get('lang'));
        $langSwitcher->switching();

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

    /**
     * @return string
     */
    public function actionExport()
    {
        $exportCsv = new ExportCsv(Yii::$app->request);
        $response = $exportCsv->handle();

        if (empty($response)) {
            return $this->render('export/empty_link');
        }

        return $this->render('export/upload_links',[
            'links' => $response
        ]);
    }

    /**
     *
     */
    public function actionUpload()
    {
        $uploadManager = new UploadManager;
        $uploadManager->upload(Yii::$app->request->get('path'));
    }
}

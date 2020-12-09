<?php

namespace orders\controllers;

use orders\classes\getters\FilterGetter;
use orders\classes\getters\ModeGetter;
use orders\classes\orders\ExportCsv;
use orders\classes\services\ServicesManager;
use yii\helpers\VarDumper;
use yii\web\Controller;
use orders\classes\getters\StatusGetter;
use orders\classes\orders\OrderManager;
use orders\classes\upload\UploadManager;
use orders\classes\orders\FilterValidation;
use Yii;

/**
 * Default controller for the `order_list` module
 */
class OrdersController extends Controller
{
    /**
     * @return string
     * @throws \yii\base\ErrorException
     */
    public function actionIndex()
    {
        $filterValidation = new FilterValidation(Yii::$app->request);
        $filters = $filterValidation->validate();

    	$orderManager = new OrderManager($filters);
        $paginationList = $orderManager->handle();

        $serviceManager= new ServicesManager($filters);
        $servicesList = $serviceManager->getList();

        return $this->render('index', [
        	'statuses' => StatusGetter::STATUSES_LIST,
            'servicesList' => $servicesList,
            'paginationList' => $paginationList,
            'searchTypes' => FilterGetter::SEARCH_TYPES,
            'modes' => ModeGetter::MODES,
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

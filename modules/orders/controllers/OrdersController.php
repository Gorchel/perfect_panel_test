<?php

namespace orders\controllers;

use orders\classes\getters\FilterGetter;
use orders\classes\getters\ModeGetter;
use orders\classes\export\PrepareExport;
use orders\classes\services\ServicesManager;
use yii\web\Controller;
use orders\classes\getters\StatusGetter;
use orders\classes\orders\OrderManager;
use orders\classes\download\DownloadManager;
use orders\classes\orders\FilterValidation;
use Yii;
use ErrorException;
use yii\web\HttpException;

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
     * @throws \yii\base\ErrorException
     */
    public function actionExport()
    {
        $filterValidation = new FilterValidation(Yii::$app->request);
        $filters = $filterValidation->validate();

        $exportCsv = new PrepareExport($filters);
        $response = $exportCsv->handle();

        if (empty($response)) {
            return $this->render('export/empty_list');
        }

        return $this->render('export/download_links', [
            'links' => $response
        ]);
    }


    /**
     * Download stored file by links
     *
     * @throws \Exception
     */
    public function actionDownload()
    {
        try {
            $uploadManager = new DownloadManager();
            $uploadManager->download(Yii::$app->request->get('path'));
        } catch(ErrorException $e) {
            throw new HttpException(500);
        }
    }
}

<?php

namespace orders\controllers;

use ErrorException;
use orders\classes\download\DownloadManager;
use orders\classes\export\PrepareExport;
use orders\classes\getters\FilterGetter;
use orders\classes\getters\ModeGetter;
use orders\classes\getters\StatusGetter;
use orders\classes\orders\FilterValidation;
use orders\classes\orders\OrderManager;
use orders\classes\services\ServicesManager;
use Yii;
use yii\web\Controller;
use yii\web\HttpException;
use Exception;

/**
 * Default controller for the `order_list` module
 */
class OrdersController extends Controller
{
    /**
     * @return string
     * @throws yii\base\ErrorException
     */
    public function actionIndex()
    {
        $filterValidation = new FilterValidation(Yii::$app->request);
        $filters = $filterValidation->validate();

        $orderManager = new OrderManager($filters);
        $paginationList = $orderManager->handle();

        $serviceManager = new ServicesManager($filters);
        $servicesList = $serviceManager->getList();

        return $this->render(
            'index',
            [
                'statuses' => StatusGetter::getList(),
                'servicesList' => $servicesList,
                'paginationList' => $paginationList,
                'searchTypes' => FilterGetter::getSearchTypes(),
                'modes' => ModeGetter::getModes(),
            ]
        );
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

        return $this->render(
            'export/download_links',
            [
                'links' => $response
            ]
        );
    }

    /**
     * Download stored file by links
     *
     * @throws Exception
     */
    public function actionDownload()
    {
        try {
            $downloadManager = new DownloadManager();
            $downloadManager->download(Yii::$app->request->get('path'));
        } catch (Exception $e) {
            throw new HttpException(500);
        }
    }
}

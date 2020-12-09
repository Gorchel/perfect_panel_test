<?php

namespace orders\classes\export;

use orders\classes\export\types\Csv;
use orders\classes\getters\ExportGetter;
use orders\classes\orders\OrderQueryManager;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use \yii\web\Request;
use Yii;

/**
 * Class PrepareExport
 *
 * Prepare data for export
 *
 * @package orders\classes\export
 */
class PrepareExport
{
    /**
     * @var Request
     */
    protected $filters;
    /**
     * @var ExportManager
     */
    protected $exportManager;

    /**
     * @var string[]
     */
    protected $header;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;

        $exportGetter = new ExportGetter();
        $this->header = $exportGetter::HEADER;

        switch ($exportGetter->getExportFormat()) {
            case 'csv':
                $exportType = new Csv();
                break;
            default:
                $exportType = new Csv();
        }

        $this->exportManager = new ExportManager($exportType);
    }


    /**
     * Main method, make links and store export files
     *
     * @return array|false
     */
    public function handle()
    {
        $ordersQueryManager = new OrderQueryManager($this->filters);
        $query = $ordersQueryManager->getQuery();
        $count = $query->count();

        if (empty($count)) {
            return false;
        }

        $limit = $_ENV['EXPORT_PAGINATION_COUNT'];
        $links = [];

        foreach ($query->batch($limit) as $orders) {
            VarDumper::dump(count($orders));
//            $body = $this->makeExportBody($orders);
//
//            array_unshift($body, $this->header);
//
//            $filePath = $this->exportManager->make($body);
//
//            if (!empty($filePath)) {
//                $links[] = $filePath;
//            }
        }

        VarDumper::dump($links);

//        $pagination = new Pagination([
//            'defaultPageSize' => $limit,
//            'pageSizeLimit' => [1, $limit],
//            'totalCount' => $query->count(),
//        ]);

//        $links = [];
//
//        for ($i=1; $i<=$pagination->pageCount; $i++) {
//            $offset = intval($i * $limit);
//            $orders = $ordersQueryManager->getQuery()
//                ->offset($offset)
//                ->limit($limit)
//                ->all();
//
//            $body = $this->makeExportBody($orders);
//
//            array_unshift($body, $this->header);
//
//            $filePath = $this->exportManager->make($body);
//
//            if (!empty($filePath)) {
//                $links[] = $filePath;
//            }
//        }

        return $links;
    }

    /**
     * Generate array with data for export
     *
     * @param $orders
     * @return array
     */
    protected function makeExportBody($orders)
    {
        $raws = [];

        foreach ($orders as $order) {
            $raws[] = [
                $order->id,
                !empty($order->users) ? $order->users->first_name . ' ' . $order->users->last_name : '',
                $order->link,
                $order->quantity,
                !empty($order->services) ? $order->services->id . ': ' . $order->services->name : '',
                $order->quantity,
                $order->statusName,
                $order->modeName,
                $order->humanCreatedAt
            ];
        }

        return $raws;
    }
}
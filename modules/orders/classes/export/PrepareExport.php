<?php

namespace orders\classes\export;

use orders\classes\export\types\Csv;
use orders\classes\getters\ExportGetter;
use orders\classes\orders\OrderQueryManager;
use \yii\web\Request;

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
    protected ExportManager $exportManager;

    /**
     * @var string[]
     */
    protected $header;

    public function __construct(array $filters = [])
    {
        $this->filters = $filters;

        $this->header = ExportGetter::getHeader();

        switch (ExportGetter::getExportFormat()) {
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
            $body = $this->makeExportBody($orders);

            array_unshift($body, $this->header);

            $fileName = $this->exportManager->make($body);

            if (!empty($fileName)) {
                $links[] = $fileName;
            }
        }

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
                $order->userFullName,
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
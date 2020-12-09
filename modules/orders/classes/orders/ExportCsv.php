<?php

namespace app\modules\orders\classes\orders;

use app\modules\orders\classes\export\ExportManager;
use app\modules\orders\classes\export\types\Csv;
use app\modules\orders\classes\statuses\StatusGetter;
use yii\data\Pagination;
use yii\helpers\VarDumper;
use \yii\web\Request;
use Yii;

/**
 * Class ExportCsv
 * @package app\modules\orders\classes\orders
 */
class ExportCsv
{
    /**
     * @var Request
     */
    protected $request;
    protected $exportManager;

    /**
     * @var string[]
     */
    protected $header = [
        'ID', 'User', 'Link', 'Quantity','Service','Status','Mode','Created'
    ];

    /**
     * ExportCsv constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->exportManager = new ExportManager(new Csv());
    }

    /**
     * @return false
     */
    public function handle()
    {
        $orderGetter = new OrdersGetter(Yii::$app->request);
        $query = $orderGetter->getQuery();
        $count = $query->count();

        if (empty($count)) {
            return false;
        }

        $limit = $_ENV['EXPORT_PAGINATION_COUNT'];

        $pagination = new Pagination([
            'defaultPageSize' => $limit,
            'pageSizeLimit' => [1, $limit],
            'totalCount' => $query->count(),
        ]);

        $links = [];

        for ($i=1; $i<=$pagination->pageCount; $i++) {
            $offset = intval($i * $limit);
            $orders = $orderGetter->getQuery()
                ->offset($offset)
                ->limit($limit)
                ->all();

            $body = $this->makeExportBody($orders);

            array_unshift($body, $this->header);

            $filePath = $this->exportManager->make($body);

            if (!empty($filePath)) {
                $links[] = $filePath;
            }
        }

        return $links;
    }

    /**
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
<?php

namespace orders\classes\download;

use orders\classes\getters\ExportGetter;

/**
 * Class DownloadManager
 * @package orders\classes\download
 */
class DownloadManager
{
    /**
     * @var
     */
    protected $dir;

    /**
     * DownloadManager constructor.
     */
    public function __construct()
    {
        $exportGetter = new ExportGetter();
        $this->dir = $exportGetter->getExportDir();
    }

    /**
     * Download file by path
     *
     * @param string $fileName
     * @return \yii\console\Response|\yii\web\Response
     * @throws \Exception
     */
    public function download(string $fileName) {
        $filePath = $this->dir.'/'.$fileName;

        if (file_exists($filePath)) {
            return \Yii::$app->response->sendFile($filePath);
        }
        throw new \Exception('File not found', 500);
    }
}
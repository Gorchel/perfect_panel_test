<?php

namespace orders\classes\download;

/**
 * Class DownloadManager
 * @package orders\classes\download
 */
class DownloadManager
{
    /**
     * Download file by path
     *
     * @param string $path
     * @return \yii\console\Response|\yii\web\Response
     * @throws \Exception
     */
    public function download(string $path) {
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        }
        throw new \Exception('File not found');
    }
}
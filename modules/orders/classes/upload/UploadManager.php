<?php

namespace app\modules\orders\classes\upload;

/**
 * Class UploadManager
 * @package app\modules\orders\classes\upload
 */
class UploadManager
{
    public function upload(string $path) {
        if (file_exists($path)) {
            return \Yii::$app->response->sendFile($path);
        }
        throw new \Exception('File not found');
    }
}
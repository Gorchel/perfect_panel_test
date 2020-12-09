<?php

namespace app\modules\orders\classes\export\types;

use Yii;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;

/**
 * Class Csv
 * @package app\modules\orders\classes\export\types
 */
class Csv implements TypeInterface
{
    /**
     * @param array $create_data
     * @param null $file
     * @return string
     */
    public function store(array $create_data, ?string $file = null): string
    {
        if( !is_array($create_data) )
            return false;

        if($file && !is_dir(dirname($file))) {
            return false;
        }

        $csvStr = $this->convertingStr2Csv($create_data);

        file_put_contents($file, $csvStr);

        return $file;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return 'csv';
    }

    /**
     * @param array $create_data
     * @return false|string
     */
    protected function convertingStr2Csv(array $create_data)
    {
        $fh = fopen('php://temp', 'rw');

        # write out the data
        foreach ( $create_data as $row ) {
            fputcsv($fh, $row);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
    }
}

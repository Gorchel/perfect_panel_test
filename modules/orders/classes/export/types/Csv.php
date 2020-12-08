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
     * @var mixed
     */
    protected $colDelimiter;
    /**
     * @var mixed
     */
    protected $rowDelimiter;

    /**
     * Csv constructor.
     */
    public function __construct()
    {
        $this->colDelimiter = Yii::$app->getModule('orders')->params['export']['col_delimiter'];
        $this->rowDelimiter = Yii::$app->getModule('orders')->params['export']['row_delimiter'];
    }


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
//        // строка, которая будет записана в csv файл
//        $csvStr = '';
//
//        // перебираем все данные
//        foreach( $create_data as $row ){
//            $cols = array();
//
//            foreach( $row as $col_val ){
//                // строки должны быть в кавычках ""
//                // кавычки " внутри строк нужно предварить такой же кавычкой "
//                if( $col_val && preg_match('/[",;\r\n]/', $col_val) ){
//                    // поправим перенос строки
//                    if( $this->rowDelimiter === "\r\n" ){
//                        $col_val = str_replace( "\r\n", '\n', $col_val );
//                        $col_val = str_replace( "\r", '', $col_val );
//                    }
//                    elseif( $this->rowDelimiter === "\n" ){
//                        $col_val = str_replace( "\n", '\r', $col_val );
//                        $col_val = str_replace( "\r\r", '\r', $col_val );
//                    }
//
//                    $col_val = str_replace( '"', '""', $col_val ); // предваряем "
//                    $col_val = '"'. $col_val .'"'; // обрамляем в "
//                }
//
//                $cols[] = $col_val; // добавляем колонку в данные
//            }
//
//            VarDumper::dump(implode( $this->colDelimiter, $cols ));
//
//            $csvStr .= implode( $this->colDelimiter, $cols ) . $this->rowDelimiter; // добавляем строку в данные
//        }
//
//        $csvStr = rtrim( $csvStr, $this->rowDelimiter );
//
//        return $csvStr;
        $fh = fopen('php://temp', 'rw'); # don't create a file, attempt

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

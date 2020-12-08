<?php

namespace app\modules\orders\classes\export;

use Yii;
use app\modules\orders\classes\export\types\TypeInterface;

/**
 * Class ExportManager
 * @package app\modules\orders\classes\export
 */
class ExportManager
{
    /**
     * @var TypeInterface
     */
    protected $typeClient;

    /**
     * ExportManager constructor.
     * @param TypeInterface $typeClient
     */
    public function __construct(TypeInterface $typeClient)
    {
        $this->typeClient = $typeClient;
    }

    /**
     * @param array $createData
     * @return string
     */
    public function make(array $createData)
    {
        $file = $this->makeFile();

        return $this->typeClient->store($createData, $file);
    }

    /**
     * @return string
     */
    protected function makeFile()
    {
        $dir = 'uploads/';

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $file = $dir.$this->randomFileName();

        return $file;
    }

    /**
     * @param false $extension
     * @return string
     */
    private function randomFileName($extension = false)
    {
        return $name = md5(microtime() . rand(0, 1000)).'.'.$this->typeClient->getExtension();
    }
}
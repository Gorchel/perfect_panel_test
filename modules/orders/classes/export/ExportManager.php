<?php

namespace orders\classes\export;

use orders\classes\export\types\TypeInterface;
use orders\classes\getters\ExportGetter;

/**
 * Class ExportManager
 * @package orders\classes\export
 */
class ExportManager
{
    /**
     * @var TypeInterface
     */
    protected $typeClient;

    /**
     * @var
     */
    protected $dir;

    /**
     * ExportManager constructor.
     * @param TypeInterface $typeClient
     */
    public function __construct(TypeInterface $typeClient)
    {
        $exportGetter = new ExportGetter();
        $this->dir = $exportGetter->getExportDir();

        if (!file_exists($this->dir)) {
            mkdir($this->dir, 0777, true);
        }

        $this->typeClient = $typeClient;
    }

    /**
     * Store export file
     *
     * @param array $createData
     * @return string
     */
    public function make(array $createData)
    {
        $fileName = $this->randomFileName();

        $file = $this->dir.'/'.$fileName;

        $exportString = $this->typeClient->convert($createData);

        file_put_contents($file, $exportString);

        return $fileName;
    }

    /**
     * Make random file name
     *
     * @return string
     */
    private function randomFileName()
    {
        return md5(microtime() . rand(0, 1000)).'.'.$this->typeClient->getExtension();
    }
}
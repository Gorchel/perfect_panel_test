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
     * ExportManager constructor.
     * @param TypeInterface $typeClient
     */
    public function __construct(TypeInterface $typeClient)
    {
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
        $file = $this->makeFile();

        if($file && !is_dir(dirname($file))) {
            return false;
        }

        $exportString = $this->typeClient->convert($createData);

        file_put_contents($file, $exportString);

        return $file;
    }

    /**
     * Create dir for files
     *
     * @return string
     */
    protected function makeFile()
    {
        $exportGetter = new ExportGetter();
        $dir = $exportGetter->getExportDir();

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $file = $dir.'/'.$this->randomFileName();

        return $file;
    }

    /**
     * Make random file name
     *
     * @param false $extension
     * @return string
     */
    private function randomFileName($extension = false)
    {
        return $name = md5(microtime() . rand(0, 1000)).'.'.$this->typeClient->getExtension();
    }
}
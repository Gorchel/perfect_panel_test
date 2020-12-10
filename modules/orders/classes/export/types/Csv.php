<?php

namespace orders\classes\export\types;

/**
 * Class Csv
 * @package orders\classes\export\types
 */
class Csv implements TypeInterface
{

    /**
     * Method store string convert array to csv and store
     *
     * @param array $createData
     * @return string
     */
    public function convert(array $createData): string
    {
        if (!is_array($createData)) {
            return false;
        }

        return $this->convertingStr2Csv($createData);
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return 'csv';
    }

    /**
     * @param array $createData
     * @return false|string
     */
    protected function convertingStr2Csv(array $createData)
    {
        $fh = fopen('php://temp', 'rw');

        # write out the data
        foreach ($createData as $row) {
            fputcsv($fh, $row);
        }
        rewind($fh);
        $csv = stream_get_contents($fh);
        fclose($fh);

        return $csv;
    }
}

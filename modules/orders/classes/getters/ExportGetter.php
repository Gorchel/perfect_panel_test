<?php

namespace orders\classes\getters;

/**
 * Class ExportGetter
 * @package orders\classes\getters
 */
class ExportGetter
{
    /**
     *
     */
    public const HEADER = [
        'ID', 'User', 'Link', 'Quantity','Service','Status','Mode','Created'
    ];

    /**
     * @return mixed
     */
    public function getExportFormat()
    {
        return $_ENV['EXPORT_FORMAT'];
    }

    /**
     * @return mixed
     */
    public function getExportDir()
    {
        return $_ENV['EXPORT_DIR'];
    }
}
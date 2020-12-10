<?php

namespace orders\classes\getters;

/**
 * Class ExportGetter
 * @package orders\classes\getters
 */
class ExportGetter
{
    /**
     * @var array|string[]
     */
    protected static array $header = [
        'ID',
        'User',
        'Link',
        'Quantity',
        'Service',
        'Status',
        'Mode',
        'Created'
    ];

    /**
     * @return array|string[]
     */
    public static function getHeader()
    {
        return self::$header;
    }

    /**
     * @return mixed
     */
    public static function getExportFormat()
    {
        return $_ENV['EXPORT_FORMAT'];
    }


    /**
     * @return mixed
     */
    public static function getExportDir()
    {
        return $_ENV['EXPORT_DIR'];
    }
}
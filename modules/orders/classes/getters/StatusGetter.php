<?php

namespace orders\classes\getters;

/**
 * Class StatusGetter
 * @package orders\classes\getters
 */
class StatusGetter
{
    /**
     * @var string[][]
     */
    private static array $statusList = [
        0 => ['slug' => 'pending', 'name' => 'Pending'],
        1 => ['slug' => 'in_progress', 'name' => 'In progress'],
        2 => ['slug' => 'completed', 'name' => 'Completed'],
        3 => ['slug' => 'canceled', 'name' => 'Canceled'],
        4 => ['slug' => 'error', 'name' => 'Error'],
    ];

    /**
     * @return string[][]
     */
    public static function getList()
    {
        return self::$statusList;
    }

    /**
     * Return value by status id and key
     *
     * @param int $statusId
     * @param string $key
     * @return string|null
     */
    public static function getValue(int $statusId, string $key = 'name')
    {
        $list = self::getList();
        return isset($list[$statusId][$key]) ? $list[$statusId][$key] : null;
    }

    /**
     * Return values bu key
     *
     * @param string $key
     * @return array
     */
    public static function getListByKey(string $key = 'name')
    {
        $list = [];

        foreach (self::getList() as $statusArr) {
            $list[] = $statusArr[$key];
        }

        return $list;
    }

    /**
     * Return status key by keyName
     *
     * @param string $status
     * @param string $keyName
     * @return int|string|null
     */
    public static function getKeyByKeyName(string $status, string $keyName = 'name')
    {
        foreach (self::getList() as $key => $statusArr) {
            if ($statusArr[$keyName] === $status) {
                return $key;
            }
        }

        return null;
    }
}
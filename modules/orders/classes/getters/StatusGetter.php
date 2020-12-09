<?php

namespace orders\classes\getters;

/**
 * Class StatusGetter
 * @package orders\classes\getters
 */
class StatusGetter
{
    public const STATUSES_LIST = [
        0 => 'Pending',
        1 => 'In progress',
        2 => 'Completed',
        3 => 'Canceled',
        4 => 'Error',
    ];

    /**
     * Return all statuses in lower case
     *
     * @return string[]
     */
    public function getLowerList()
    {
        $statuses = [];

        foreach (self::STATUSES_LIST as $status) {
            $statuses[] = strtolower(str_replace(' ','_',$status));
        }

        return $statuses;
    }

    /**
     * Return status key by string value
     *
     * @param $status
     * @return mixed
     */
    public function transformStatus2Key($status)
	{	
		$firstCapitalLetterStatus = ucfirst(str_replace('_',' ',$status));
		return array_flip(self::STATUSES_LIST)[$firstCapitalLetterStatus];
	}
}
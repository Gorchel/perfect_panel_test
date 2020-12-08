<?php

namespace app\modules\orders\classes\statuses;

/**
 * Class StatusGetter
 * @package app\modules\orders\classes\statuses
 */
class StatusGetter
{
    /**
     * @var string[]
     */
    protected $list = [
		0 => 'Pending',
		1 => 'In progress',
		2 => 'Completed',
		3 => 'Canceled',
		4 => 'Error',
	];

    /**
     * @return string[]
     */
    public function getList()
	{
		return $this->list;
	}

    /**
     * @param $status
     * @return mixed
     */
    public function transformStatus2Key($status)
	{	
		$firstCapitalLetterStatus = ucfirst(str_replace('_',' ',$status));
		return array_flip($this->getList())[$firstCapitalLetterStatus];
	}
}
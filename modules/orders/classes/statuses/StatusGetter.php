<?php

namespace app\modules\orders\classes\statuses;

class StatusGetter
{	
	protected $list = [
		0 => 'Pending',
		1 => 'In progress',
		2 => 'Completed',
		3 => 'Canceled',
		4 => 'Error',
	];

	public function getList()
	{
		return $this->list;
	}

	public function transformStatus2Key($status)
	{	
		$firstCapitalLetterStatus = ucfirst($status);
		return array_flip($this->getList())[$firstCapitalLetterStatus];
	}
}
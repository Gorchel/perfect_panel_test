<?php

namespace orders\classes\orders;

use orders\classes\getters\FilterGetter;
use orders\classes\getters\StatusGetter;
use orders\classes\getters\ModeGetter;
use \yii\web\Request;
use \yii\base\ErrorException;

/**
 * Class FilterValidation
 *
 * Validate income in module data
 *
 * @package orders\classes\orders
 */
class FilterValidation
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * FilterValidation constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return array
     * @throws ErrorException
     */
    public function validate()
    {
        $filters = [];

        if (!empty($this->request->get('status'))) {
            $statusGetter = new StatusGetter();
            if (!in_array($this->request->get('status'), $statusGetter->getLowerList())) {
                throw new ErrorException("Status ".$this->request->get('status').' is no found');
            }

            $filters['status'] = $this->request->get('status');
            $filters['status_id'] = $statusGetter->transformStatus2Key($filters['status']);
        }

        if (!empty($this->request->get('mode'))) {
            if (
                !is_int($this->request->get('mode')) &&
                !in_array($this->request->get('mode'), array_keys(ModeGetter::MODES))
            ) {
                throw new ErrorException("Wrong type of mode params");
            }

            $filters['mode'] = $this->request->get('mode');
        }

        if (!empty($this->request->get('service_id'))) {
            if (!is_int($this->request->get('service_id'))) {
                throw new ErrorException("Wrong type of service_id params");
            }

            $filters['service_id'] = $this->request->get('service_id');
        }

        if (!empty($this->request->get('search'))) {
            if (
                !is_int($this->request->get('search-type')) &&
                !in_array($this->request->get('search-type'), array_keys(FilterGetter::SEARCH_TYPES))
            ) {
                throw new ErrorException("Wrong type of search-type params");
            }

            $filters['search'] = $this->request->get('search');
            $filters['search-type'] = $this->request->get('search-type');
        }

        return $filters;
    }
}
<?php

namespace orders\classes\orders;

use orders\classes\getters\FilterGetter;
use orders\classes\getters\StatusGetter;
use orders\classes\getters\ModeGetter;
use yii\helpers\VarDumper;
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
    protected Request $request;

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
            if (!in_array($this->request->get('status'), StatusGetter::getListByKey('slug'))) {
                throw new ErrorException("Status " . $this->request->get('status') . ' is no found');
            }

            $filters['status'] = $this->request->get('status');
            $filters['status_id'] = StatusGetter::getKeyByKeyName($filters['status'], 'slug');
        }

        if (!empty($this->request->get('mode'))) {
            $mode = intval($this->request->get('mode'));

            if (!in_array($mode, array_keys(ModeGetter::getModes()))) {
                throw new ErrorException("Wrong type of mode params");
            }

            $filters['mode'] = $mode;
        }

        if (!empty($this->request->get('service_id'))) {
            if (empty(intval($this->request->get('service_id')))) {
                throw new ErrorException("Wrong type of service_id params");
            }

            $filters['service_id'] = $this->request->get('service_id');
        }

        if (!empty($this->request->get('search'))) {
            if (
                !is_int($this->request->get('search-type')) &&
                !in_array($this->request->get('search-type'), array_keys(FilterGetter::getSearchTypes()))
            ) {
                throw new ErrorException("Wrong type of search-type params");
            }

            $filters['search'] = $this->request->get('search');
            $filters['search-type'] = $this->request->get('search-type');
        }

        return $filters;
    }
}
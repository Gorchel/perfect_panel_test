<?php

namespace orders\classes\orders;

use orders\classes\getters\FilterGetter;
use orders\classes\getters\StatusGetter;
use yii\base\DynamicModel;
use yii\base\ErrorException;
use yii\web\Request;

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
     * Prepare data from request
     *
     * @return array
     */
    protected function prepareFilters()
    {
        $filters = [];

        foreach (FilterGetter::filterFields() as $field) {
            $filters[$field] = $this->request->get($field);
        }

        $filters['status_id'] = !empty($filters['status']) ? StatusGetter::getKeyByKeyName($filters['status'], 'slug') : null;

        return $filters;
    }

    /**
     * @return DynamicModel
     * @throws ErrorException
     */
    public function validate()
    {
        $filters = $this->prepareFilters();

        $filterModel = new DynamicModel($filters);

        foreach (FilterGetter::getRules() as $rule ) {
            $this->addRule($filterModel, $rule);
        }

        foreach (FilterGetter::getSearchingRules() as $key => $rule) {
            if (!empty($filters[$key])) {
                $this->addRule($filterModel, $rule);
            }
        }

        $filterModel->validate();

        if ($filterModel->hasErrors()) {
            throw new ErrorException($filterModel->getErrors(), 500);
        }

        return $filterModel;
    }

    /**
     * @param DynamicModel $filterModel
     * @param array $rule
     */
    private function addRule(DynamicModel &$filterModel, array $rule)
    {
        $filterModel->addRule($rule[0], $rule[1], isset($rule[2]) ? $rule[2] : []);
    }
}
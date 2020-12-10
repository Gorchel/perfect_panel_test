<?php

namespace orders\classes\export\types;

/**
 * Interface TypeInterface
 * @package orders\classes\export\types
 */
interface TypeInterface
{

    /**
     * @param array $data
     * @return string
     */
    public function convert(array $data): string;

    /**
     * @return mixed
     */
    public function getExtension();
}
<?php

namespace orders\classes\export\types;

use Yii;

interface TypeInterface
{
    public function store(array $data, ?string $file = null): string;
    public function getExtension();
}
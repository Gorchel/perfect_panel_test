<?php

namespace orders\classes\getters;

/**
 * Class ModeGetter
 * @package orders\classes\getters
 */
class ModeGetter
{
    public const MODES = [
        -1 => ['slug' => 'all', 'key' => 'All'],
        0 => ['slug' => 'manual', 'key' => 'Manual'],
        1 => ['slug' => 'auto', 'key' => 'Auto'],
    ];
}
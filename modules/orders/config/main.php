<?php

return [
    'params' => [
        'pagination' => [
            'per_page' => 100,
        ],
        'export' => [
            'batch_count' => 100,
            'pagination_count' => 5000,
            'col_delimiter' => ';',
            'row_delimiter' => "\r\n",
        ],
    ],
    'defaultRoute' => 'orders',
];
<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => $_ENV['DB_CONNECTION'].':host='.$_ENV['DB_HOST'].';dbname='.$_ENV['DB_DATABASE'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];

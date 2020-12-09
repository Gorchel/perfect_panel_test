<h1>Модуль вывода заявок</h1>

Модуль выводит таблицу заявок с возможностью фильтрациии экспорта выбранных заявок в csv.

### 1. Установка

1.1 Запуск docker файла 
 
    docker-compose up -d
    
1.2 Зависимости

    composer require vlucas/phpdotenv
    composer require nesbot/carbon
    
1.3 Необходимо развернуть .env файл в главной директории модуля. Пример .env-default

1.4 В _config/web_ добавить routes, module, i18n
```
    'aliases' => [
        ...
        '@orders' => '@app/modules/orders',
    ],
    ...
    'components' => [
        'urlManager' => [
            ...
            'rules' => [
                ...
                'GET orders/<status>' => 'orders',
                'GET orders/export/make_links' => 'orders/orders/export',
                'GET orders/export/upload' => 'orders/orders/upload',
            ]
        ],
        i18n' => [
            'translations' => [
                ...
                'orders*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@orders/messages',
                ],
            ]
        ]
    ]
```

```
    'modules' => [
        ...
        'orders' => [
            'class' => 'orders\Module',
        ],
    ],
```

1.5 В _web/index.php_ добавить
```
    ...
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__.'/../');
    $dotenv->load();
    ...
    $config = require __DIR__ . '/../config/web.php';
    
    (new yii\web\Application($config))->run();
```

### 2. Структура модуля
      orders/assets/      стили и скрипты модуля
      classes/            основной функционал работы с модулем
      config/             конфиг модуля
      controllers/        директория с контроллером модуля
      helpers/            вспомогательный helper
      models/             основные ActiveRecord модели
      views/              представления, используемые в модуле
      Module.php          Основной файл с конфигурации


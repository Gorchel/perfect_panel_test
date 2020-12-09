<h1>Модуль вывода заявок</h1>

Модуль выводит таблицу заявок с возможностью фильтрациии экспорта выбранных заявок в csv.

### 1. Установка

Запуск docker файла 
 
    docker-compose up -d
    
    
В _config/web_ добавить routes

    'GET orders/<status>' => 'orders',
    'GET orders/export/make_links' => 'orders/orders/export',
    'GET orders/export/upload' => 'orders/orders/upload',
    
### 2. Структура модуля
      orders/assets/      стили и скрипты модуля
      classes/            основной функционал работы с модулем
      config/             конфиг модуля
      controllers/        директория с контроллером модуля
      helpers/            вспомогательный helper
      models/             основные ActiveRecord модели
      views/              представления, используемые в модуле
      Module.php          Основной файл с конфигурации


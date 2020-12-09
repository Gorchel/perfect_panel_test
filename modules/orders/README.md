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

### 3. Основные классы заявок
####3.1 _app\modules\orders\classes\orders\OrderManager_
Класс формирует данные по заявкам с использованием паггинации   

####3.2 _app\modules\orders\classes\orders\OrdersGetter_
Вспомогательный класс, который фильтрует и формирует список заявок из базы данных 
    
####3.3 _app\modules\orders\classes\orders\ExportCsv_
Подготавливает данные по заявкам для выгрузки

### 4. Основные классы для выгрузки
####4.1 _app\modules\orders\classes\export\ExportManager_
Менеджер, формирующий выгрузку в выбранный формат   

####4.2 _app\modules\orders\classes\orders\types\_
Интерфейc и классы для выгрузки в необходимый формат 
<?php
/* @var $this \yii\web\View */
/* @var $content string */

use app\modules\orders\assets\OrderAsset;
use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;

AppAsset::register($this);
OrderAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>

    <?php
        NavBar::begin([
            'brandLabel' => Yii::$app->name,
            'brandUrl' => Url::to('/orders'),
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Orders', 'url' => ['/orders']],
            ]
        ]);
        NavBar::end();
    ?>

    <div class="wrap">
        <div class="container">
            <?= $content ?>
        </div>
    </div>

    <footer class="footer"></footer>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

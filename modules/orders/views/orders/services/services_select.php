<?php
    use orders\helpers\UrlHelper;

    $requestServices = Yii::$app->request->get('service_id');
    $sumServicesList = array_sum(array_column($servicesList, 'count'));
?>

<div class="dropdown">
    <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        <?php echo \Yii::t('orders', 'Service') ?>
        <span class="caret"></span>
    </button>

    <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
        <li class="<?php echo empty($requestServices) ? 'active' : '' ?>"><a href="<?php echo UrlHelper::getPathWithParams(['service_id' => 0]) ?>">All (<?php echo $sumServicesList ?>")</a></li>
        <?php
            foreach ($servicesList as $service) {
                $li = "<li class='".($requestServices == $service['id'] ? 'active' : '')."'>";
                $li .= "<a href='".UrlHelper::getPathWithParams(['service_id' => $service['id']])."'>";
                $li .= "<span class='label-id'>".$service['count']."</span>".$service['name']."</a></li>";
                $li .= "</span></a></li>";

                echo $li;
            }
        ?>
    </ul>

</div>
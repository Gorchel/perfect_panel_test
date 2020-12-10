<?php
    $requestStatus = Yii::$app->request->get('status');
?>
<ul class="nav nav-tabs p-b">
    <li class="<?php
    echo empty($requestStatus) ? 'active' : '' ?>"><a href="/orders"><?php
            echo Yii::t('orders', 'orders.status.all') ?></a></li>
    <?php
    foreach ($statuses as $status) {
        $li = "<li class='" . ($requestStatus == $status['slug'] ? 'active' : '') . "'><a href='/orders/" . $status['slug'] . "'>";
        $li .= Yii::t('orders', 'orders.status.' . $status['slug']);
        $li .= "</a></li>";
        echo $li;
    }
    ?>
</ul>

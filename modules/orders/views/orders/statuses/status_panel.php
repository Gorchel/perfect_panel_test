<?php
    $requestStatus = Yii::$app->request->get('status');
?>
<ul class="nav nav-tabs p-b">
    <li class="<?php echo empty($requestStatus) ? 'active' : '' ?>"><a href="/orders"><?php echo \Yii::t('orders', 'orders.status.all') ?></a></li>
    <?php
          foreach ($statuses as $status) {
              $urlStatus = strtolower(str_replace(' ','_',$status));

              $li = "<li class='".($requestStatus == $urlStatus ? 'active' : '')."'><a href='/orders/".$urlStatus."'>";
              $li .= Yii::t('orders', 'orders.status.'.$urlStatus);
              $li .= "</a></li>";
              echo $li;
          }
    ?>
</ul>

 <?php
 	use yii\widgets\Menu;

    $requestStatus = Yii::$app->request->get('status');
?>
<ul class="nav nav-tabs p-b">
    <li class="<?php echo empty($requestStatus) ? 'active' : '' ?>"><a href="/orders"><?php echo \Yii::t('common', 'All orders') ?></a></li>
    <?php
          foreach ($statuses as $status) {
              $urlStatus = strtolower(str_replace(' ','_',$status));
              echo "<li class='".($requestStatus == $urlStatus ? 'active' : '')."'><a href='/orders/".$urlStatus."'>".Yii::t('common', $status)."</a></li>";
          }
    ?>
</ul>

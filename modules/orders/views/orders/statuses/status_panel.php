 <?php
 	use yii\widgets\Menu;

 	$menuStatuses = array_map(function($status) {
            return ['label' => $status, 'url' => ['/orders/orders/index/'.strtolower(str_replace(' ','_',$status))]];
        }, $statuses);

 	array_unshift($menuStatuses, ['label' => 'All orders', 'url' => ['/orders/orders/index']]);

    echo Menu::widget([
        'activateItems' => true,
        'activeCssClass' => 'active',
        'options' => ['class' => 'nav nav-tabs p-b'],
        'items' => $menuStatuses,
    ]);
   
?>
 <?php
 	use yii\widgets\Menu;

    echo Menu::widget([
        'options' => ['class' => 'nav nav-tabs p-b'],
        'items' => array_map(function( $status) {
            return ['label' => $status, 'url' => ['/orders/orders/index/'.strtolower(str_replace(' ','_',$status))]];
        }, $statuses),
    ]);
   
?>
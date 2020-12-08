<?php
    use yii\widgets\Menu;
    use app\modules\orders\helpers\UrlHelper;
?>

<div class="dropdown">
    <button class="btn btn-th btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
        Service
        <span class="caret"></span>
    </button>

    <?php
        $services = array_map(function($service) {
            return [
                'label' => $service['name'],
                'template' => '<a href="{url}" data-nav-section="about"><span class="label-id">'.$service['count'].'</span>&nbsp{label}</a>',
                'url' => [UrlHelper::getPathWithParams(['service_id' => $service['id']])]
            ];
        }, $servicesList);

        array_unshift($services, [
                'label' => 'All ('.array_sum(array_column($servicesList, 'count')).')',
                'url' => [UrlHelper::getPathWithParams(['service_id' => '0'])]
        ]);

        echo Menu::widget([
            'options' => ['class' => 'dropdown-menu', 'aria-labelledby' => "dropdownMenu1"],
            'items' => $services,
        ]);
    ?>
</div>
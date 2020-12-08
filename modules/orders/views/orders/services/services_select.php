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
            return ['label' => $service['count'].' '.$service['name'], 'url' => [UrlHelper::getPathWithParams(['service_id' => $service['id']])]];
        }, $servicesList);

        array_unshift($services, ['label' => 'All', 'url' => [UrlHelper::getPathWithParams(['service_id' => '0'])]]);

        echo Menu::widget([
            'options' => ['class' => 'dropdown-menu', 'aria-labelledby' => "dropdownMenu1"],
            'items' => $services,
        ]);
    ?>

<!--    <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">-->
<!--        <li class="active"><a href="--><!--">All (--><!--)</a></li>-->
<!---->
<!--        -->
<!--        <li><a href=""><span class="label-id">214</span>  Real Views</a></li>-->
<!--        <li><a href=""><span class="label-id">215</span> Page Likes</a></li>-->
<!--        <li><a href=""><span class="label-id">10</span> Page Likes</a></li>-->
<!--        <li><a href=""><span class="label-id">217</span> Page Likes</a></li>-->
<!--        <li><a href=""><span class="label-id">221</span> Followers</a></li>-->
<!--        <li><a href=""><span class="label-id">224</span> Groups Join</a></li>-->
<!--        <li><a href=""><span class="label-id">230</span> Website Likes</a></li>-->
<!--    </ul>-->
</div>
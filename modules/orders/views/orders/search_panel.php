<?php
    use orders\helpers\UrlHelper;
    use Yii;
?>

<form class="form-inline text-right" action="<?php echo UrlHelper::getPath() ?>" method="get">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="<?php echo Yii::$app->request->get('search') ?>" placeholder="<?php echo Yii::t('orders', 'Search orders') ?>" required="required">
        <span class="input-group-btn search-select-wrap">

        <select class="form-control search-select" name="search-type">
            <?php
                $searchingTypedValues = [
                    1 => Yii::t('orders', 'Order ID'),
                    2 => Yii::t('orders', 'Link'),
                    3 => Yii::t('orders', 'Username'),
                ];

                foreach ($searchingTypedValues as $key => $value) {
                    echo "<option value=".$key." ".(Yii::$app->request->get('search-type') == $key ? 'selected="selected"' : '' ).">".$value."</option>";
                }
            ?>
        </select>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </span>
    </div>
</form>
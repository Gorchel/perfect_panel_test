<?php
    use app\modules\orders\helpers\UrlHelper;
?>

<form class="form-inline text-right" action="<?php echo UrlHelper::getPath() ?>" method="get">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="<?php echo Yii::$app->request->get('search') ?>" placeholder="<?php echo \Yii::t('common', 'Search orders') ?>" required="required">
        <span class="input-group-btn search-select-wrap">

        <select class="form-control search-select" name="search-type">
            <?php
                $searchingTypedValues = [
                    1 => \Yii::t('common', 'Order ID'),
                    2 => \Yii::t('common', 'Link'),
                    3 => \Yii::t('common', 'Username'),
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
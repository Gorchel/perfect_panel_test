<?php

use orders\helpers\UrlHelper;

?>

<form class="form-inline text-right" action="<?php
echo UrlHelper::getPath() ?>" method="get">
    <div class="input-group">
        <input type="text" name="search" class="form-control" value="<?php
        echo Yii::$app->request->get('search') ?>" placeholder="<?php
        echo Yii::t('orders', 'orders.search') ?>" required="required">
        <span class="input-group-btn search-select-wrap">

        <select class="form-control search-select" name="search-type">
            <?php
            foreach ($searchTypes as $key => $searching) {
                $li = "<option value=" . $key . " " . (Yii::$app->request->get(
                        'search-type'
                    ) == $key ? 'selected="selected"' : '') . ">";
                $li .= Yii::t('orders', 'orders.searching_type.' . $searching['key']);
                $li .= "</option>";

                echo $li;
            }
            ?>
        </select>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"
                                                            aria-hidden="true"></span></button>
        </span>
    </div>
</form>
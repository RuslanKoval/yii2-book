<?php

/* @var $this \yii\web\View*/
use yii\helpers\Html;
?>

<form class="" action="<?= \yii\helpers\Url::to(['book/search'])?>">
    <div class="form-group">
        <input type="text" name="s" class="form-control" placeholder="Введите запрос и нажмите enter" value="<?= \Yii::$app->request->get('s') ?>">
    </div>
    <input type="submit" hidden="true" />
</form>

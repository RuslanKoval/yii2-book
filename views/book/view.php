<?php
use yii\helpers\Html;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Exchange point', 'url' => ['exchange/index']];
$this->params['breadcrumbs'][] = $this->title;

/* @var $model \app\models\Book */
?>
<div class="row mb-20">
    <div class="col-md-2">
        <?= \yii\helpers\Html::img($model->getPreviewUrl(), ['class' => 'img-responsive'])?>
    </div>
    <div class="col-md-10">
        <ul class="list-group">
            <li class="list-group-item">Title:<?= $this->title ?></li>
            <li class="list-group-item">Author: <?= $model->author?></li>
            <li class="list-group-item">Date: <?=Date('d.m.y', $model->created_at)?></li>
            <li class="list-group-item">Status: <?= $model->getStatus()?></li>
        </ul>
    </div>
</div>
<div class="row mb-20">
    <div class="col-md-12">
        <?php if ($model->checkBook()) {?>
            <?= Html::a('I took this book', ['book/change', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php } else {?>
            <?php if (\Yii::$app->user->can('ownerBook', ['post' => $model])) {?>
                <?= Html::a('I return the book', ['book/change', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php }?>
        <?php }?>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <p>
            <?= $model->description ?>
        </p>
    </div>
</div>



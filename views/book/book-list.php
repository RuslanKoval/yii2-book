<?php
use yii\helpers\StringHelper;
use \yii\helpers\Url;


/* @var $model \app\models\Book */
?>

<div class="list-group-item">
    <a href="<?= Url::to(['book/view', 'id' => $model->id ])?>" class="mb-20">
        <?= \yii\helpers\Html::img($model->getPreviewUrl(), ['class' => 'img-responsive w-100'])?>
    </a>

    <h4>
        <?= $model->name ?>
    </h4>


    <?= Yii::$app->formatter->asNtext(StringHelper::truncateWords($model->description, 20)) ?>
</div>


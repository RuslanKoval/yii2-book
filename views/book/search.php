<?php
use yii\widgets\ListView;

$this->title = 'Search - "'.$s.'"';
$this->params['breadcrumbs'][] = ['label' => 'Exchange point', 'url' => ['exchange/index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= \app\widgets\SearchBook\Widget::widget()?>
<h1><?= $this->title ?></h1>


<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'col-md-3 book-item', 'tag' => 'div'],
    'options' => [
        'tag' => 'div',
        'class' => 'list-group',
    ],
    'summary' => false,
    'itemView' => function ($model) {
        return $this->render('book-list', [
            'model' => $model,
        ]);
    }
]) ?>


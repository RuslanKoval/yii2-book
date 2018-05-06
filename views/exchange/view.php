<?php
use yii\widgets\ListView;

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Exchange point', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<?= \app\widgets\SearchBook\Widget::widget()?>

<h1>Книги "<?= $this->title ?>"</h1>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'col-md-3', 'tag' => 'div'],
    'options' => [
        'tag' => 'div',
        'class' => 'list-group',
    ],
    'summary' => false,
    'itemView' => function ($model) {
        return $this->render('../book/book-list', [
            'model' => $model,
        ]);
    }
]) ?>


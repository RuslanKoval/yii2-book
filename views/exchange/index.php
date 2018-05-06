<?php
use yii\widgets\ListView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model \app\models\ExchangePoint */

$this->title = 'Exchange point';
$this->params['breadcrumbs'][] = $this->title;
?>
<?= \app\widgets\SearchBook\Widget::widget()?>

<?= ListView::widget([
    'dataProvider' => $dataProvider,
    'itemOptions' => ['class' => 'list-group-item', 'tag' => 'li'],
    'options' => [
        'tag' => 'ul',
        'class' => 'list-group list-group-flush',
    ],
    'summary' => false,
    'itemView' => function ($model) {
        $countBook = Html::tag('sup', count($model->books));
        return Html::a($model->name.$countBook, ['exchange/view', 'id' => $model->id], ['class' => 'block']);
    }
]) ?>

<?php

namespace app\widgets\SearchBook;


use backend\models\Articles;
use backend\models\Category;
use backend\models\News;
use common\helpers\Helpers;
use common\models\Complaints;
use common\models\Reviews;
use yii\db\Query;
use yii\helpers\ArrayHelper;

class Widget extends \yii\base\Widget
{
    public $options = [];

    public function run()
    {
        return $this->render('widget');
    }

}
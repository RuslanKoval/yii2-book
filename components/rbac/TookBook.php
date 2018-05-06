<?php
namespace app\components\rbac;


use Yii;
use yii\rbac\Rule;

class TookBook extends Rule
{
    public $name = 'TookBookRule';

    public function execute($user, $item, $params)
    {

        if( $params['post']->user_id == null && Yii::$app->user->identity->book == null){
            return true;
        }
        return false;
    }
}
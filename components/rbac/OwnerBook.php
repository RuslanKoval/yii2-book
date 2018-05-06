<?php

namespace app\components\rbac;


use Yii;
use yii\rbac\Rule;

class OwnerBook extends Rule
{
    public $name = 'OwnerBookRule';

    public function execute($user, $item, $params)
    {

        if(Yii::$app->user->identity->id == $params['post']->user_id){
            return true;
        }
        return false;
    }
}
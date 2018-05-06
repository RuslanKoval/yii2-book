<?php

use yii\db\Migration;

/**
 * Class m180506_200904_roles
 */
class m180506_200904_roles extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        $owner = new \app\components\rbac\OwnerBook();
        $auth->add($owner);

        $took = new \app\components\rbac\TookBook();
        $auth->add($took);

        $ownerBook = $auth->createPermission('ownerBook');
        $ownerBook->description = 'Вернуть книгу';
        $ownerBook->ruleName = $owner->name;
        $auth->add($ownerBook);

        $tookBook = $auth->createPermission('tookBook');
        $tookBook->description = 'Взять книгу';
        $tookBook->ruleName = $took->name;
        $auth->add($tookBook);

        $userRole = $auth->createRole('user');
        $userRole->description = 'Пользователь';
        $auth->add($userRole);
        $auth->addChild($userRole, $ownerBook);
        $auth->addChild($userRole, $tookBook);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
    }

}

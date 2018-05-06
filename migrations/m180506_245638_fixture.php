<?php

use yii\db\Migration;

/**
 * Class m180506_245638_fixture
 */
class m180506_245638_fixture extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->fixtureUser(20);
        $this->fixtureExchangePoint(20);
        $this->fixtureBook(40);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180506_145638_fixture cannot be reverted.\n";
    }

    private function fixtureUser($num)
    {
        for ($i = 0; $i <= $num; $i ++) {
            $model = new \app\models\SignupForm();
            $model->username = "user-{$i}";
            $model->email = "test_email{$i}@gmail.com";
            $model->password = '123456';
            if ($model->signup()) {
                echo "created new user ({$model->username}) \n";
            }
        }
    }

    private function fixtureExchangePoint($num)
    {
        for ($i = 0; $i <= $num; $i ++) {
            $model = new \app\models\ExchangePoint();
            $model->name = "Exchange-{$i}";
            if ($model->save()) {
                echo "created new Exchange ({$model->name}) \n";
            }
        }
    }

    private function fixtureBook($num)
    {
        for ($i = 0; $i <= $num; $i ++) {
            $exchangePoints = \app\models\ExchangePoint::find()->all();
            $exchangePointsCount = count($exchangePoints);
            $upload = new \app\models\UploadForm();

            $model = new \app\models\Book();
            $model->name = "Book-{$i}";
            $model->description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab alias, aut deserunt dicta, enim magnam natus neque nisi nobis obcaecati odit perspiciatis possimus quam quia quisquam sint voluptate voluptatem. Id.";
            $model->exchange_id = $exchangePoints[rand(1, $exchangePointsCount - 1)]->id;
            $model->author = "Author-($i)";

            $model->preview = $upload->uploadDemoImg(rand(1, 10));

            if ($model->save()) {
                echo "created new book ({$model->name}) \n";
            }
        }
    }
}

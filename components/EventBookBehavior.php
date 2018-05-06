<?php

namespace app\components;


use app\models\Book;
use Yii;
use yii\base\Behavior;

class EventBookBehavior extends Behavior
{
    public $owner;


    public function events()
    {
        return [
            Book::EVENT_TOOK => 'tookBook',
            Book::EVENT_RETURN => 'returnBook',
            Book::EVENT_ERROR => 'errorBook',
            Book::EVENT_THERE_ARE => 'ThereAreBook',
        ];
    }

    public function tookBook()
    {
        Yii::$app->session->addFlash('massage', ['type' => 'success', 'value' => 'You took the book']);
    }

    public function returnBook()
    {
        Yii::$app->session->addFlash('massage', ['type' => 'info', 'value' => 'You return the book']);
    }

    public function errorBook()
    {
        Yii::$app->session->addFlash('massage', ['type' => 'warning', 'value' => 'This book is busy']);
    }

    public function ThereAreBook()
    {
        Yii::$app->session->addFlash('massage', ['type' => 'info', 'value' => 'You already have a book']);
    }


}
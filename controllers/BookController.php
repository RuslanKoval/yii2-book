<?php

namespace app\controllers;


use app\models\Book;
use app\models\ExchangePoint;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class BookController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['change', 'my'],
                        'allow' => true,
                        'roles' => ['user'],
                    ],
                    [
                        'actions' => ['view', 'search'],
                        'allow' => true,
                    ],
                ],
            ]
        ];
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    public function actionChange($id)
    {
        $user = \Yii::$app->user->identity;

        $model = $this->findModel($id);

        if ($model->checkBook()) {
            if (\Yii::$app->user->can('tookBook', ['post' => $model]))
            {
                $model->user_id = $user->id;
                $model->save();
                $model->trigger(Book::EVENT_TOOK);

            } else {
                $model->trigger(Book::EVENT_THERE_ARE);
            }

        } else {
            if (\Yii::$app->user->can('ownerBook', ['post' => $model])) {
                $model->user_id = null;
                $model->save();
                $model->trigger(Book::EVENT_RETURN);
            } else {
                $model->trigger(Book::EVENT_ERROR);
            }
        }


        return $this->redirect(['book/view', 'id' => $model->id]);

    }

    public function actionMy()
    {
        return $this->render('my', [
            'model' => \Yii::$app->user->identity->book
        ]);
    }

    public function actionSearch()
    {
        $searchString = \Yii::$app->request->get('s');

        $dataProvider = new ActiveDataProvider([
            'query' => Book::find()->filterWhere(['like', 'name', $searchString]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('search', [
            's' => $searchString,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return ExchangePoint|null
     * @throws NotFoundHttpException
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
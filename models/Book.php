<?php

namespace app\models;

use app\components\EventBookBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $preview
 * @property string $author
 * @property int $user_id
 * @property int $exchange_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property ExchangePoint $exchange
 * @property User $user
 */
class Book extends \yii\db\ActiveRecord
{

    const EVENT_TOOK = 'took book';
    const EVENT_RETURN = 'return book';
    const EVENT_ERROR = 'error book';
    const EVENT_THERE_ARE = 'book there are';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%book}}';
    }


    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            EventBookBehavior::className()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author'], 'required'],
            [['description'], 'string'],
            [['user_id', 'exchange_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'preview', 'author'], 'string', 'max' => 255],
            [['exchange_id'], 'exist', 'skipOnError' => true, 'targetClass' => ExchangePoint::className(), 'targetAttribute' => ['exchange_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'preview' => 'Preview',
            'user_id' => 'User ID',
            'exchange_id' => 'Exchange ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExchange()
    {
        return $this->hasOne(ExchangePoint::className(), ['id' => 'exchange_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPreviewUrl()
    {
        return "/images/{$this->preview}";
    }

    public function checkBook(){
        return ($this->user == null);
    }

    public function getStatus()
    {
        if($this->checkBook())
        {
            return Html::tag('i', 'Free', ['class' => 'alert my-alert alert-success']);
        }
        return Html::tag('i', 'Busy', ['class' => 'alert my-alert alert-danger']);
    }


}

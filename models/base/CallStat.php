<?php

namespace app\models\base;

use app\models\query\CallStatQuery;
use Yii;

/**
 * This is the model class for table "{{%call_stat}}".
 *
 * @property int $id
 * @property int $user_id Работник
 * @property string $date Дата
 * @property int $count Кол-во звонков
 */
class CallStat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%call_stat}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'date'], 'required'],
            [['user_id', 'count'], 'integer'],
            [['date'], 'safe'],
            [['date', 'user_id'], 'unique', 'targetAttribute' => ['date', 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'Работник'),
            'date' => Yii::t('app', 'Дата'),
            'count' => Yii::t('app', 'Кол-во звонков'),
        ];
    }

    /**
     * @inheritdoc
     * @return CallStatQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CallStatQuery(get_called_class());
    }
}

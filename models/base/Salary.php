<?php

namespace app\models\base;

use app\models\query\SalaryQuery;
use Yii;

/**
 * This is the model class for table "{{%salary}}".
 *
 * @property int $id
 * @property int $user_id Работник
 * @property int $summ Сумма оклада
 */
class Salary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%salary}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'summ'], 'required'],
            [['user_id', 'summ'], 'integer'],
            [['user_id'], 'unique'],
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
            'summ' => Yii::t('app', 'Сумма оклада'),
        ];
    }

    /**
     * @inheritdoc
     * @return SalaryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SalaryQuery(get_called_class());
    }
}

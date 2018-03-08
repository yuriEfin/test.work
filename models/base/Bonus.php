<?php

namespace app\models\base;

use app\models\query\BonusQuery;
use Yii;

/**
 * This is the model class for table "{{%bonus}}".
 *
 * @property int $id
 * @property string $title Категория
 * @property string $operator Больше, меньше
 * @property int $step Шаг начисления
 * @property double $summ_bonus Сумма бонуса
 */
class Bonus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%bonus}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'operator', 'step', 'summ_bonus'], 'required'],
            [['step'], 'integer'],
            [['summ_bonus'], 'number'],
            [['title'], 'string', 'max' => 100],
            [['operator'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Категория'),
            'operator' => Yii::t('app', 'Больше, меньше'),
            'step' => Yii::t('app', 'Шаг начисления'),
            'summ_bonus' => Yii::t('app', 'Сумма бонуса'),
        ];
    }

    /**
     * @inheritdoc
     * @return \app\models\Query\BonusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BonusQuery(get_called_class());
    }
}

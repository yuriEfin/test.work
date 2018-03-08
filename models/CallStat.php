<?php

namespace app\models;

use app\models\base\CallStat as BaseCallStat;

/**
 * This is the model class for table "{{%call_stat}}".
 *
 * @property int $id
 * @property int $user_id Работник
 * @property string $date Дата
 * @property int $count Кол-во звонков
 */
class CallStat extends BaseCallStat
{
    /**
     * @var integer
     */
    public $summBonusDate;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * User
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Employee::class, ['id' => 'user_id']);
    }
}

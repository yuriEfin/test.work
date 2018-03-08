<?php

namespace app\models;

use app\components\interfaces\IEmployee;
use app\models\base\Employee as BaseEmployee;
use yii\db\Expression;

/**
 * This is the model class for table "{{%employee}}".
 *
 * @property int $id
 * @property string $lastname Фамилия
 * @property string $username Имя
 * @property string $middlename Отчество
 * @property int $position_id Должность из справочника
 */
class Employee extends BaseEmployee implements IEmployee
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @return int
     */
    public function sumCall()
    {
        return CallStat::find()
            ->where([
                'user_id' => $this->id,
            ])->andWhere(new Expression('count IS NOT NULL'))->sum('count');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalary()
    {
        return $this->hasOne(Salary::class, ['user_id' => 'id']);
    }

    /**
     * @return string
     */
    public function getFio()
    {
        return $this->lastname . ' ' . $this->username . ' ' . $this->middlename;
    }
}

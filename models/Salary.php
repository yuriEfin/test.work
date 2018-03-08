<?php

namespace app\models;

use app\models\base\Salary as BaseSalary;

/**
 * This is the model class for table "{{%salary}}".
 *
 * @property int $id
 * @property int $user_id Работник
 * @property int $summ Сумма оклада
 */
class Salary extends BaseSalary
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }
}

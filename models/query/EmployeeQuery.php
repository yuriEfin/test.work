<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\base\Employee]].
 *
 * @see \app\models\base\Employee
 */
class EmployeeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\base\Employee[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\base\Employee|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

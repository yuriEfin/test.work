<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[Salary]].
 *
 * @see Salary
 */
class SalaryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Salary[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Salary|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[CallStat]].
 *
 * @see CallStat
 */
class CallStatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CallStat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CallStat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}

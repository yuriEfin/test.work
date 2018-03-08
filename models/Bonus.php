<?php

namespace app\models;

use app\components\interfaces\IBonus;
use app\models\base\Bonus as BaseBonus;
use yii\base\ErrorException;

/**
 * This is the model class for table "{{%bonus}}".
 *
 * @property int $id
 * @property string $title Категория
 * @property int $count Шаг
 * @property string $operator Больше, меньше
 * @property double $summ_bonus Сумма бонуса
 */
class Bonus extends BaseBonus implements IBonus
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_merge(parent::rules(), []);
    }

    /**
     * @param int $count
     * @return bool
     * @throws ErrorException
     */
    public function support($count)
    {
        switch ($this->operator) {
            case '<=':
                $support = $count <= $this->count;
                break;
            case '>=':
                $support = $count >= $this->count;
                break;
            default:
                throw new ErrorException('Not support operator', 500);
        }
        return $support;
    }

    /**
     * @return float
     */
    public function getSumBonus()
    {
        return $this->summ_bonus;
    }

    /**
     * @param string $orderBy
     * @return BaseBonus[]|Bonus[]|array
     */
    public function getAll($orderBy)
    {
        return self::find()
            ->orderBy($orderBy)
            ->all();
    }
}

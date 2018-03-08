<?php


namespace app\components;

use app\components\interfaces\IBonus;

/**
 * Class AbstractHandleCalculate
 * @package app\components
 */
abstract class AbstractHandleCalculate
{
    /**
     * Common count call
     *
     * @var integer
     */
    public $count;

    /**
     * @param int $value
     * @return $this
     */
    public function setCount($value)
    {
        $this->count = $value;

        return $this;
    }

    /**
     * Return summ bonus
     * @return float|int
     */
    public function calculate(IBonus $bonus)
    {
        return $this->count * $bonus->getSumBonus();
    }
}
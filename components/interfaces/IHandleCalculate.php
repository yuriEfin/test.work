<?php


namespace app\components\interfaces;


interface IHandleCalculate
{
    /**
     * @param IBonus $bonus
     * @return mixed
     */
    public function calculate(IBonus $bonus);

    /**
     * @param int $count
     * @return $this
     */
    public function setCount($count);
}
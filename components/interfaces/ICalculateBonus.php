<?php

namespace app\components\interfaces;

interface ICalculateBonus
{
    public function calculate(IEmployee $employee);
}
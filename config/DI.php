<?php
/** Example use DI */

use app\components\HandleCalculate;

Yii::$container->set('app\components\interfaces\IHandleCalculate', function () {
    return new HandleCalculate();
});
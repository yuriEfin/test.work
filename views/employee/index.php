<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\Employee */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Employee'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'username',
                'format' => 'raw',
                'value' => function ($m) {
                    return $m->getFio();
                }
            ],
            [
                'attribute' => 'sallary',
                'label' => 'Оклад без бонусов',
                'format' => 'raw',
                'value' => function ($m) {
                    return $m->salary->summ;
                }
            ],
            [
                'attribute' => 'bonuses',
                'label' => 'Бонусы за прошедший период',
                'format' => 'raw',
                'value' => function ($m) {
                    return Yii::$app->calculateBonus->calculate($m);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

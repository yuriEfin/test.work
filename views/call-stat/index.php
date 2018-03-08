<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\CallStatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Call Stats');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="call-stat-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Call Stat'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'format' => 'raw',
                'value' => function ($m) {
                    return $m->user->fio;
                }
            ],
            [
                'attribute' => 'date',
                'format' => 'raw',
                'value' => function ($m) {
                    return (new \DateTime())->format('d-m-Y');
                }
            ],
            [
                'attribute' => 'count',
                'format' => 'raw',
            ],
            [
                'attribute' => 'summBonusDate',
                'label' => 'Сумма бонусов',
                'format' => 'raw',
                'value' => function ($m) {
                    return Yii::$app->calculateBonus->calculate(null, $m->count);
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>

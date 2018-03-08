<?php

namespace app\controllers;

use app\models\search\CallStatSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;

/**
 * CallStatController implements the CRUD actions for CallStat model.
 */
class CallStatController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CallStat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CallStatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}

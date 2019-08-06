<?php

namespace app\controllers;

use app\services\StatisticService;
use yii\data\ActiveDataProvider;

class StatisticController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => StatisticService::getTopCustomers(),

        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

}

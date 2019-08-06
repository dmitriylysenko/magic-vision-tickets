<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'event_id',
                'value'     => function ($model) {
                    return ArrayHelper::getValue($model, 'event.name');
                }
            ],
            [
                'attribute' => 'customer_id',
                'value'     => function ($model) {
                    return ArrayHelper::getValue($model, 'customer.name');
                }
            ],
            'status',
            'count_tickets',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

<?php

use app\models\Location;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Event */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="event-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>
    <?php
    $formattedDate = !empty($model->date) ? Yii::$app->formatter->asDatetime($model->date, 'php:d.m.Y H:i') : '';
    var_dump($formattedDate);
    ?>
    <?= $form->field($model, 'date')->widget(DateTimePicker::classname(), [
        'language'      => 'uk',
        'options'       => [
            'value'       => $formattedDate,
            'placeholder' => Yii::t('app', 'Select publication date'),
        ],
        'pluginOptions' => [
            'autoclose'      => true,
            'format'         => 'dd.mm.yyyy HH:ii',
            'todayHighlight' => true,
            'todayBtn'       => true,
        ]
    ]) ?>
    <?= $form->field($model, 'location_id')
        ->dropDownList(ArrayHelper::map(Location::find()->all(), 'id', 'name')) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

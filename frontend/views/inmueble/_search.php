<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\InmuebleSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="inmueble-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'direccion') ?>

    <?= $form->field($model, 'detalles') ?>

    <?= $form->field($model, 'dueno') ?>

    <?= $form->field($model, 'estado') ?>

    <?php // echo $form->field($model, 'inquilino') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

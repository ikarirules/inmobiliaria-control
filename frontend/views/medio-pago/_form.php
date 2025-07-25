<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\MedioPago $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="medio-pago-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'medio')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detalle')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

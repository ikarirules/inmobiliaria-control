<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var frontend\models\Cliente $model */
/** @var yii\widgets\ActiveForm $form */
?>

<style>
    .form-container {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        padding: 40px;
        max-width: 600px;
        margin: 40px auto;
        animation: fadeIn 0.4s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .form-container h1 {
        text-align: center;
        margin-bottom: 30px;
        color: #333;
        font-size: 24px;
    }

    .form-group label {
        font-weight: 500;
        color: #555;
        margin-bottom: 6px;
    }

    .form-control {
        border-radius: 10px;
        border: 2px solid #e1e5e9;
        padding: 10px 14px;
        background: #f8f9fa;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .btn-submit {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .btn-submit:active {
        transform: translateY(0);
    }
</style>

<div class="form-container">
    <h1>📋 Registro de Cliente</h1>

    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'cliente-form']
    ]); ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    <?= $form->field($model, 'telefono1')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    <?= $form->field($model, 'telefono2')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
    <?= $form->field($model, 'email')->input('email', ['maxlength' => true, 'class' => 'form-control']) ?>
    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>

    <?= $form->field($model, 'tipo')->dropDownList([
        'inquilino' => '🏠 Inquilino',
        'propietario' => '🏡 Propietario',
        'otro' => '👤 Otro',
    ], ['prompt' => 'Seleccione un tipo', 'class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('💾 Guardar Cliente', ['class' => 'btn-submit']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

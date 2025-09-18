<?php
use yii\helpers\ArrayHelper;
use frontend\models\Cliente;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var frontend\models\Inmueble $model */
/** @var yii\widgets\ActiveForm $form */

$duenos = ArrayHelper::map(
    Cliente::find()->where(['tipo' => 'propietario'])->all(),
    'id',
    function($model) {
        return $model->nombres . ' ' . $model->apellidos;
    }
);

// Lista de inquilinos
$inquilinos = ArrayHelper::map(
    Cliente::find()->where(['tipo' => 'inquilino'])->all(),
    'id',
    function($model) {
        return $model->nombres . ' ' . $model->apellidos;
    }
);
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
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
    }
    .textarea-field {
        grid-column: 1 / -1;
    }
</style>

<div class="form-container">
    <h1>🏠 Registro de Inmueble</h1>
    <?php $form = ActiveForm::begin([
        'options' => ['id' => 'inmueble-form']
    ]); ?>
    
    <div class="form-grid">
        <?= $form->field($model, 'direccion')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
        
        <?= $form->field($model, 'dueno')->dropDownList(
            $duenos,
            ['prompt' => 'Seleccione un dueño', 'class' => 'form-control']
        ) ?>
        
        <?= $form->field($model, 'inquilino')->dropDownList(
            $inquilinos,
            ['prompt' => 'Seleccione un inquilino', 'class' => 'form-control']
        ) ?>
        
        <?= $form->field($model, 'estado')->dropDownList([
            'alquilada' => '🏡 Alquilada',
            'no alquilada' => '🏠 No alquilada'
        ], ['prompt' => 'Seleccione el estado', 'class' => 'form-control']) ?>
        
        <div class="textarea-field">
            <?= $form->field($model, 'detalles')->textarea([
                'rows' => 6, 
                'class' => 'form-control',
                'placeholder' => 'Escriba los detalles del inmueble...'
            ]) ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('🏠 Guardar Inmueble', ['class' => 'btn-submit']) ?>
    </div>
    
    <?php ActiveForm::end(); ?>
</div>
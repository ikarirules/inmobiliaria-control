<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use frontend\models\Inmueble;
use yii\helpers\ArrayHelper;
/** @var yii\web\View $this */
/** @var frontend\models\Caja $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="caja-form-container">
    <div class="form-header">
        <h4 class="form-title">
            <?php if ($model->tipo_movimiento == 0): ?>
                <span class="badge badge-ingreso">💰 Nuevo Ingreso</span>
            <?php else: ?>
                <span class="badge badge-egreso">💸 Nuevo Egreso</span>
            <?php endif; ?>
        </h4>
    </div>

    <div class="form-card">
        <?php $form = ActiveForm::begin([
            'id' => 'caja-form',
            'options' => ['class' => 'form-modern'],
            'fieldConfig' => [
                'template' => '<div class="form-group-compact">{label}{input}{error}</div>',
                'labelOptions' => ['class' => 'form-label-compact'],
                'inputOptions' => ['class' => 'form-control-compact'],
                'errorOptions' => ['class' => 'form-error-compact'],
            ],
        ]); ?>

        <?= $form->field($model, 'tipo_movimiento')->hiddenInput()->label(false) ?>

        <!-- Fila 1: Fechas en una sola línea -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'fecha')->textInput([
                    'class' => 'form-control form-control-compact',
                    'id' => 'fecha-picker',
                    'placeholder' => 'Fecha'
                ])->label('📅 Fecha') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'fecha_referencia')->textInput([
                    'class' => 'form-control form-control-compact',
                    'id' => 'fecha-referencia-picker',
                    'placeholder' => 'Fecha ref.'
                ])->label('📋 Fecha Ref.') ?>
            </div>
        </div>

        <!-- Fila 2: Monto, Medio de Pago y Categoría en una línea -->
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'monto')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control form-control-compact form-control-money',
                    'placeholder' => '0.00',
                    'id' => 'monto-input'
                ])->label('💵 Monto') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'medio_pago')->dropDownList(
                    $medios,
                    [
                        'prompt' => 'Medio de pago',
                        'class' => 'form-control form-control-compact form-select-compact',
                        'id' => 'medio-pago-select'
                    ]
                )->label('💳 Medio') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'id_categoria')->dropDownList(
                    $categorias,
                    [
                        'prompt' => 'Categoría',
                        'class' => 'form-control form-control-compact form-select-compact',
                        'id' => 'categoria-select'
                    ]
                )->label('📂 Categoría') ?>
            </div>
        </div>

        <!-- Fila 3: Cliente -->
        <div class="row">
            <div class="col-6">
                <?= $form->field($model, 'id_cliente')->widget(Select2::classname(), [
                    'options' => [
                        'placeholder' => 'Buscar cliente...',
                        'id' => 'busca-cliente',
                        'class' => 'form-control-compact',
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'minimumInputLength' => 2,
                        'ajax' => [
                            'url' => \yii\helpers\Url::to(['cliente/buscar']),
                            'dataType' => 'json',
                            'data' => new JsExpression('function(params) { return {q:params.term}; }'),
                            'processResults' => new JsExpression('function(data) {
                                return { results: data };
                            }'),
                        ],
                        'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                        'templateResult' => new JsExpression('function(cliente) { return cliente.text; }'),
                        'templateSelection' => new JsExpression('function (cliente) { return cliente.text; }'),
                    ],
                ])->label('👤 Cliente') ?>
            </div>
            <div class="col-6">
                <?= $form->field($model, 'inmueble_id')->dropDownList(
                    ArrayHelper::map(Inmueble::find()->where(['estado' => 'alquilada'])->all(), 'id', 'direccion'),
                    ['prompt' => 'Seleccione un inmueble (opcional)']
                ) ?>


            </div>
        </div>

        <!-- Fila 4: Detalle más compacto -->
        <div class="row">
            <div class="col-12">
                <?= $form->field($model, 'detalle')->textarea([
                    'rows' => 2,
                    'class' => 'form-control form-control-compact',
                    'placeholder' => 'Detalles del movimiento...',
                    'id' => 'detalle-textarea'
                ])->label('📝 Detalle') ?>
            </div>
        </div>

        <!-- Botones de acción compactos -->
        <div class="form-actions">
            <div class="row">
                <div class="col-6">
                    <?= Html::a('Cancelar', ['caja/index'], [
                        'class' => 'btn btn-secondary btn-compact btn-block',
                        'id' => 'btn-cancelar'
                    ]) ?>
                </div>
                <div class="col-6">
                    <?php if ($model->tipo_movimiento == 0): ?>
                        <?= Html::submitButton('💰 Guardar', [
                            'class' => 'btn btn-success btn-compact btn-block btn-save',
                            'id' => 'btn-guardar'
                        ]) ?>
                    <?php else: ?>
                        <?= Html::submitButton('💸 Guardar', [
                            'class' => 'btn btn-danger btn-compact btn-block btn-save',
                            'id' => 'btn-guardar'
                        ]) ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>

<style type="text/css">
/* === CONTENEDOR PRINCIPAL COMPACTO === */
.caja-form-container {
    max-width: 700px;
    margin: 0 auto;
    padding: 15px;
}

/* === HEADER DEL FORMULARIO === */
.form-header {
    text-align: center;
    margin-bottom: 20px;
}

.form-title {
    margin: 0;
    font-weight: 300;
}

.badge {
    font-size: 1rem;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 600;
}

.badge-ingreso {
    background: linear-gradient(135deg, #58d68d, #2ecc71);
    color: white;
}

.badge-egreso {
    background: linear-gradient(135deg, #ec7063, #e74c3c);
    color: white;
}

/* === TARJETA DEL FORMULARIO COMPACTA === */
.form-card {
    background: white;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 3px 15px rgba(0, 0, 0, 0.08);
    border: 1px solid #e9ecef;
}

/* === FORMULARIO COMPACTO === */
.form-modern {
    width: 100%;
}

.form-group-compact {
    margin-bottom: 15px;
}

.form-label-compact {
    font-weight: 600;
    color: #495057;
    margin-bottom: 5px;
    display: block;
    font-size: 0.875rem;
}

.form-control-compact {
    border: 2px solid #e9ecef;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    background-color: #fff;
    height: 36px;
}

.form-control-compact:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.1);
    outline: none;
}

.form-select-compact {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 8px center;
    background-size: 14px 10px;
    padding-right: 30px;
}

.form-control-money {
    text-align: right;
    font-weight: 600;
    color: #28a745;
}

/* === TEXTAREA COMPACTO === */
textarea.form-control-compact {
    height: auto;
    resize: vertical;
    min-height: 60px;
}

/* === ERRORES === */
.form-error-compact {
    color: #dc3545;
    font-size: 0.8rem;
    margin-top: 3px;
}

/* === BOTONES COMPACTOS === */
.form-actions {
    margin-top: 20px;
    padding-top: 15px;
    border-top: 1px solid #e9ecef;
}

.btn-compact {
    padding: 8px 16px;
    font-weight: 600;
    border-radius: 6px;
    transition: all 0.3s ease;
    border: none;
    font-size: 0.875rem;
    width: 100%;
}

.btn-compact:hover {
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.12);
}

.btn-success.btn-compact {
    background: linear-gradient(135deg, #58d68d, #2ecc71);
    color: white;
}

.btn-success.btn-compact:hover {
    background: linear-gradient(135deg, #4fc3a5, #27ae60);
}

.btn-danger.btn-compact {
    background: linear-gradient(135deg, #ec7063, #e74c3c);
    color: white;
}

.btn-danger.btn-compact:hover {
    background: linear-gradient(135deg, #e55a4e, #c0392b);
}

.btn-secondary.btn-compact {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
}

.btn-secondary.btn-compact:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
}

/* === SELECT2 COMPACTO === */
.select2-container--default .select2-selection--single {
    border: 2px solid #e9ecef !important;
    border-radius: 6px !important;
    height: 36px !important;
    padding: 4px 8px !important;
}

.select2-container--default .select2-selection--single:focus {
    border-color: #007bff !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 26px !important;
    padding-left: 4px !important;
    font-size: 0.9rem !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 34px !important;
    right: 6px !important;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .caja-form-container {
        padding: 10px;
    }
    
    .form-card {
        padding: 15px;
    }
    
    .col-md-4 {
        margin-bottom: 10px;
    }
    
    .badge {
        font-size: 0.9rem;
        padding: 6px 12px;
    }
}

@media (max-width: 576px) {
    .form-card {
        padding: 12px;
    }
    
    .form-control-compact {
        padding: 6px 10px;
        font-size: 0.85rem;
        height: 32px;
    }
    
    .btn-compact {
        padding: 6px 12px;
        font-size: 0.8rem;
    }
    
    .form-group-compact {
        margin-bottom: 12px;
    }
}

/* === ANIMACIONES === */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(15px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-card {
    animation: fadeInUp 0.5s ease-out;
}

/* === ESTADOS DE VALIDACIÓN === */
.form-control-compact.is-invalid {
    border-color: #dc3545;
}

.form-control-compact.is-valid {
    border-color: #28a745;
}

/* === MEJORAS ADICIONALES === */
.form-control-compact::placeholder {
    color: #adb5bd;
    opacity: 1;
    font-size: 0.85rem;
}

.form-control-compact:disabled {
    background-color: #f8f9fa;
    opacity: 1;
}

/* === FOCUS INDICATORS === */
.form-control-compact:focus,
.form-select-compact:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.1);
}
</style>

<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function() {
    // Inicializar Flatpickr para las fechas
    if (typeof flatpickr !== 'undefined') {
        flatpickr("#fecha-picker", {
            dateFormat: "Y-m-d",
            defaultDate: "today",
            locale: "es"
        });
        
        flatpickr("#fecha-referencia-picker", {
            dateFormat: "Y-m-d",
            locale: "es"
        });
    }
    
    // Formatear el campo de monto
    const montoInput = document.getElementById('monto-input');
    if (montoInput) {
        montoInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/[^0-9.]/g, '');
            if (value.split('.').length > 2) {
                value = value.substring(0, value.lastIndexOf('.'));
            }
            e.target.value = value;
        });
        
        montoInput.addEventListener('blur', function(e) {
            let value = parseFloat(e.target.value);
            if (!isNaN(value)) {
                e.target.value = value.toFixed(2);
            }
        });
    }
    
    // Validación del formulario
    const form = document.getElementById('caja-form');
    if (form) {
        form.addEventListener('submit', function(e) {
            const monto = document.getElementById('monto-input').value;
            const medioPago = document.getElementById('medio-pago-select').value;
            const categoria = document.getElementById('categoria-select').value;
            
            if (!monto || !medioPago || !categoria) {
                e.preventDefault();
                alert('Por favor complete todos los campos obligatorios.');
                return false;
            }
            
            if (parseFloat(monto) <= 0) {
                e.preventDefault();
                alert('El monto debe ser mayor a 0.');
                return false;
            }
        });
    }
});
</script>
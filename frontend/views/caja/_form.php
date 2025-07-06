<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
/** @var yii\web\View $this */
/** @var frontend\models\Caja $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="caja-form-container">
    <div class="form-header">
        <h3 class="form-title">
            <?php if ($model->tipo_movimiento == 0): ?>
                <span class="badge badge-ingreso">💰 Nuevo Ingreso</span>
            <?php else: ?>
                <span class="badge badge-egreso">💸 Nuevo Egreso</span>
            <?php endif; ?>
        </h3>
    </div>

    <div class="form-card">
        <?php $form = ActiveForm::begin([
            'id' => 'caja-form',
            'options' => ['class' => 'form-modern'],
            'fieldConfig' => [
                'template' => '<div class="form-group-modern">{label}{input}{error}</div>',
                'labelOptions' => ['class' => 'form-label-modern'],
                'inputOptions' => ['class' => 'form-control-modern'],
                'errorOptions' => ['class' => 'form-error-modern'],
            ],
        ]); ?>

        <!-- Fila 1: Fechas -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'fecha')->textInput([
                    'class' => 'form-control form-control-modern',
                    'id' => 'fecha-picker',
                    'placeholder' => 'Seleccione la fecha'
                ])->label('📅 Fecha') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'fecha_referencia')->textInput([
                    'class' => 'form-control form-control-modern',
                    'id' => 'fecha-referencia-picker',
                    'placeholder' => 'Fecha de referencia'
                ])->label('📋 Fecha de Referencia') ?>
            </div>
        </div>

        <!-- Campo oculto -->
        <?= $form->field($model, 'tipo_movimiento')->hiddenInput()->label(false) ?>

        <!-- Fila 2: Monto y Medio de Pago -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'monto')->textInput([
                    'maxlength' => true,
                    'class' => 'form-control form-control-modern form-control-money',
                    'placeholder' => '0.00',
                    'id' => 'monto-input'
                ])->label('💵 Monto') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'medio_pago')->dropDownList(
                    $medios,
                    [
                        'prompt' => 'Seleccione un medio de pago',
                        'class' => 'form-control form-control-modern form-select-modern',
                        'id' => 'medio-pago-select'
                    ]
                )->label('💳 Medio de Pago') ?>
            </div>
        </div>

        <!-- Fila 3: Categoría y Cliente -->
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'id_categoria')->dropDownList(
                    $categorias,
                    [
                        'prompt' => 'Seleccione una categoría',
                        'class' => 'form-control form-control-modern form-select-modern',
                        'id' => 'categoria-select'
                    ]
                )->label('📂 Categoría') ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'id_cliente')->widget(Select2::classname(), [
                    'options' => [
                        'placeholder' => 'Buscar cliente...',
                        'id' => 'busca-cliente',
                        'class' => 'form-control-modern',
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
        </div>

        <!-- Fila 4: Detalle -->
        <div class="row">
            <div class="col-12">
                <?= $form->field($model, 'detalle')->textarea([
                    'rows' => 4,
                    'class' => 'form-control form-control-modern',
                    'placeholder' => 'Ingrese los detalles del movimiento...',
                    'id' => 'detalle-textarea'
                ])->label('📝 Detalle') ?>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="form-actions">
            <div class="row">
                <div class="col-md-6">
                    <?= Html::a('🔙 Cancelar', ['caja/index'], [
                        'class' => 'btn btn-secondary btn-modern btn-block',
                        'id' => 'btn-cancelar'
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?php if ($model->tipo_movimiento == 0): ?>
                        <?= Html::submitButton('💰 Guardar Ingreso', [
                            'class' => 'btn btn-success btn-modern btn-block btn-save',
                            'id' => 'btn-guardar'
                        ]) ?>
                    <?php else: ?>
                        <?= Html::submitButton('💸 Guardar Egreso', [
                            'class' => 'btn btn-danger btn-modern btn-block btn-save',
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
/* === CONTENEDOR PRINCIPAL === */
.caja-form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* === HEADER DEL FORMULARIO === */
.form-header {
    text-align: center;
    margin-bottom: 30px;
}

.form-title {
    margin: 0;
    font-weight: 300;
}

.badge {
    font-size: 1.2rem;
    padding: 12px 24px;
    border-radius: 25px;
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

/* === TARJETA DEL FORMULARIO === */
.form-card {
    background: white;
    border-radius: 15px;
    padding: 30px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    border: 1px solid #e9ecef;
}

/* === FORMULARIO MODERNO === */
.form-modern {
    width: 100%;
}

.form-group-modern {
    margin-bottom: 25px;
}

.form-label-modern {
    font-weight: 600;
    color: #495057;
    margin-bottom: 8px;
    display: block;
    font-size: 0.95rem;
}

.form-control-modern {
    border: 2px solid #e9ecef;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background-color: #fff;
}

.form-control-modern:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
    outline: none;
}

.form-select-modern {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: right 12px center;
    background-size: 16px 12px;
    padding-right: 40px;
}

.form-control-money {
    text-align: right;
    font-weight: 600;
    color: #28a745;
}

/* === ERRORES === */
.form-error-modern {
    color: #dc3545;
    font-size: 0.875rem;
    margin-top: 5px;
}

/* === BOTONES === */
.form-actions {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #e9ecef;
}

.btn-modern {
    padding: 12px 24px;
    font-weight: 600;
    border-radius: 8px;
    transition: all 0.3s ease;
    border: none;
    font-size: 1rem;
    width: 100%;
}

.btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.btn-success.btn-modern {
    background: linear-gradient(135deg, #58d68d, #2ecc71);
    color: white;
}

.btn-success.btn-modern:hover {
    background: linear-gradient(135deg, #4fc3a5, #27ae60);
}

.btn-danger.btn-modern {
    background: linear-gradient(135deg, #ec7063, #e74c3c);
    color: white;
}

.btn-danger.btn-modern:hover {
    background: linear-gradient(135deg, #e55a4e, #c0392b);
}

.btn-secondary.btn-modern {
    background: linear-gradient(135deg, #6c757d, #5a6268);
    color: white;
}

.btn-secondary.btn-modern:hover {
    background: linear-gradient(135deg, #5a6268, #495057);
}

/* === SELECT2 PERSONALIZADO === */
.select2-container--default .select2-selection--single {
    border: 2px solid #e9ecef !important;
    border-radius: 8px !important;
    height: 48px !important;
    padding: 8px 12px !important;
}

.select2-container--default .select2-selection--single:focus {
    border-color: #007bff !important;
}

.select2-container--default .select2-selection--single .select2-selection__rendered {
    line-height: 30px !important;
    padding-left: 4px !important;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 46px !important;
    right: 8px !important;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
    .caja-form-container {
        padding: 10px;
    }
    
    .form-card {
        padding: 20px;
    }
    
    .form-actions .col-md-6 {
        margin-bottom: 10px;
    }
    
    .badge {
        font-size: 1rem;
        padding: 8px 16px;
    }
}

@media (max-width: 576px) {
    .form-card {
        padding: 15px;
    }
    
    .form-control-modern {
        padding: 10px 12px;
        font-size: 0.95rem;
    }
    
    .btn-modern {
        padding: 10px 20px;
        font-size: 0.9rem;
    }
}

/* === ANIMACIONES === */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.form-card {
    animation: fadeInUp 0.6s ease-out;
}

/* === ESTADOS DE VALIDACIÓN === */
.form-control-modern.is-invalid {
    border-color: #dc3545;
}

.form-control-modern.is-valid {
    border-color: #28a745;
}

/* === MEJORAS ADICIONALES === */
.form-control-modern::placeholder {
    color: #adb5bd;
    opacity: 1;
}

.form-control-modern:disabled {
    background-color: #f8f9fa;
    opacity: 1;
}

/* === FOCUS INDICATORS === */
.form-control-modern:focus,
.form-select-modern:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.15);
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
<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Resumen de Caja';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="row mb-4">
    <!-- Filtros -->
    <div class="col-md-6">
        <p><strong>Filtrar por medio de pago:</strong></p>
        <?= Html::a('Todos', ['caja/resumen'], ['class' => 'btn btn-secondary mb-2']) ?>
        <?= Html::a('Transferencia', ['caja/resumen', 'medio_pago' => 1], ['class' => 'btn btn-primary mb-2']) ?>
        <?= Html::a('Efectivo', ['caja/resumen', 'medio_pago' => 3], ['class' => 'btn btn-success mb-2']) ?>
        <?= Html::a('Cheque', ['caja/resumen', 'medio_pago' => 2], ['class' => 'btn btn-info mb-2']) ?>
    </div>
    
    <!-- Totales Generales -->
    <div class="col-md-6">
        <h4>Totales Generales</h4>
        <div class="d-flex flex-wrap">
            <div class="alert alert-success me-2 mb-2 flex-fill">
                <small><strong>Ingresos:</strong></small><br>
                <span class="h5">$<?= number_format($ingresosTotales, 2) ?></span>
            </div>
            <div class="alert alert-danger me-2 mb-2 flex-fill">
                <small><strong>Egresos:</strong></small><br>
                <span class="h5">$<?= number_format($egresosTotales, 2) ?></span>
            </div>
            <div class="alert alert-info mb-2 flex-fill">
                <small><strong>Caja Total:</strong></small><br>
                <span class="h5">$<?= number_format($ingresosTotales - $egresosTotales, 2) ?></span>
            </div>
        </div>
    </div>
</div>
<hr>

<!-- Resumen por períodos -->
<div class="row">
    <!-- Del Día -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Del Día</h4>
                <small><?= date('d-m-Y') ?></small>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Ingresos:</strong><br>
                    <span class="text-success h5">$<?= number_format($ingresosDia, 2) ?></span>
                </div>
                <div class="mb-3">
                    <strong>Egresos:</strong><br>
                    <span class="text-danger h5">$<?= number_format($egresosDia, 2) ?></span>
                </div>
                <hr>
                <div>
                    <strong>Caja del Día:</strong><br>
                    <span class="h4 <?= ($ingresosDia - $egresosDia) >= 0 ? 'text-success' : 'text-danger' ?>">
                        $<?= number_format($ingresosDia - $egresosDia, 2) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Del Mes -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Del Mes</h4>
                <small><?= date('m-Y') ?></small>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Ingresos:</strong><br>
                    <span class="text-success h5">$<?= number_format($ingresosMes, 2) ?></span>
                </div>
                <div class="mb-3">
                    <strong>Egresos:</strong><br>
                    <span class="text-danger h5">$<?= number_format($egresosMes, 2) ?></span>
                </div>
                <hr>
                <div>
                    <strong>Caja del Mes:</strong><br>
                    <span class="h4 <?= ($ingresosMes - $egresosMes) >= 0 ? 'text-success' : 'text-danger' ?>">
                        $<?= number_format($ingresosMes - $egresosMes, 2) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Del Año -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Del Año</h4>
                <small><?= date('Y') ?></small>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Ingresos:</strong><br>
                    <span class="text-success h5">$<?= number_format($ingresosAnio, 2) ?></span>
                </div>
                <div class="mb-3">
                    <strong>Egresos:</strong><br>
                    <span class="text-danger h5">$<?= number_format($egresosAnio, 2) ?></span>
                </div>
                <hr>
                <div>
                    <strong>Caja del Año:</strong><br>
                    <span class="h4 <?= ($ingresosAnio - $egresosAnio) >= 0 ? 'text-success' : 'text-danger' ?>">
                        $<?= number_format($ingresosAnio - $egresosAnio, 2) ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
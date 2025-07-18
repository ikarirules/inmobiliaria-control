<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Resumen de Caja';
?>

<h1><?= Html::encode($this->title) ?></h1>

<div>
    <p><strong>Filtrar por medio de pago:</strong></p>
    <?= Html::a('Todos', ['caja/resumen'], ['class' => 'btn btn-secondary']) ?>
    <?= Html::a('Transferencia', ['caja/resumen', 'medio_pago' => 1], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Efectivo', ['caja/resumen', 'medio_pago' => 2], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Cheque', ['caja/resumen', 'medio_pago' => 3], ['class' => 'btn btn-info']) ?>
</div>

<hr>

<h3>Totales Generales</h3>
<ul>
    <li><strong>Ingresos:</strong> <?= number_format($ingresosTotales, 2) ?></li>
    <li><strong>Egresos:</strong> <?= number_format($egresosTotales, 2) ?></li>
    <li><strong>Caja Total:</strong> <?= number_format($ingresosTotales - $egresosTotales, 2) ?></li>
</ul>

<h3>Del Día (<?= date('d-m-Y') ?>)</h3>
<ul>
    <li><strong>Ingresos:</strong> <?= number_format($ingresosDia, 2) ?></li>
    <li><strong>Egresos:</strong> <?= number_format($egresosDia, 2) ?></li>
    <li><strong>Caja del Día:</strong> <?= number_format($ingresosDia - $egresosDia, 2) ?></li>
</ul>

<h3>Del Mes (<?= date('m-Y') ?>)</h3>
<ul>
    <li><strong>Ingresos:</strong> <?= number_format($ingresosMes, 2) ?></li>
    <li><strong>Egresos:</strong> <?= number_format($egresosMes, 2) ?></li>
</ul>

<h3>Del Año (<?= date('Y') ?>)</h3>
<ul>
    <li><strong>Ingresos:</strong> <?= number_format($ingresosAnio, 2) ?></li>
    <li><strong>Egresos:</strong> <?= number_format($egresosAnio, 2) ?></li>
</ul>

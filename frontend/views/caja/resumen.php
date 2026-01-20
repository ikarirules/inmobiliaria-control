<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = 'Resumen de Caja';
?>

<style>
.resumen-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    color: white;
}

.resumen-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 10px;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.resumen-subtitle {
    opacity: 0.9;
    font-size: 1.1rem;
}

.filter-section {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.filter-title {
    font-weight: 600;
    color: #374151;
    margin-bottom: 15px;
    font-size: 1rem;
}

.filter-btn {
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: 500;
    transition: all 0.3s ease;
    margin: 5px;
    border: none;
    text-decoration: none;
}

.filter-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.filter-btn-all {
    background: linear-gradient(135deg, #6b7280, #4b5563);
    color: white;
}

.filter-btn-transfer {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
    color: white;
}

.filter-btn-cash {
    background: linear-gradient(135deg, #10b981, #059669);
    color: white;
}

.filter-btn-check {
    background: linear-gradient(135deg, #06b6d4, #0891b2);
    color: white;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 50px rgba(0,0,0,0.15);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 15px;
}

.stat-icon-income {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #059669;
}

.stat-icon-expense {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
}

.stat-icon-total {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #2563eb;
}

.stat-label {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.stat-value {
    font-size: 1.8rem;
    font-weight: 700;
    color: #1f2937;
}

.stat-value-income {
    color: #059669;
}

.stat-value-expense {
    color: #dc2626;
}

.stat-value-positive {
    color: #059669;
}

.stat-value-negative {
    color: #dc2626;
}

.period-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    height: 100%;
}

.period-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 25px 60px rgba(0,0,0,0.15);
}

.period-header {
    padding: 25px;
    color: white;
    text-align: center;
}

.period-header-day {
    background: linear-gradient(135deg, #3b82f6, #1d4ed8);
}

.period-header-month {
    background: linear-gradient(135deg, #10b981, #059669);
}

.period-header-year {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
}

.period-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.period-date {
    opacity: 0.9;
    font-size: 0.95rem;
}

.period-body {
    padding: 25px;
}

.period-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 0;
    border-bottom: 1px solid #f3f4f6;
}

.period-row:last-child {
    border-bottom: none;
}

.period-label {
    font-weight: 500;
    color: #6b7280;
}

.period-value {
    font-size: 1.25rem;
    font-weight: 600;
}

.period-total {
    background: linear-gradient(135deg, #f9fafb, #f3f4f6);
    border-radius: 12px;
    padding: 20px;
    margin-top: 15px;
    text-align: center;
}

.period-total-label {
    font-size: 0.85rem;
    color: #6b7280;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 5px;
}

.period-total-value {
    font-size: 2rem;
    font-weight: 700;
}

.section-divider {
    height: 2px;
    background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
    margin: 40px 0;
}
</style>

<div class="resumen-container">
    <h1 class="resumen-title"><?= Html::encode($this->title) ?></h1>
    <p class="resumen-subtitle">Panel de control financiero de tu inmobiliaria</p>
</div>

<div class="row mb-4">
    <div class="col-lg-5 mb-4 mb-lg-0">
        <div class="filter-section h-100">
            <p class="filter-title">Filtrar por medio de pago:</p>
            <div class="d-flex flex-wrap">
                <?= Html::a('Todos', ['caja/resumen'], ['class' => 'filter-btn filter-btn-all']) ?>
                <?= Html::a('Transferencia', ['caja/resumen', 'medio_pago' => 1], ['class' => 'filter-btn filter-btn-transfer']) ?>
                <?= Html::a('Efectivo', ['caja/resumen', 'medio_pago' => 3], ['class' => 'filter-btn filter-btn-cash']) ?>
                <?= Html::a('Cheque', ['caja/resumen', 'medio_pago' => 2], ['class' => 'filter-btn filter-btn-check']) ?>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-income">+</div>
                    <p class="stat-label">Ingresos Totales</p>
                    <p class="stat-value stat-value-income">$<?= number_format($ingresosTotales, 2) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-expense">-</div>
                    <p class="stat-label">Egresos Totales</p>
                    <p class="stat-value stat-value-expense">$<?= number_format($egresosTotales, 2) ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon stat-icon-total">=</div>
                    <p class="stat-label">Caja Total</p>
                    <p class="stat-value <?= ($ingresosTotales - $egresosTotales) >= 0 ? 'stat-value-positive' : 'stat-value-negative' ?>">
                        $<?= number_format($ingresosTotales - $egresosTotales, 2) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="section-divider"></div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="period-card">
            <div class="period-header period-header-day">
                <h4 class="period-title">Del Dia</h4>
                <span class="period-date"><?= date('d/m/Y') ?></span>
            </div>
            <div class="period-body">
                <div class="period-row">
                    <span class="period-label">Ingresos</span>
                    <span class="period-value stat-value-income">$<?= number_format($ingresosDia, 2) ?></span>
                </div>
                <div class="period-row">
                    <span class="period-label">Egresos</span>
                    <span class="period-value stat-value-expense">$<?= number_format($egresosDia, 2) ?></span>
                </div>
                <div class="period-total">
                    <p class="period-total-label">Balance del Dia</p>
                    <p class="period-total-value <?= ($ingresosDia - $egresosDia) >= 0 ? 'stat-value-positive' : 'stat-value-negative' ?>">
                        $<?= number_format($ingresosDia - $egresosDia, 2) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="period-card">
            <div class="period-header period-header-month">
                <h4 class="period-title">Del Mes</h4>
                <span class="period-date"><?= date('m/Y') ?></span>
            </div>
            <div class="period-body">
                <div class="period-row">
                    <span class="period-label">Ingresos</span>
                    <span class="period-value stat-value-income">$<?= number_format($ingresosMes, 2) ?></span>
                </div>
                <div class="period-row">
                    <span class="period-label">Egresos</span>
                    <span class="period-value stat-value-expense">$<?= number_format($egresosMes, 2) ?></span>
                </div>
                <div class="period-total">
                    <p class="period-total-label">Balance del Mes</p>
                    <p class="period-total-value <?= ($ingresosMes - $egresosMes) >= 0 ? 'stat-value-positive' : 'stat-value-negative' ?>">
                        $<?= number_format($ingresosMes - $egresosMes, 2) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="period-card">
            <div class="period-header period-header-year">
                <h4 class="period-title">Del Ano</h4>
                <span class="period-date"><?= date('Y') ?></span>
            </div>
            <div class="period-body">
                <div class="period-row">
                    <span class="period-label">Ingresos</span>
                    <span class="period-value stat-value-income">$<?= number_format($ingresosAnio, 2) ?></span>
                </div>
                <div class="period-row">
                    <span class="period-label">Egresos</span>
                    <span class="period-value stat-value-expense">$<?= number_format($egresosAnio, 2) ?></span>
                </div>
                <div class="period-total">
                    <p class="period-total-label">Balance del Ano</p>
                    <p class="period-total-value <?= ($ingresosAnio - $egresosAnio) >= 0 ? 'stat-value-positive' : 'stat-value-negative' ?>">
                        $<?= number_format($ingresosAnio - $egresosAnio, 2) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

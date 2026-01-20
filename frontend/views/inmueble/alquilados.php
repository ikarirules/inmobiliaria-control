<?php
use yii\helpers\Html;
use frontend\models\Caja;

/** @var yii\web\View $this */
/** @var app\models\Inmueble[] $inmuebles */
/** @var string $mes */
/** @var string $anio */

$this->title = 'Inmuebles Alquilados';

$mesesNombres = [
    '01' => 'Enero', '02' => 'Febrero', '03' => 'Marzo', '04' => 'Abril',
    '05' => 'Mayo', '06' => 'Junio', '07' => 'Julio', '08' => 'Agosto',
    '09' => 'Septiembre', '10' => 'Octubre', '11' => 'Noviembre', '12' => 'Diciembre'
];
$mesNombre = isset($mesesNombres[$mes]) ? $mesesNombres[$mes] : $mes;
?>

<style>
.alquilados-container {
    padding: 20px 0;
}

.page-header {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    color: white;
}

.page-title {
    font-size: 2.2rem;
    font-weight: 700;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
}

.page-subtitle {
    opacity: 0.9;
    margin-top: 5px;
    font-size: 1rem;
}

.period-badge {
    display: inline-block;
    background: rgba(255,255,255,0.2);
    padding: 10px 20px;
    border-radius: 30px;
    margin-top: 15px;
    font-weight: 600;
    font-size: 1.1rem;
    border: 2px solid rgba(255,255,255,0.3);
}

.stats-row {
    display: flex;
    gap: 20px;
    margin-bottom: 30px;
    flex-wrap: wrap;
}

.stat-card {
    background: white;
    border-radius: 16px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    flex: 1;
    min-width: 200px;
    text-align: center;
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 50px rgba(0,0,0,0.12);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 5px;
}

.stat-number-paid {
    color: #059669;
}

.stat-number-pending {
    color: #dc2626;
}

.stat-number-total {
    color: #1d4ed8;
}

.stat-label {
    color: #64748b;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.table-container {
    background: white;
    border-radius: 20px;
    padding: 25px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.08);
}

.table-container .table {
    margin-bottom: 0;
}

.table-container .table thead th {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border: none;
    padding: 16px 20px;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}

.table-container .table thead th:first-child {
    border-radius: 12px 0 0 12px;
}

.table-container .table thead th:last-child {
    border-radius: 0 12px 12px 0;
}

.table-container .table tbody tr {
    transition: all 0.2s ease;
}

.table-container .table tbody tr:hover {
    background-color: #f8fafc;
}

.table-container .table tbody td {
    padding: 18px 20px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}

.table-container .table tbody tr:last-child td {
    border-bottom: none;
}

.direccion-cell {
    display: flex;
    align-items: center;
    gap: 12px;
}

.direccion-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    border-radius: 12px;
    color: #059669;
    font-size: 1.2rem;
}

.direccion-text {
    font-weight: 600;
    color: #1e293b;
}

.persona-cell {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.persona-name {
    font-weight: 500;
    color: #1e293b;
}

.persona-label {
    font-size: 0.75rem;
    color: #94a3b8;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-estado-pago {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 30px;
    font-weight: 600;
    font-size: 0.9rem;
}

.badge-pagado {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #059669;
}

.badge-no-pagado {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
}

.status-icon {
    font-size: 1.1rem;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state-icon {
    font-size: 4rem;
    color: #cbd5e1;
    margin-bottom: 20px;
}

.empty-state-text {
    color: #64748b;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .stats-row {
        flex-direction: column;
    }

    .stat-card {
        min-width: 100%;
    }

    .direccion-cell {
        flex-direction: column;
        align-items: flex-start;
    }
}
</style>

<div class="alquilados-container">
    <div class="page-header">
        <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
        <p class="page-subtitle">Control de pagos mensuales de alquileres</p>
        <div class="period-badge">
            <?= Html::encode($mesNombre) ?> <?= Html::encode($anio) ?>
        </div>
    </div>

    <?php
    $totalInmuebles = count($inmuebles);
    $pagados = 0;
    $noPagados = 0;
    foreach ($inmuebles as $inmueble) {
        $pago = Caja::find()
            ->where(['tipo_movimiento' => '0'])
            ->andWhere(['id_cliente' => $inmueble->inquilino])
            ->andWhere(['between', 'fecha', "$anio-$mes-01", "$anio-$mes-31"])
            ->one();
        if ($pago) {
            $pagados++;
        } else {
            $noPagados++;
        }
    }
    ?>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-number stat-number-total"><?= $totalInmuebles ?></div>
            <div class="stat-label">Total Inmuebles</div>
        </div>
        <div class="stat-card">
            <div class="stat-number stat-number-paid"><?= $pagados ?></div>
            <div class="stat-label">Pagados</div>
        </div>
        <div class="stat-card">
            <div class="stat-number stat-number-pending"><?= $noPagados ?></div>
            <div class="stat-label">Pendientes</div>
        </div>
    </div>

    <div class="table-container">
        <?php if (count($inmuebles) > 0): ?>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Inmueble</th>
                    <th>Propietario</th>
                    <th>Inquilino</th>
                    <th style="text-align: center;">Estado de Pago</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($inmuebles as $inmueble): ?>
                    <?php
                    $pago = Caja::find()
                        ->where(['tipo_movimiento' => '0'])
                        ->andWhere(['id_cliente' => $inmueble->inquilino])
                        ->andWhere(['between', 'fecha', "$anio-$mes-01", "$anio-$mes-31"])
                        ->one();

                    $estadoPago = $pago ? 'Pagado' : 'Pendiente';
                    $badgeClass = $pago ? 'badge-pagado' : 'badge-no-pagado';
                    $icon = $pago ? '&#10003;' : '&#10007;';
                    ?>
                    <tr>
                        <td>
                            <div class="direccion-cell">
                                <span class="direccion-icon">&#127968;</span>
                                <span class="direccion-text"><?= Html::encode($inmueble->direccion) ?></span>
                            </div>
                        </td>
                        <td>
                            <div class="persona-cell">
                                <span class="persona-name">
                                    <?= Html::encode($inmueble->dueno ? $inmueble->dueno0->nombres . ' ' . $inmueble->dueno0->apellidos : '-') ?>
                                </span>
                                <span class="persona-label">Propietario</span>
                            </div>
                        </td>
                        <td>
                            <div class="persona-cell">
                                <span class="persona-name">
                                    <?= Html::encode($inmueble->inquilino0 ? $inmueble->inquilino0->nombres . ' ' . $inmueble->inquilino0->apellidos : '-') ?>
                                </span>
                                <span class="persona-label">Inquilino</span>
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <span class="badge-estado-pago <?= $badgeClass ?>">
                                <span class="status-icon"><?= $icon ?></span>
                                <?= $estadoPago ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else: ?>
        <div class="empty-state">
            <div class="empty-state-icon">&#127968;</div>
            <p class="empty-state-text">No hay inmuebles alquilados en este momento</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php
use frontend\models\Caja;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\CajaSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<style>
.caja-index {
    padding: 20px 0;
}

.page-header {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    border-radius: 20px;
    padding: 30px;
    margin-bottom: 30px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
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

.header-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.btn-header {
    padding: 12px 24px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.95rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.btn-header:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

.btn-create {
    background: white;
    color: #d97706;
}

.btn-create:hover {
    color: #b45309;
    background: white;
}

.btn-resumen {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.5);
}

.btn-resumen:hover {
    background: rgba(255,255,255,0.3);
    color: white;
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
    padding: 16px 15px;
    font-weight: 600;
    color: #475569;
    text-transform: uppercase;
    font-size: 0.75rem;
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
    padding: 16px 15px;
    vertical-align: middle;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
}

.table-container .table tbody tr:last-child td {
    border-bottom: none;
}

.monto-cell {
    font-weight: 700;
    font-size: 1.05rem;
}

.badge-movimiento {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-ingreso {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #059669;
}

.badge-egreso {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
}

.badge-medio-pago {
    padding: 6px 12px;
    border-radius: 8px;
    font-size: 0.8rem;
    font-weight: 500;
    background: linear-gradient(135deg, #e0e7ff, #c7d2fe);
    color: #4338ca;
}

.cliente-name {
    font-weight: 500;
    color: #1e293b;
}

.fecha-cell {
    color: #64748b;
    font-size: 0.9rem;
}

.action-column a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 34px;
    height: 34px;
    border-radius: 8px;
    margin: 0 2px;
    transition: all 0.2s ease;
    text-decoration: none;
}

.action-column a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.filters input.form-control,
.filters select.form-control {
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    padding: 8px 12px;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.filters input.form-control:focus,
.filters select.form-control:focus {
    border-color: #f59e0b;
    box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
}

.pagination {
    margin-top: 20px;
    gap: 5px;
}

.pagination .page-link {
    border-radius: 8px;
    border: none;
    padding: 10px 16px;
    color: #64748b;
    background: #f1f5f9;
    transition: all 0.2s ease;
}

.pagination .page-link:hover {
    background: #f59e0b;
    color: white;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    color: white;
}

@media (max-width: 768px) {
    .page-header {
        flex-direction: column;
        text-align: center;
    }

    .header-actions {
        justify-content: center;
        width: 100%;
    }
}
</style>

<div class="caja-index">
    <div class="page-header">
        <div>
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle">Registro de movimientos financieros</p>
        </div>
        <div class="header-actions">
            <?= Html::a('Ver Resumen', ['caja/resumen'], ['class' => 'btn-header btn-resumen']) ?>
            <?= Html::a('+ Nuevo Movimiento', ['create'], ['class' => 'btn-header btn-create']) ?>
        </div>
    </div>

    <div class="table-container">
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-hover'],
            'filterRowOptions' => ['class' => 'filters'],
            'columns' => [
                [
                    'attribute' => 'monto',
                    'label' => 'Monto',
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'value' => function ($model) {
                        $color = $model->tipo_movimiento == 1 ? '#059669' : '#dc2626';
                        $prefix = $model->tipo_movimiento == 1 ? '+' : '-';
                        return '<span class="monto-cell" style="color: ' . $color . ';">' . $prefix . ' $' . number_format($model->monto, 2) . '</span>';
                    },
                ],
                [
                    'attribute' => 'fecha',
                    'label' => 'Fecha',
                    'headerOptions' => ['style' => 'width: 110px;'],
                    'contentOptions' => ['class' => 'fecha-cell'],
                ],
                [
                    'attribute' => 'fecha_referencia',
                    'label' => 'Ref.',
                    'headerOptions' => ['style' => 'width: 110px;'],
                    'contentOptions' => ['class' => 'fecha-cell'],
                ],
                [
                    'attribute' => 'tipo_movimiento',
                    'label' => 'Tipo',
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'width: 130px;'],
                    'value' => function ($model) {
                        $class = $model->tipo_movimiento == 1 ? 'badge-ingreso' : 'badge-egreso';
                        $text = $model->tipo_movimiento == 1 ? 'Ingreso' : 'Egreso';
                        return '<span class="badge-movimiento ' . $class . '">' . $text . '</span>';
                    },
                    'filter' => ['1' => 'Ingreso', '0' => 'Egreso'],
                ],
                [
                    'attribute' => 'medio_pago',
                    'label' => 'Medio de Pago',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $medio = $model->medioPagoRel ? $model->medioPagoRel->medio : 'No definido';
                        return '<span class="badge-medio-pago">' . Html::encode($medio) . '</span>';
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(\frontend\models\MedioPago::find()->all(), 'id', 'medio'),
                ],
                [
                    'attribute' => 'id_cliente',
                    'label' => 'Cliente',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->clienteRel) {
                            return '<span class="cliente-name">' . Html::encode($model->clienteRel->nombres . ' ' . $model->clienteRel->apellidos) . '</span>';
                        }
                        return '<span style="color: #94a3b8; font-style: italic;">Sin asignar</span>';
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(
                        \frontend\models\Cliente::find()->all(),
                        'id',
                        function ($cliente) {
                            return $cliente->nombres . ' ' . $cliente->apellidos;
                        }
                    ),
                ],
                [
                    'class' => ActionColumn::className(),
                    'headerOptions' => ['style' => 'width: 110px; text-align: center;'],
                    'contentOptions' => ['class' => 'action-column', 'style' => 'text-align: center;'],
                    'urlCreator' => function ($action, Caja $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

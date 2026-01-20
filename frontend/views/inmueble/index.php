<?php

use frontend\models\Inmueble;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\InmuebleSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Inmuebles');
?>

<style>
.inmueble-index {
    padding: 20px 0;
}

.page-header {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
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
    color: #7c3aed;
}

.btn-create:hover {
    color: #6d28d9;
    background: white;
}

.btn-alquilados {
    background: rgba(255,255,255,0.2);
    color: white;
    border: 2px solid rgba(255,255,255,0.5);
}

.btn-alquilados:hover {
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
    font-weight: 600;
    color: #1e293b;
}

.direccion-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #ede9fe, #ddd6fe);
    border-radius: 10px;
    margin-right: 12px;
    color: #7c3aed;
    font-size: 1.1rem;
}

.detalles-cell {
    color: #64748b;
    font-size: 0.9rem;
    max-width: 250px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

.dueno-cell {
    font-weight: 500;
    color: #475569;
}

.badge-estado {
    padding: 8px 16px;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-disponible {
    background: linear-gradient(135deg, #d1fae5, #a7f3d0);
    color: #059669;
}

.badge-alquilado {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1d4ed8;
}

.badge-vendido {
    background: linear-gradient(135deg, #fef3c7, #fde68a);
    color: #b45309;
}

.badge-mantenimiento {
    background: linear-gradient(135deg, #fee2e2, #fecaca);
    color: #dc2626;
}

.action-column a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    margin: 0 3px;
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
    padding: 10px 15px;
    transition: all 0.2s ease;
}

.filters input.form-control:focus,
.filters select.form-control:focus {
    border-color: #8b5cf6;
    box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.1);
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
    background: #8b5cf6;
    color: white;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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

    .detalles-cell {
        max-width: 150px;
    }
}
</style>

<div class="inmueble-index">
    <div class="page-header">
        <div>
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle">Administra tu cartera de propiedades</p>
        </div>
        <div class="header-actions">
            <?= Html::a('Ver Alquilados', ['alquilados'], ['class' => 'btn-header btn-alquilados']) ?>
            <?= Html::a('+ Nuevo Inmueble', ['create'], ['class' => 'btn-header btn-create']) ?>
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
                    'attribute' => 'direccion',
                    'label' => 'Direccion',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<div style="display: flex; align-items: center;">
                                    <span class="direccion-icon">&#127968;</span>
                                    <span class="direccion-cell">' . Html::encode($model->direccion) . '</span>
                                </div>';
                    },
                ],
                [
                    'attribute' => 'detalles',
                    'label' => 'Detalles',
                    'format' => 'raw',
                    'value' => function ($model) {
                        return '<span class="detalles-cell" title="' . Html::encode($model->detalles) . '">' . Html::encode($model->detalles) . '</span>';
                    },
                ],
                [
                    'attribute' => 'dueno',
                    'label' => 'Propietario',
                    'format' => 'raw',
                    'value' => function ($model) {
                        if ($model->dueno0) {
                            return '<span class="dueno-cell">' . Html::encode($model->dueno0->nombres . ' ' . $model->dueno0->apellidos) . '</span>';
                        }
                        return '<span style="color: #94a3b8; font-style: italic;">Sin asignar</span>';
                    },
                ],
                [
                    'attribute' => 'estado',
                    'label' => 'Estado',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $estado = strtolower($model->estado);
                        $class = 'badge-estado ';
                        if (strpos($estado, 'disponible') !== false) {
                            $class .= 'badge-disponible';
                        } elseif (strpos($estado, 'alquilado') !== false || strpos($estado, 'alquilada') !== false) {
                            $class .= 'badge-alquilado';
                        } elseif (strpos($estado, 'vendido') !== false || strpos($estado, 'vendida') !== false) {
                            $class .= 'badge-vendido';
                        } else {
                            $class .= 'badge-mantenimiento';
                        }
                        return '<span class="' . $class . '">' . Html::encode($model->estado) . '</span>';
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'contentOptions' => ['class' => 'action-column', 'style' => 'white-space: nowrap;'],
                    'urlCreator' => function ($action, Inmueble $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

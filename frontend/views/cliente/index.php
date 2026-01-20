<?php

use frontend\models\Cliente;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var frontend\models\ClienteSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>

<style>
.cliente-index {
    padding: 20px 0;
}

.page-header {
    background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
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

.btn-create {
    background: white;
    color: #0284c7;
    padding: 12px 28px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.btn-create:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    color: #0369a1;
    background: white;
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
    transform: scale(1.01);
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

.table-container .table .action-column a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 36px;
    height: 36px;
    border-radius: 8px;
    margin: 0 3px;
    transition: all 0.2s ease;
}

.table-container .table .action-column a[title="View"],
.table-container .table .action-column a[data-method="post"][title="View"] {
    background: #e0f2fe;
    color: #0284c7;
}

.table-container .table .action-column a[title="Update"] {
    background: #fef3c7;
    color: #d97706;
}

.table-container .table .action-column a[title="Delete"] {
    background: #fee2e2;
    color: #dc2626;
}

.table-container .table .action-column a:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.filters input.form-control {
    border-radius: 10px;
    border: 2px solid #e2e8f0;
    padding: 10px 15px;
    transition: all 0.2s ease;
}

.filters input.form-control:focus {
    border-color: #0ea5e9;
    box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
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
    background: #0ea5e9;
    color: white;
}

.pagination .page-item.active .page-link {
    background: linear-gradient(135deg, #0ea5e9, #0284c7);
    color: white;
}

.badge-tipo {
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 500;
}

.badge-inquilino {
    background: linear-gradient(135deg, #dbeafe, #bfdbfe);
    color: #1d4ed8;
}

.badge-propietario {
    background: linear-gradient(135deg, #dcfce7, #bbf7d0);
    color: #15803d;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #94a3b8;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 20px;
}
</style>

<div class="cliente-index">
    <div class="page-header">
        <div>
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <p class="page-subtitle">Gestiona tus clientes, propietarios e inquilinos</p>
        </div>
        <?= Html::a('+ Nuevo Cliente', ['create'], ['class' => 'btn-create']) ?>
    </div>

    <div class="table-container">
        <?php Pjax::begin(); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-hover'],
            'options' => ['class' => 'grid-view'],
            'rowOptions' => ['class' => 'table-row'],
            'columns' => [
                [
                    'attribute' => 'nombres',
                    'label' => 'Nombre',
                    'contentOptions' => ['style' => 'font-weight: 600; color: #1e293b;'],
                ],
                [
                    'attribute' => 'apellidos',
                    'label' => 'Apellido',
                    'contentOptions' => ['style' => 'color: #475569;'],
                ],
                [
                    'attribute' => 'tipo',
                    'label' => 'Tipo',
                    'format' => 'raw',
                    'value' => function ($model) {
                        $tipo = strtolower($model->tipo);
                        $class = 'badge-tipo ';
                        if (strpos($tipo, 'inquilino') !== false) {
                            $class .= 'badge-inquilino';
                        } else {
                            $class .= 'badge-propietario';
                        }
                        return '<span class="' . $class . '">' . Html::encode($model->tipo) . '</span>';
                    },
                ],
                [
                    'class' => ActionColumn::className(),
                    'contentOptions' => ['class' => 'action-column', 'style' => 'white-space: nowrap;'],
                    'urlCreator' => function ($action, Cliente $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>

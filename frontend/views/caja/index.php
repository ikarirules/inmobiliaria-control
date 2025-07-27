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

// Registrar CSS personalizado
$this->registerCss('
    .caja-index {
        padding: 1rem 0;
    }
    
    .container-modern {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.1);
    }
    
    .title-modern {
        color: #2d3748;
        font-weight: 700;
        font-size: 2.2rem;
        margin-bottom: 1rem;
        text-align: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .btn-create-modern {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        border: none;
        border-radius: 50px;
        padding: 12px 30px;
        color: white;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 8px 15px rgba(79, 172, 254, 0.3);
    }
    
    .btn-create-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 25px rgba(79, 172, 254, 0.4);
        color: white;
        text-decoration: none;
    }
    
    .grid-view {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background: white;
    }
    
    .grid-view table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .grid-view th {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-weight: 600;
        padding: 18px 15px;
        text-align: left;
        border: none;
        font-size: 0.95rem;
        letter-spacing: 0.5px;
    }
    
    .grid-view th:first-child {
        border-top-left-radius: 15px;
    }
    
    .grid-view th:last-child {
        border-top-right-radius: 15px;
    }
    
    .grid-view td {
        padding: 16px 15px;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
        font-size: 0.9rem;
        color: #4a5568;
    }
    
    /* Efecto cebra mejorado */
    .grid-view tbody tr:nth-child(even) {
        background: linear-gradient(90deg, #f8fafc 0%, #f1f5f9 100%);
    }
    
    .grid-view tbody tr:nth-child(odd) {
        background: white;
    }
    
    .grid-view tbody tr:hover {
        background: linear-gradient(90deg, #e2e8f0 0%, #cbd5e0 100%);
        transform: scale(1.01);
        transition: all 0.2s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    
    /* Filtros modernos */
    .grid-view .filters input,
    .grid-view .filters select {
        border: 2px solid #e2e8f0;
        border-radius: 10px;
        padding: 8px 12px;
        background: white;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }
    
    .grid-view .filters input:focus,
    .grid-view .filters select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        outline: none;
    }
    
    /* Botones de acción modernos */
    .grid-view .action-column a {
        display: inline-block;
        padding: 8px 12px;
        margin: 0 2px;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }
    
    .grid-view .action-column a[title*="View"] {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        color: white;
    }
    
    .grid-view .action-column a[title*="Update"] {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        color: white;
    }
    
    .grid-view .action-column a[title*="Delete"] {
        background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        color: white;
    }
    
    .grid-view .action-column a:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }
    
    /* Paginación moderna */
    .pagination {
        justify-content: center;
        margin-top: 2rem;
    }
    
    .pagination .page-link {
        border: none;
        border-radius: 10px;
        margin: 0 3px;
        padding: 10px 15px;
        color: #667eea;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.2s ease;
    }
    
    .pagination .page-link:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        transform: translateY(-1px);
    }
    
    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: #667eea;
    }
    
    /* Responsivo */
    @media (max-width: 768px) {
        .container-modern {
            margin: 1rem;
            padding: 1rem;
        }
        
        .title-modern {
            font-size: 2rem;
        }
        
        .grid-view {
            overflow-x: auto;
        }
        
        .grid-view td,
        .grid-view th {
            padding: 12px 8px;
            font-size: 0.85rem;
        }
    }
');
?>

<div class="caja-index">
    <div class="container-modern">
        <h1 class="title-modern"><?= Html::encode($this->title) ?></h1>
        
        <div class="text-center">
            <?= Html::a(
                '<i class="fas fa-plus-circle"></i> ' . Yii::t('app', 'Create Caja'), 
                ['create'], 
                ['class' => 'btn-create-modern']
            ) ?>
        </div>
        
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-hover'],
            'options' => ['class' => 'grid-view-wrapper'],
            'columns' => [
                [
                    'attribute' => 'monto',
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'contentOptions' => ['style' => 'font-weight: 500;'],
                ],
                [
                    'attribute' => 'fecha',
                    'headerOptions' => ['style' => 'width: 120px;'],
                    'contentOptions' => ['style' => 'font-weight: 500;'],
                ],
                [
                    'attribute' => 'fecha_referencia',
                    'headerOptions' => ['style' => 'width: 140px;'],
                    'contentOptions' => ['style' => 'color: #6b7280;'],
                ],
                [
                    'attribute' => 'tipo_movimiento',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'contentOptions' => function($model) {
                        $class = $model->tipo_movimiento == 'Ingreso' ? 'color: #10b981; font-weight: 600;' : 'color: #ef4444; font-weight: 600;';
                        return ['style' => $class];
                    },
                ],
                [
                    'attribute' => 'medio_pago',
                    'value' => function ($model) {
                        return $model->medioPagoRel ? $model->medioPagoRel->medio : '(no definido)';
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(\frontend\models\MedioPago::find()->all(), 'id', 'medio'),
                    'contentOptions' => ['style' => 'font-style: italic; color: #black;'],
                ],
                [
                    'attribute' => 'id_cliente',
                    'value' => function ($model) {
                        return $model->clienteRel
                            ? $model->clienteRel->nombres . ' ' . $model->clienteRel->apellidos
                            : '(no definido)';
                    },
                    'filter' => \yii\helpers\ArrayHelper::map(
                        \frontend\models\Cliente::find()->all(),
                        'id',
                        function ($cliente) {
                            return $cliente->nombres . ' ' . $cliente->apellidos;
                        }
                    ),
                    'contentOptions' => ['style' => 'font-style: italic; color: black;'],
                ],

                [
                    'class' => ActionColumn::className(),
                    'headerOptions' => ['style' => 'width: 120px; text-align: center;'],
                    'contentOptions' => ['style' => 'text-align: center;'],
                    'urlCreator' => function ($action, Caja $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>
        
        <?php Pjax::end(); ?>
    </div>
</div>
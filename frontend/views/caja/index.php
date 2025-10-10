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
                    'label' => 'Tipo de Movimiento',
                    'headerOptions' => ['style' => 'width: 150px;'],
                    'value' => function ($model) {
                        return $model->tipo_movimiento == 1 ? 'Ingreso' : 'Egreso';
                    },
                    'contentOptions' => function ($model) {
                        $color = $model->tipo_movimiento == 1 ? '#10b981' : '#ef4444';
                        return ['style' => "color: $color; font-weight: 600;"];
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
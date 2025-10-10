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
<div class="inmueble-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Inmueble'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'direccion',
            'detalles:ntext',
            [
                'attribute' => 'dueno',
                'label' => 'Dueño',
                'value' => function ($model) {
                    return $model->dueno0
                        ? $model->dueno0->nombres . ' ' . $model->dueno0->apellidos
                        : '-';
                },
            ],

            'estado',
            //'inquilino',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Inmueble $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

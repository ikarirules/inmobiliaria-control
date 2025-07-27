<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Caja $model */

if ($model->tipo_movimiento == 0) {
    $this->title = Yii::t('app', 'Ingreso Caja');
}

if ($model->tipo_movimiento == 1) {
    $this->title = Yii::t('app', 'Salida de Caja');
}

// $this->title = Yii::t('app', ' Caja');
?>
<div class="caja-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categorias' => $categorias,
        'medios' => $medios
    ]) ?>

</div>

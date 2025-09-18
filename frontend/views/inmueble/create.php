<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Inmueble $model */

$this->title = Yii::t('app', 'Create Inmueble');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inmuebles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inmueble-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

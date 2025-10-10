<?php
use yii\helpers\Html;
use frontend\models\Caja;

/** @var yii\web\View $this */
/** @var app\models\Inmueble[] $inmuebles */
/** @var string $mes */
/** @var string $anio */

$this->title = 'Inmuebles Alquilados';
?>
<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Dirección</th>
            <th>Dueño</th>
            <th>Inquilino</th>
            <th>Estado de pago (<?= $mes ?>/<?= $anio ?>)</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($inmuebles as $inmueble): ?>
            <?php
            // Buscamos si hay un ingreso en la caja este mes para este inquilino
            $pago = Caja::find()
                ->where(['tipo_movimiento' => '1'])
                ->andWhere(['id_cliente' => $inmueble->inquilino])
                ->andWhere(['between', 'fecha', "$anio-$mes-01", "$anio-$mes-31"])
                ->one();

            $estadoPago = $pago ? '✅ Pagado' : '❌ No pagado';
            $color = $pago ? 'green' : 'red';
            ?>
            <tr>
                <td><?= Html::encode($inmueble->direccion) ?></td>
                <td><?= Html::encode($inmueble->dueno ? $inmueble->dueno0->nombres . ' ' . $inmueble->dueno0->apellidos : '-') ?></td>
                <td><?= Html::encode($inmueble->inquilino0 ? $inmueble->inquilino0->nombres . ' ' . $inmueble->inquilino0->apellidos : '-') ?></td>

                <td style="color: <?= $color ?>; font-weight: bold;"><?= $estadoPago ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

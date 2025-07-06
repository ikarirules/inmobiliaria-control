<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "caja".
 *
 * @property int $id
 * @property string $fecha
 * @property string|null $fecha_referencia
 * @property int $tipo_movimiento
 * @property int|null $medio_pago
 * @property float $monto
 * @property int|null $id_categoria
 * @property int|null $id_cliente
 * @property string|null $detalle
 * @property string|null $created_at
 * @property string|null $updated_at
 */
class Caja extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamps' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                // Usar una expresión SQL para que sea la hora del servidor MySQL:
                'value' => new \yii\db\Expression('NOW()'),
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'caja';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fecha_referencia', 'medio_pago', 'id_categoria', 'id_cliente', 'detalle'], 'default', 'value' => null],
            [['fecha', 'tipo_movimiento', 'monto'], 'required'],
            [['fecha', 'fecha_referencia', 'created_at', 'updated_at'], 'safe'],
            [['tipo_movimiento', 'medio_pago', 'id_categoria', 'id_cliente'], 'integer'],
            [['monto'], 'number'],
            [['detalle'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fecha' => Yii::t('app', 'Fecha actual'),
            'fecha_referencia' => Yii::t('app', 'Fecha Referencia'),
            'tipo_movimiento' => Yii::t('app', 'Tipo Movimiento(0=ingreso , 1=egreso)'),
            'medio_pago' => Yii::t('app', 'Medio Pago'),
            'monto' => Yii::t('app', 'Monto'),
            'id_categoria' => Yii::t('app', 'Id Categoria'),
            'id_cliente' => Yii::t('app', 'Id Cliente'),
            'detalle' => Yii::t('app', 'Detalle'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

}

<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "medio_pago".
 *
 * @property int $id
 * @property string $medio
 * @property string|null $detalle
 */
class MedioPago extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'medio_pago';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detalle'], 'default', 'value' => null],
            [['medio'], 'required'],
            [['detalle'], 'string'],
            [['medio'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'medio' => Yii::t('app', 'Medio'),
            'detalle' => Yii::t('app', 'Detalle'),
        ];
    }

    public static function listaMedios()
    {
        return self::find()
            ->select(['medio'])
            ->indexBy('id')
            ->column();
    }

}

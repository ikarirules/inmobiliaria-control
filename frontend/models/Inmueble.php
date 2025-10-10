<?php
namespace frontend\models;

use Yii;

/**
 * This is the model class for table "inmueble".
 *
 * @property int $id
 * @property string $direccion
 * @property string|null $detalles
 * @property int $dueno
 * @property string $estado
 * @property int|null $inquilino
 */
class Inmueble extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const ESTADO_ALQUILADA = 'alquilada';
    const ESTADO_NO_ALQUILADA = 'no alquilada';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'inmueble';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['detalles', 'inquilino'], 'default', 'value' => null],
            [['estado'], 'default', 'value' => 'no alquilada'],
            [['direccion', 'dueno'], 'required'],
            [['detalles', 'estado'], 'string'],
            [['dueno', 'inquilino'], 'integer'],
            [['direccion'], 'string', 'max' => 255],
            ['estado', 'in', 'range' => array_keys(self::optsEstado())],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'direccion' => Yii::t('app', 'Direccion'),
            'detalles' => Yii::t('app', 'Detalles'),
            'dueno' => Yii::t('app', 'Dueño'),
            'estado' => Yii::t('app', 'Estado'),
            'inquilino' => Yii::t('app', 'Inquilino'),
        ];
    }


    /**
     * column estado ENUM value labels
     * @return string[]
     */
    public static function optsEstado()
    {
        return [
            self::ESTADO_ALQUILADA => Yii::t('app', 'alquilada'),
            self::ESTADO_NO_ALQUILADA => Yii::t('app', 'no alquilada'),
        ];
    }

    /**
     * @return string
     */
    public function displayEstado()
    {
        return self::optsEstado()[$this->estado];
    }

    /**
     * @return bool
     */
    public function isEstadoAlquilada()
    {
        return $this->estado === self::ESTADO_ALQUILADA;
    }

    public function setEstadoToAlquilada()
    {
        $this->estado = self::ESTADO_ALQUILADA;
    }

    /**
     * @return bool
     */
    public function isEstadoNoAlquilada()
    {
        return $this->estado === self::ESTADO_NO_ALQUILADA;
    }

    public function setEstadoToNoAlquilada()
    {
        $this->estado = self::ESTADO_NO_ALQUILADA;
    }

    public function getDueno0()
    {
        return $this->hasOne(Cliente::class, ['id' => 'dueno']);
    }

    public function getInquilino0()
    {
        return $this->hasOne(Cliente::class, ['id' => 'inquilino']);
    }
}

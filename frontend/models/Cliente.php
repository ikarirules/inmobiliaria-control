<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nombres
 * @property string $apellidos
 * @property string|null $telefono1
 * @property string|null $telefono2
 * @property string|null $email
 * @property string|null $direccion
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property string $tipo

 */
class Cliente extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'), // O usa time() si querés timestamp UNIX
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono1', 'telefono2', 'email', 'direccion'], 'default', 'value' => null],
            [['nombres', 'apellidos'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombres', 'apellidos'], 'string', 'max' => 100],
            [['telefono1', 'telefono2'], 'string', 'max' => 20],
            [['email'], 'string', 'max' => 150],
            [['direccion'], 'string', 'max' => 255],
            ['tipo', 'in', 'range' => ['inquilino', 'propietario', 'otro']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombres' => Yii::t('app', 'Nombres'),
            'apellidos' => Yii::t('app', 'Apellidos'),
            'telefono1' => Yii::t('app', 'Telefono1'),
            'telefono2' => Yii::t('app', 'Telefono2'),
            'email' => Yii::t('app', 'Email'),
            'direccion' => Yii::t('app', 'Direccion'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_at' => Yii::t('app', 'Creado el'),
            'updated_at' => Yii::t('app', 'Actualizado el'),
            'tipo' => Yii::t('app', 'Tipo de cliente'),

        ];
    }

}

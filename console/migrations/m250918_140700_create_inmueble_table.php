<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%inmueble}}`.
 */
class m250918_140700_create_inmueble_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%inmueble}}', [
            'id' => $this->primaryKey(),
            'direccion' => $this->string(255)->notNull(),
            'detalles' => $this->text(),
            'dueno' => $this->integer()->notNull(),
            'estado' => "ENUM('alquilada','no alquilada') NOT NULL DEFAULT 'no alquilada'",
            'inquilino' => $this->integer()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%inmueble}}');
    }
}

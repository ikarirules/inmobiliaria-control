<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%caja}}`.
 */
class m250622_194315_create_caja_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%caja}}', [
            'id' => $this->primaryKey(),
            'fecha' => $this->date()->notNull(),
            'fecha_referencia' => $this->date()->null(),
            'tipo_movimiento' => $this->integer()->notNull(),
            'medio_pago' => $this->integer()->null(),
            'monto' => $this->decimal(10, 2)->notNull(),
            'id_categoria' => $this->integer(),
            'id_cliente' => $this->integer(),
            'detalle' => $this->text()->null(),
            'created_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')->append('ON UPDATE CURRENT_TIMESTAMP'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%caja}}');
    }
}

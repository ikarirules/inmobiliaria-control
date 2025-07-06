<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%medio_pago}}`.
 */
class m250622_201101_create_medio_pago_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%medio_pago}}', [
            'id' => $this->primaryKey(),
            'medio' => $this->string(100)->notNull(),
            'detalle' => $this->text()->null(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%medio_pago}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%cliente}}`.
 */
class m250713_194251_add_tipo_column_to_cliente_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
            ALTER TABLE cliente 
            ADD COLUMN tipo ENUM('inquilino', 'propietario', 'otro') 
        ");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }
}

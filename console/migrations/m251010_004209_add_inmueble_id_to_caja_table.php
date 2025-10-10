<?php

use yii\db\Migration;

class m251010_004209_add_inmueble_id_to_caja_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%caja}}', 'inmueble_id', $this->integer()->null()->after('id'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m251010_004209_add_inmueble_id_to_caja_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m251010_004209_add_inmueble_id_to_caja_table cannot be reverted.\n";

        return false;
    }
    */
}

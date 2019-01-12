<?php

use yii\db\Migration;

/**
 * Class m190112_072040_alter_skp
 */
class m190112_072040_alter_skp extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_mt_spt', 'id_kota2', $this->integer());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190112_072040_alter_skp cannot be reverted.\n";

        return false;
    }
    */
}

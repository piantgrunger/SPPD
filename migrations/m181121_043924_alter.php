<?php

use yii\db\Migration;

/**
 * Class m181121_043924_alter.
 */
class m181121_043924_alter extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_mt_spt', 'tgl_surat', $this->date()->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_043924_alter cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_043924_alter cannot be reverted.\n";

        return false;
    }
    */
}

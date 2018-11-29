<?php

use yii\db\Migration;

/**
 * Class m181129_082305_alterkeg.
 */
class m181129_082305_alterkeg extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_kegiatan', 'nama_kegiatan', $this->string(200)->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181129_082305_alterkeg cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181129_082305_alterkeg cannot be reverted.\n";

        return false;
    }
    */
}

<?php

use yii\db\Migration;

/**
 * Class m181112_053759_alter_spt.
 */
class m181112_053759_alter_spt extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_mt_spt', 'dasar', $this->string(300));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181112_053759_alter_spt cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_053759_alter_spt cannot be reverted.\n";

        return false;
    }
    */
}

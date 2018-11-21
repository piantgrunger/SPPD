<?php

use yii\db\Migration;

/**
 * Class m181121_102758_alteralkelengkapan.
 */
class m181121_102758_alteralkelengkapan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('tb_m_alat_kelengkapan', 'alat_kelengkapan', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_102758_alteralkelengkapan cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_102758_alteralkelengkapan cannot be reverted.\n";

        return false;
    }
    */
}

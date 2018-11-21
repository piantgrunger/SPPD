<?php

use yii\db\Migration;

/**
 * Class m181121_053747_addPersonil.
 */
class m181121_053747_addPersonil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_personil', 'jabatan', $this->string(100));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181121_053747_addPersonil cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181121_053747_addPersonil cannot be reverted.\n";

        return false;
    }
    */
}

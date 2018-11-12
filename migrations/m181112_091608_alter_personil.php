<?php

use yii\db\Migration;

/**
 * Class m181112_091608_alter_personil.
 */
class m181112_091608_alter_personil extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('tb_m_personil', 'status', $this->string('20')->defaultValue('Aktif')->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181112_091608_alter_personil cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_091608_alter_personil cannot be reverted.\n";

        return false;
    }
    */
}

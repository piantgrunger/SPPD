<?php

use yii\db\Migration;

/**
 * Class m181112_223851_kendaraan
 */
class m181112_223851_kendaraan extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('tb_m_kendaraan', [
            'id_kendaraan' =>$this->primaryKey(),
            'nama_kendaraan' => $this->string(100)->notNull()->unique()
        ]);

        $this->insert('tb_m_kendaraan', ['nama_kendaraan' => 'KENDARAAN UMUM']);
        $this->insert('tb_m_kendaraan', ['nama_kendaraan' => 'KENDARAAN PRIBADI']);
        $this->insert('tb_m_kendaraan', ['nama_kendaraan' => 'KENDARAAN DINAS']);
        $this->insert('tb_m_kendaraan', ['nama_kendaraan' => 'KERETA API']);
        $this->insert('tb_m_kendaraan', ['nama_kendaraan' => 'PESAWAT TERBANG']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('tb_m_kendaraan');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_223851_kendaraan cannot be reverted.\n";

        return false;
    }
    */
}

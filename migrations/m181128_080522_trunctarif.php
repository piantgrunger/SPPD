<?php

use yii\db\Migration;
use League\Csv\Reader;

/**
 * Class m181128_080522_trunctarif.
 */
class m181128_080522_trunctarif extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->truncateTable('tb_m_tarif');
        $source = Yii::getAlias('@app/migrations/tb_m_tarif.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);

        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
            array_push(
                    $Rows,
                    [
                          $row[1],
                          $row[2],
                          $row[3],
                         (float) $row[4],
                    ]
                );
        }

        $this->batchInsert('tb_m_tarif', ['id_pangkat', 'tujuan', 'nama_biaya', 'biaya'], $Rows);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m181128_080522_trunctarif cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181128_080522_trunctarif cannot be reverted.\n";

        return false;
    }
    */
}

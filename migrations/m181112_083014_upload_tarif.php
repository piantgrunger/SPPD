<?php

use yii\db\Migration;
use League\Csv\Reader;
use app\models\Pangkat;

/**
 * Class m181112_083014_upload_tarif.
 */
class m181112_083014_upload_tarif extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $source = Yii::getAlias('@app/migrations/tarif.csv');
        // baca file csv menggunakan library league\csv
        $reader = Reader::createFromPath($source);

        // insert data provinsi kedalam tabel provinsi
        //cek max_allowed_packet di my.ini
        $Rows = array();
        foreach ($reader as $index => $row) {
            $pangkat = Pangkat::find()->where("nama_pangkat='$row[3]'")->one();
            array_push(
                    $Rows,
                    [
                          $pangkat->id_pangkat,
                          $row[9],
                          $row[2],
                          $row[4],
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
        echo "m181112_083014_upload_tarif cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m181112_083014_upload_tarif cannot be reverted.\n";

        return false;
    }
    */
}

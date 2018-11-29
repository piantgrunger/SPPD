<?php

use yii\db\Migration;

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
        $this->execute("
        INSERT INTO tb_m_tarif (id_tarif, id_pangkat, tujuan, nama_biaya, biaya) VALUES
        (1, 13, 'Di Dalam Kabupaten Sidoarjo', 'Uang Harian', '350000.00'),
        (2, 13, 'Di Dalam Kabupaten Sidoarjo', 'Uang Representasi', '200000.00'),
        (3, 13, 'Di Dalam Kabupaten Sidoarjo', 'Uang Transportasi', '0.00'),
        (4, 13, 'Di Dalam Kabupaten Sidoarjo', 'Uang Penginapan', '0.00'),
        (5, 13, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Harian', '1500000.00'),
        (14, 13, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Representasi', '200000.00'),
        (15, 13, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Transportasi', '0.00'),
        (16, 13, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Penginapan', '0.00'),
        (17, 13, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Harian', '2000000.00'),
        (18, 13, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Representasi', '200000.00'),
        (19, 13, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Transportasi', '0.00'),
        (20, 13, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Penginapan', '0.00'),
        (21, 13, 'Luar Propinsi Jawa Timur', 'Uang Harian', '3000000.00'),
        (22, 13, 'Luar Propinsi Jawa Timur', 'Uang Representasi', '200000.00'),
        (23, 13, 'Luar Propinsi Jawa Timur', 'Uang Transportasi', '0.00'),
        (24, 13, 'Luar Propinsi Jawa Timur', 'Uang Penginapan', '0.00'),
        (25, 14, 'Di Dalam Kabupaten Sidoarjo', 'Uang Harian', '300000.00'),
        (26, 14, 'Di Dalam Kabupaten Sidoarjo', 'Uang Representasi', '200000.00'),
        (27, 14, 'Di Dalam Kabupaten Sidoarjo', 'Uang Transportasi', '0.00'),
        (28, 14, 'Di Dalam Kabupaten Sidoarjo', 'Uang Penginapan', '0.00'),
        (29, 14, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Harian', '1400000.00'),
        (30, 14, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Representasi', '200000.00'),
        (31, 14, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Transportasi', '0.00'),
        (32, 14, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Penginapan', '0.00'),
        (33, 14, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Harian', '1800000.00'),
        (34, 14, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Representasi', '200000.00'),
        (35, 14, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Transportasi', '0.00'),
        (36, 14, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Penginapan', '0.00'),
        (37, 14, 'Luar Propinsi Jawa Timur', 'Uang Harian', '2800000.00'),
        (38, 14, 'Luar Propinsi Jawa Timur', 'Uang Representasi', '200000.00'),
        (39, 14, 'Luar Propinsi Jawa Timur', 'Uang Transportasi', '0.00'),
        (40, 14, 'Luar Propinsi Jawa Timur', 'Uang Penginapan', '0.00'),
        (41, 15, 'Di Dalam Kabupaten Sidoarjo', 'Uang Harian', '200000.00'),
        (42, 15, 'Di Dalam Kabupaten Sidoarjo', 'Uang Representasi', '150000.00'),
        (43, 15, 'Di Dalam Kabupaten Sidoarjo', 'Uang Transportasi', '0.00'),
        (44, 15, 'Di Dalam Kabupaten Sidoarjo', 'Uang Penginapan', '0.00'),
        (45, 15, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Harian', '1300000.00'),
        (46, 15, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Representasi', '150000.00'),
        (47, 15, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Transportasi', '0.00'),
        (48, 15, 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]', 'Uang Penginapan', '0.00'),
        (49, 15, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Harian', '1600000.00'),
        (50, 15, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Representasi', '150000.00'),
        (51, 15, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Transportasi', '0.00'),
        (52, 15, 'Luar Kabupaten Sidoarjo di luar zona 1', 'Uang Penginapan', '0.00'),
        (53, 15, 'Luar Propinsi Jawa Timur', 'Uang Harian', '2600000.00'),
        (54, 15, 'Luar Propinsi Jawa Timur', 'Uang Representasi', '150000.00'),
        (55, 15, 'Luar Propinsi Jawa Timur', 'Uang Transportasi', '0.00'),
        (56, 15, 'Luar Propinsi Jawa Timur', 'Uang Penginapan', '0.00');
        ");
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
        echo "m181128_080522_trunctarif cannot be reverted.\n";

        return false;
    }
    */
}

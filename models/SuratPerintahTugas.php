<?php

namespace app\models;

use Yii;
use mdm\behaviors\ar\RelationTrait;

/**
 * This is the model class for table "tb_mt_spt".
 *
 * @property int                   $id_spt
 * @property string                $no_spt
 * @property string                $tgl_surat
 * @property int                   $id_alat_kelengkapan
 * @property string                $untuk
 * @property string                $tujuan
 * @property string                $zona
 * @property string                $tgl_awal
 * @property string                $tgl_akhir
 * @property string                $penanda_tangan
 * @property TbMSuratPerintahTugas $SuratPerintahTugas
 */
class SuratPerintahTugas extends \yii\db\ActiveRecord
{
    use RelationTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_mt_spt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_spt', 'tgl_surat', 'untuk', 'tujuan', 'zona', 'tgl_awal', 'dasar', 'jenis', 'tgl_akhir'], 'required'],
            [['kendaraan', 'id_kegiatan', 'id_kota'], 'safe'],
            [['id_alat_kelengkapan'], 'integer'],
            [['untuk', 'tujuan', 'dasar', 'jenis'], 'string'],
            [['no_spt'], 'string', 'max' => 50],
            [['zona', 'penanda_tangan'], 'string', 'max' => 100],
         [['id_alat_kelengkapan'], 'exist', 'skipOnError' => true, 'targetClass' => AlatKelengkapan::className(), 'targetAttribute' => ['id_alat_kelengkapan' => 'id_alat_kelengkapan']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_spt' => Yii::t('app', 'Id Spt'),
            'no_spt' => Yii::t('app', 'No Spt'),
            'tgl_surat' => Yii::t('app', 'Tgl Surat'),
            'id_alat_kelengkapan' => Yii::t('app', 'Alat Kelengkapan'),
            'untuk' => Yii::t('app', 'Untuk'),
            'tujuan' => Yii::t('app', 'Tujuan'),
            'zona' => Yii::t('app', 'Zona'),
            'tgl_awal' => Yii::t('app', 'Tgl Awal'),
            'tgl_akhir' => Yii::t('app', 'Tgl Akhir'),
            'penanda_tangan' => Yii::t('app', 'Penanda Tangan'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlatKelengkapan()
    {
        return $this->hasOne(AlatKelengkapan::className(), ['id_alat_kelengkapan' => 'id_alat_kelengkapan']);
    }

    public function getKota()
    {
        return $this->hasOne(Kota::className(), ['id_kota' => 'id_kota']);
    }

    public function getKegiatan()
    {
        return $this->hasOne(Kegiatan::className(), ['id_kegiatan' => 'id_kegiatan']);
    }

    public function getNama_alat_kelengkapan()
    {
        return is_null($this->alatKelengkapan) ? '' : $this->alatKelengkapan->alat_kelengkapan;
    }

    public function getNama_kota()
    {
        return is_null($this->kota) ? '' : $this->kota->nama_kota;
    }

    public function getNama_kegiatan()
    {
        return is_null($this->kegiatan) ? '' : $this->kegiatan->nama_kegiatan;
    }

    public function getRekening()
    {
        return is_null($this->kegiatan) ? '' : $this->kegiatan->Rekening;
    }

    public function getSelisih()
    {
        //   return date_diff(date_create($this->tgl_akhir), date_create($this->tgl_awal));
        $date = new \DateTime($this->tgl_awal);
        $date2 = new \DateTime($this->tgl_akhir);

        return $date->diff($date2)->d + 1;
    }

    public function getDetailSuratPerintahTugas()
    {
        return $this->hasMany(DetSuratPerintahTugas::className(), ['id_spt' => 'id_spt'])
        ->orderBy([new \yii\db\Expression('FIELD (jenis, "Ketua DPRD", "Wakil Ketua DPRD", "Ketua","Wakil Ketua","Sekretaris","Anggota","Staff")')]);
    }

    public function setDetailSuratPerintahTugas($value)
    {
        return $this->loadRelated('detailSuratPerintahTugas', $value);
    }
}

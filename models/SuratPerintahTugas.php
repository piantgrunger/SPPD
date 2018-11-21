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
    public function tanggal_indo($tanggal, $cetak_hari = false)
    {
        $hari = array(
            1 => 'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu',
        );

        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        $split = explode('-', $tanggal);
        $tgl_indo = $split[2].' '.$bulan[(int) $split[1]].' '.$split[0];

        if ($cetak_hari) {
            $num = date('N', strtotime($tanggal));

            return $hari[$num].', '.$tgl_indo;
        }

        return $tgl_indo;
    }

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
            [['no_spt',  'untuk', 'tujuan', 'zona', 'tgl_awal', 'dasar', 'jenis', 'tgl_akhir'], 'required'],
            [['kendaraan', 'id_kegiatan', 'id_kota', 'tgl_surat'], 'safe'],
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

    public function getPenandatangan()
    {
        return $this->hasOne(Personil::className(), ['nama_personil' => 'penanda_tangan']);
    }

    public function getTotal_realisasi()
    {
        return is_null($this->subSuratPerintahTugas) ? 0 : $this->hasMany(SubSuratPerintahTugas::className(), ['id_spt' => 'id_spt'])->sum('realisasi');
    }

    public function setDetailSuratPerintahTugas($value)
    {
        return $this->loadRelated('detailSuratPerintahTugas', $value);
    }

    public function getTanggalCetak()
    {
        $tanggal = $this->tgl_awal;
        $tanggal2 = $this->tgl_akhir;
        $tgl = explode(' ', $this->tanggal_indo($tanggal, false));
        $tgl2 = explode(' ', $this->tanggal_indo($tanggal2, false));

        if ($tgl[1] !== $tgl2[1]) {
            return $this->tanggal_indo($tanggal, false).'&nbsp;'.($tanggal !== $tanggal2) ? '-&nbsp;'.$this->tanggal_indo($tanggal2, false) : '';
        } else {
            if ($tgl[0] !== $tgl2[0]) {
                return $tgl[0].' - '.$tgl2[0].'  '.$tgl[1].'  '.$tgl[2];
            } else {
                return  $this->tanggal_indo($tanggal, false).'&nbsp;'.($tanggal !== $tanggal2) ? '-&nbsp;'.$this->tanggal_indo($tanggal2, false) : '';
            }
        }
    }

    public function getHariCetak()
    {
        $tglHari = $this->tgl_awal;
        $tglHari2 = $this->tgl_akhir;
        $day = date('D', strtotime($tglHari));
        $day2 = date('D', strtotime($tglHari2));
        //echo $day;
        $daftarHari = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu',
        );

        return $daftarHari[$day].(($tglHari !== $tglHari2) ? ' - '.$daftarHari[$day2] : '');
    }
}

<?php

namespace app\models;

use mdm\behaviors\ar\RelationTrait;
use Yii;

/**
 * This is the model class for table "tb_dt_spt".
 *
 * @property int         $id_d_spt
 * @property int         $id_spt
 * @property int         $id_personil
 * @property string      $jenis
 * @property TbMtSpt     $spt
 * @property TbMPersonil $personil
 */
class DetSuratPerintahTugas extends \yii\db\ActiveRecord
{
    use RelationTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tb_dt_spt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_spt', 'id_personil'], 'integer'],
            [['jenis'], 'string'],
            [['id_spt'], 'exist', 'skipOnError' => true, 'targetClass' => SuratPerintahTugas::className(), 'targetAttribute' => ['id_spt' => 'id_spt']],
            [['id_personil'], 'exist', 'skipOnError' => true, 'targetClass' => Personil::className(), 'targetAttribute' => ['id_personil' => 'id_personil']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_d_spt' => Yii::t('app', 'Id D Spt'),
            'id_spt' => Yii::t('app', 'Id Spt'),
            'id_personil' => Yii::t('app', 'Id Personil'),
            'jenis' => Yii::t('app', 'Jenis'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuratPerintahTugas()
    {
        return $this->hasOne(SuratPerintahTugas::className(), ['id_spt' => 'id_spt']);
    }

    public function getSubDetPerintahTugas()
    {
        return $this->hasMany(SubSuratPerintahTugas::className(), ['id_d_spt' => 'id_d_spt']);
    }

    public function setSubDetPerintahTugas($value)
    {
        return $this->loadRelated('subDetPerintahTugas', $value);
    }

    public function getTotal_realisasi()
    {
        return  $this->hasMany(SubSuratPerintahTugas::className(), ['id_d_spt' => 'id_d_spt'])->sum('realisasi');
    }

    public function getTotal_anggaran()
    {
        return is_null($this->suratPerintahTugas) ? 0 : $this->suratPerintahTugas->selisih * $this->hasMany(SubSuratPerintahTugas::className(), ['id_d_spt' => 'id_d_spt'])->sum('anggaran');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersonil()
    {
        return $this->hasOne(Personil::className(), ['id_personil' => 'id_personil']);
    }

    public function getPangkat()
    {
        return is_null($this->personil) ? '' : $this->personil->nama_pangkat;
    }

    public function getJabatan()
    {
        return is_null($this->personil) ? '' : $this->personil->jabatan;
    }

    public function getId_pangkat()
    {
        return is_null($this->personil) ? 0 : $this->personil->id_pangkat;
    }

    public function getStatus_personil()
    {
        return is_null($this->personil) ? '' : $this->personil->status_personil;
    }

    public function getNama_personil()
    {
        return is_null($this->personil) ? '' : $this->personil->nama_personil;
    }

    public function getNip()
    {
        return is_null($this->personil) ? '' : $this->personil->nip;
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tb_m_personil}}".
 *
 * @property int        $id_personil
 * @property string     $nip
 * @property string     $nama_personil
 * @property string     $status_personil
 * @property string     $golongan
 * @property int        $id_pangkat
 * @property int        $setuju
 * @property int        $mengetahui
 * @property int        $lunas
 * @property int        $tanda_tangan_surat
 * @property TbMPangkat $pangkat
 */
class Personil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_m_personil}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nip', 'nama_personil', 'status_personil', 'status'], 'required'],
            [['status_personil', 'golongan', 'jabatan'], 'string'],
            [['id_pangkat', 'setuju', 'mengetahui', 'lunas', 'tanda_tangan_surat'], 'integer'],
            [['nip', 'nama_personil'], 'string', 'max' => 50],
            [['id_pangkat'], 'exist', 'skipOnError' => true, 'targetClass' => Pangkat::className(), 'targetAttribute' => ['id_pangkat' => 'id_pangkat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_personil' => Yii::t('app', 'Id Personil'),
            'nip' => Yii::t('app', 'Nip'),
            'nama_personil' => Yii::t('app', 'Nama Personil'),
            'status_personil' => Yii::t('app', 'Status Personil'),
            'golongan' => Yii::t('app', 'Golongan'),
            'id_pangkat' => Yii::t('app', 'Id Pangkat'),
            'setuju' => Yii::t('app', 'Setuju'),
            'mengetahui' => Yii::t('app', 'Mengetahui'),
            'lunas' => Yii::t('app', 'Lunas'),
            'tanda_tangan_surat' => Yii::t('app', 'Tanda Tangan Surat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPangkat()
    {
        return $this->hasOne(Pangkat::className(), ['id_pangkat' => 'id_pangkat']);
    }

    public function getNama_pangkat()
    {
        return is_null($this->pangkat) ? '' : $this->pangkat->nama_pangkat;
    }
}

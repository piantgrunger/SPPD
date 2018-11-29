<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tb_m_kegiatan}}".
 *
 * @property int    $id_kegiatan
 * @property string $nama_kegiatan
 * @property string $Rekening
 * @property string $Daerah
 */
class Kegiatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_m_kegiatan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kegiatan', 'Rekening'], 'required'],
            [['Daerah'], 'string'],
            [['nama_kegiatan', 'Rekening'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kegiatan' => Yii::t('app', 'Id Kegiatan'),
            'nama_kegiatan' => Yii::t('app', 'Nama Kegiatan'),
            'Rekening' => Yii::t('app', 'Rekening'),
            'Daerah' => Yii::t('app', 'Daerah'),
        ];
    }
}

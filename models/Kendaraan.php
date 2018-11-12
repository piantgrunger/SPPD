<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%tb_m_kendaraan}}".
 *
 * @property int $id_kendaraan
 * @property string $nama_kendaraan
 */
class Kendaraan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tb_m_kendaraan}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_kendaraan'], 'required'],
            [['nama_kendaraan'], 'string', 'max' => 100],
            [['nama_kendaraan'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_kendaraan' => Yii::t('app', 'Id Kendaraan'),
            'nama_kendaraan' => Yii::t('app', 'Nama Kendaraan'),
        ];
    }
}

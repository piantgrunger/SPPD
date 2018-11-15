<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use  yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\AlatKelengkapan;
use app\models\Personil;
use app\models\Kegiatan;
use app\models\Kota;
use app\models\Kendaraan;

$data = ArrayHelper::map(
    AlatKelengkapan::find()->select(['id_alat_kelengkapan', 'alat_kelengkapan'])->where('tahun='.date('Y'))->asArray()->all(),
'id_alat_kelengkapan',
    'alat_kelengkapan'
);
$data2 = ArrayHelper::map(
    Personil::find()->select(['nama_personil', 'nama_personil'])->where(['in', 'id_personil', [109, 102, 116]])->asArray()->all(),
'nama_personil',
    'nama_personil'
);
$data3 = ArrayHelper::map(
    Kegiatan::find()->select(['id_kegiatan', 'nama_kegiatan' => "concat(nama_kegiatan,' - ',rekening)"])->asArray()->all(),
'id_kegiatan',
    'nama_kegiatan'
);

$data4 = ArrayHelper::map(
    Kota::find()->select(['id_kota', 'nama_kota' => 'nama_kota'])->asArray()->all(),
'id_kota',
    'nama_kota'
);

$data5 = ArrayHelper::map(
    Kendaraan::find()->select(['nama_kendaraan', 'nama_kendaraan'])->asArray()->all(),
    'nama_kendaraan',
    'nama_kendaraan'
);

/* @var $this yii\web\View */
/* @var $model app\models\SuratPerintahTugas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-perintah-tugas-form">


    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->


<div class="widget-box">
    <?= $form->field($model, 'no_spt')->textInput(['readOnly' => true]); ?>
    <?= $form->field($model, 'dasar')->textInput(['readOnly' => true]); ?>

    <?= $form->field($model, 'tgl_surat')->widget(DateControl::className(), ['disabled' => true]); ?>
    <?= $form->field($model, 'untuk')->textInput(['readOnly' => true]); ?>

    <?= $form->field($model, 'tujuan')->textInput(['readOnly' => true]); ?>

    <?= $form->field($model, 'tgl_awal')->widget(DateControl::className(), ['disabled' => true]); ?>

    <?= $form->field($model, 'tgl_akhir')->widget(DateControl::className(), ['disabled' => true]); ?>

    <?= $form->field($model, 'penanda_tangan')->widget(Select2::className(), [
          'data' => $data2,
        'readonly' => true,
        'options' => ['placeholder' => 'Pilih Penandatangan...'],
        'pluginOptions' => [
            'allowClear' => true,
            'disabled' => true,
        ],
    ]); ?>
    <?= $form->field($model, 'kendaraan')->widget(Select2::className(), [
          'data' => $data5,

        'options' => ['placeholder' => 'Pilih Kendaraan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]);
   ?>

    <?= $form->field($model, 'id_kegiatan')->widget(Select2::className(), [
        'data' => $data3,
      'readonly' => true,
      'options' => ['placeholder' => 'Pilih Kegiatan...'],
      'pluginOptions' => [
          'allowClear' => true,
      ],
  ]); ?>
      <?= $form->field($model, 'id_kota')->widget(Select2::className(), [
        'data' => $data4,
      'readonly' => true,
      'options' => ['placeholder' => 'Pilih Kota...'],
      'pluginOptions' => [
          'allowClear' => true,
      ],
  ]); ?>


    </div>




    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
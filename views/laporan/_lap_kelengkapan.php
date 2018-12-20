<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\AlatKelengkapan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$data3 = ArrayHelper::map(
    AlatKelengkapan::find()->select(['id_alat_kelengkapan', 'nama_alat_kelengkapan' => 'alat_kelengkapan'])->asArray()->all(),
    'id_alat_kelengkapan',
    'nama_alat_kelengkapan'
);

?>
<div class="form">

    <?php $form = ActiveForm::begin(['action' => 'laporan/cetak-rekap-alat-kelengkapan']); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]); ?>

  


    <?= $form->field($model, 'alat_kelengkapan')->widget(Select2::className(), [
        'data' => $data3,
        'readonly' => true,
        'options' => ['placeholder' => 'Pilih alat_kelengkapan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cetak'), ['class' => 'btn btn-primary']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

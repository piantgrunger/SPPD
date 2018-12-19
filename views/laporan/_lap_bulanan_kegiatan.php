<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\myhelpers;
use app\models\Kegiatan;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$data3 = ArrayHelper::map(
    Kegiatan::find()->select(['id_kegiatan', 'nama_kegiatan' => "concat(nama_kegiatan,' - ',rekening)"])->asArray()->all(),
    'id_kegiatan',
    'nama_kegiatan'
);


?>
<div class="form">

    <?php $form = ActiveForm::begin(['action'=>'laporan/cetak-rekap-kegiatan' ]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulan')->dropDownList(myhelpers::getMonths()) ?>


    <?= $form->field($model, 'kegiatan')->widget(Select2::className(), [
        'data' => $data3,
        'readonly' => true,
        'options' => ['placeholder' => 'Pilih Kegiatan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cetak'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

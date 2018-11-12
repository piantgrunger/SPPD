<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Pangkat;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$data = ArrayHelper::map(Pangkat::find()->select(['id_pangkat', 'nama_pangkat'])->asArray()
        ->all(), 'id_pangkat', 'nama_pangkat');

/* @var $this yii\web\View */
/* @var $model app\models\Personil */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="personil-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nip')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'nama_personil')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'status_personil')->dropDownList(['Dewan' => 'Dewan', 'Staff' => 'Staff'], ['prompt' => '']); ?>

    <?= $form->field($model, 'golongan')->dropDownList(['Gol I' => 'Gol I', 'Gol II' => 'Gol II', 'Gol III' => 'Gol III', 'Gol IV' => 'Gol IV', 'Eselon I' => 'Eselon I', 'Eselon II' => 'Eselon II', 'Eselon III' => 'Eselon III', 'Eselon IV' => 'Eselon IV'], ['prompt' => '']); ?>

    <?= $form->field($model, 'id_pangkat')->widget(Select2::className(), [
          'data' => $data,
        'options' => ['placeholder' => 'Pilih Pangkat...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <label > Penandatangan :</label>
        <?= $form->field($model, 'tanda_tangan_surat')->checkbox(array('label' => 'SPPD'))->label(''); ?>

        <?= $form->field($model, 'status')->dropDownList(['Aktif' => 'Aktif', 'Tidak Aktif' => 'Tidak Aktif'], ['prompt' => '']); ?>


    <label > Kwitansi :</label>
    <?= $form->field($model, 'setuju')->checkbox(array('label' => 'Setuju Dibayar'))->label(''); ?>
    <?= $form->field($model, 'mengetahui')->checkbox(array('label' => 'Mengetahui'))->label(''); ?>
    <?= $form->field($model, 'lunas')->checkbox(array('label' => 'Di Bayar Lunas'))->label(''); ?>


    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

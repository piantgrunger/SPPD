<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\helpers\myhelpers;

?>
<div class="form">

    <?php $form = ActiveForm::begin(['action'=>'laporan/cetak-rekap' ]); ?>
        <?= $form->errorSummary($model) ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'tahun')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bulan')->dropDownList(myhelpers::getMonths()) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Cetak'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

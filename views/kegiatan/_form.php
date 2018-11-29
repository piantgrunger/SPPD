<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Kegiatan */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kegiatan-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->

    <?= $form->field($model, 'nama_kegiatan')->textInput(); ?>

    <?= $form->field($model, 'Rekening')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'Daerah')->dropDownList(['Dalam Daerah' => 'Dalam Daerah', 'Luar Daerah' => 'Luar Daerah', 'Luar Negeri' => 'Luar Negeri'], ['prompt' => '']); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

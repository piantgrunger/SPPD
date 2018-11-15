<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\datecontrol\DateControl;
use kartik\select2\Select2;
use app\models\AlatKelengkapan;

$data = ArrayHelper::map(
    AlatKelengkapan::find()->select(['id_alat_kelengkapan', 'alat_kelengkapan'])->where('tahun='.date('Y'))->asArray()->all(),
'id_alat_kelengkapan',
    'alat_kelengkapan'
);

/* @var $this yii\web\View */
/* @var $model app\models\RABSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="rab-search">

      <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]); ?>
 <div class="row">
        <div class="col-sm-4">   <?= $form->field($model, 'tgl_aw')->widget(DateControl::classname()); ?></div>

    <div class="col-sm-4">   <?= $form->field($model, 'tgl_ak')->widget(DateControl::classname()); ?></div>
    </div>
    
    <div class="row">
        <div class="col-sm-8">  
    <?= $form->field($model, 'id_alat_kelengkapan')->widget(Select2::className(), [
          'data' => $data,
        'options' => ['placeholder' => 'Pilih Alat Kelengkapan...',
      ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

</div>
</div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary', 'id' => 'btn_cari']); ?>
    </div>


    <?php ActiveForm::end(); ?>

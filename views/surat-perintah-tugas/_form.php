<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datecontrol\DateControl;
use  yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\AlatKelengkapan;
use app\models\Personil;
use yii\helpers\Url;

$js = "
             let id = $(this).val();
             let jenis=$('#suratperintahtugas-jenis').find(\":selected\").text();
        
             $.post( '".Url::to(['surat-perintah-tugas/alat-kelengkapan'])."?id=' +id+'&jenis='+jenis, function(data) {
                                                  data1 = JSON.parse(data)
                                                  $('#table-detail > tbody').html(\"\");
                                                var  i=0;
                                                  $(data1).each(function(index, element) {
                                               $('#table-detail > tbody').append('<tr class=\"mdm-item\" data-key=\"'+i+'\" data-index=\"'+i+'\">'+
                                               '<td>'+
                                               '<div class=\"form-group field-detsuratperintahtugas-'+i+'-id_personil\">'+
                                               (i+1) +
                                               '</div>'+
                                               '</td>'+
                                               '<td>'+
                                              '<div class=\"form-group field-detsuratperintahtugas-'+i+'-id_personil\">'+
                                              ' <input type=\"hidden\" value=\"'+element.id_personil+'\" name=\"DetSuratPerintahTugas['+i+'][id_personil] \"> '+
                                               element.nama_personil+
                                              '</div>'+
                                               '</td>'+
                                               '<td>'+
                                              '<div class=\"form-group field-detsuratperintahtugas-'+i+'-nama_pangkat\">'+
                                               element.nama_pangkat+
                                              '</div>'+
                                               '</td>'+
                                                 '<td>'+
                                              '<div class=\"form-group field-detsuratperintahtugas-'+i+'status_personil\">'+
                                               element.status_personil+
                                              '</div>'+
                                               '</td>'+
                                                         '<td>'+
                                              '<div class=\"form-group field-detsuratperintahtugas-'+i+'jenis\">'+
                                                ' <input type=\"hidden\" value=\"'+element.jenis+'\" name=\"DetSuratPerintahTugas['+i+'][jenis] \"> '+

                                              element.jenis+
                                              '</div>'+
                                               '</td>'+
                                                         '<td>'+
                                              '<div class=\"form-group field-detsuratperintahtugas-'+i+'delete\">'+
                                               '<a data-action=\"delete\" id=\"delete2\"><span class=\"glyphicon glyphicon-trash\">'+
                                              '</div>'+
                                               '</td>'+


                                               '</tr>');
                                                   i++;
                                            });

                           })

";

$data = ArrayHelper::map(
    AlatKelengkapan::find()->select(['id_alat_kelengkapan', 'alat_kelengkapan'])->where('tahun='.date('Y'))->asArray()->all(),
'id_alat_kelengkapan',
    'alat_kelengkapan'
);
$data2 = ArrayHelper::map(
    Personil::find()->select(['nama_personil', 'nama_personil'])->where(['tanda_tangan_surat' => 1])->asArray()->all(),
'nama_personil',
    'nama_personil'
);

/* @var $this yii\web\View */
/* @var $model app\models\SuratPerintahTugas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-perintah-tugas-form">

    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?> <!-- ADDED HERE -->
        <?= $form->field($model, 'jenis')->dropDownList(['Dewan' => 'Dewan',
'Staff' => 'Staff',
], ['prompt' => '']); ?>

    <?= $form->field($model, 'no_spt')->textInput(['maxlength' => true]); ?>
    <?= $form->field($model, 'dasar')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'tgl_surat')->widget(DateControl::className()); ?>
    <?= $form->field($model, 'untuk')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'id_alat_kelengkapan')->widget(Select2::className(), [
          'data' => $data,
        'options' => ['placeholder' => 'Pilih Alat Kelengkapan...',
        'onChange' => $js, ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>



    <div class="row">
<div class="col-sm-12">
<div class="panel panel-info"   >
<div class="panel-heading"> <strong> Penerima Surat Perintah Tugas</strong>

</div>
<table id="table-detail" class="table table-bordered table-hover kv-grid-table kv-table-wrap">
    <thead>
        <tr class="active">
              <th>#</th>
           <th>Nama</th>
           <th>Pangkat</th>
           <th>Status</th>
           <th>Jabatan</th>
                   <th>Hapus</th>

        </tr>
    </thead>
    <?= \mdm\widgets\TabularInput::widget([
        'id' => 'detail-grid2',
        'allModels' => $model->detailSuratPerintahTugas,
        'model' => \app\models\DetSuratPerintahTugas::className(),
        'tag' => 'tbody',
        'form' => $form,
        'itemOptions' => ['tag' => 'tr'],
        'itemView' => '_item_anggota',
        'clientOptions' => [
            'btnAddSelector' => '#btn-add2',
        ],
    ]);
    ?>
    </table>

</div>




</div>
</div>

    <?= $form->field($model, 'tujuan')->textarea(['rows' => 6]); ?>

    <?= $form->field($model, 'zona')->dropDownList(['Di Dalam Kabupaten Sidoarjo' => 'Di Dalam Kabupaten Sidoarjo',
'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]' => 'Luar Kabupaten Sidoarjo dalam Propinsi (Zona 1)[Surabaya,Gresik,Mojokerto,Pasuruan]',
'Luar Kabupaten Sidoarjo di luar zona 1' => 'Luar Kabupaten Sidoarjo di luar zona 1',
'Luar Propinsi Jawa Timur' => 'Luar Propinsi Jawa Timur',
], ['prompt' => '']); ?>
    <?= $form->field($model, 'tgl_awal')->widget(DateControl::className()); ?>

    <?= $form->field($model, 'tgl_akhir')->widget(DateControl::className()); ?>

    <?= $form->field($model, 'penanda_tangan')->widget(Select2::className(), [
          'data' => $data2,
        'options' => ['placeholder' => 'Pilih Penandatangan...'],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php


use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'no_spt',
    'tgl_surat:date',
    'dasar',
    'nama_alat_kelengkapan',
    'untuk:ntext',
     'tujuan:ntext',
     'zona',
     'tgl_awal:date',
     'tgl_akhir:date',
     'penanda_tangan',
     'nama_kegiatan',
     'kendaraan',
     'nama_kota',
];

/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratPerintahTugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]);?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumns,
        'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'striped' => false,

        'pjax' => true,
        'bordered' => true,
        'striped' => false,
        'condensed' => false,

        'panel' => [
            'before' => $this->render('_search', ['model' => $searchModel]),
            'type' => GridView::TYPE_INFO,
            'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Laporan Surat Perintah Perjalanan Dinas').'</strong>',
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}',
        ],

        'resizableColumns' => true,
    ]);
    ?>
    <?php Pjax::end(); ?>
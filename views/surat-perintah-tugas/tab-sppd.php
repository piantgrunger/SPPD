<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'no_spt',
    'tgl_surat:date',
    'nama_alat_kelengkapan',
    'tujuan:ntext',
    'zona',
    'tgl_awal:date',
    'tgl_akhir:date',
    'penanda_tangan',

    [
        'class' => 'kartik\grid\ActionColumn', 'template' => ' {koreksi} {kwitansi} {realisasi}  <br>  {sppd} {sppd2} {sppd3}',
        'buttons' => [

            'kwitansi' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id . '/create-kwitansi')) {
                    return
                        Html::a(
                        'Buat Kwitansi',
                        ['create-kwitansi', 'id' => $model->id_spt],
                        [
                            'class' => 'btn btn-warning',
                                'data' => [
                                'confirm' => Yii::t('app', 'Pembuatan Kwitansi akan Menghapus Kwitansi dan Realisasi yang Sudah Ada Apakah Anda Yakin??'),

                            ]

                        ]
                    );
                } else {
                    return ' ';
                }
            },

            'koreksi' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id . '/sppd')) {
                    return
                        Html::a(
                        'Koreksi',
                        ['sppd', 'id' => $model->id_spt],
                        [
                            'class' => 'btn btn-success'

                        ]
                    );
                } else {
                    return ' ';
                }
            },
            'sppd' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/print-sppd1')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span> ',
                        ['print-sppd1', 'id' => $model->id_spt],
                        [
                            'title' => Yii::t('app', 'Dewan'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
            'sppd2' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/print-sppd2')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span> ',
                        ['print-sppd2', 'id' => $model->id_spt],
                        [
                            'title' => Yii::t('app', 'Sekretariat Dewan'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
            'sppd3' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/print-sppd3')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span> ',
                        ['print-sppd3', 'id' => $model->id_spt],
                        [
                            'title' => Yii::t('app', 'Sekretariat Daerah'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },   'realisasi' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/realisasi')) {
                    return
                        Html::a(
                        'Realisasi',
                        ['realisasi', 'id' => $model->id_spt],
                        [
                            'class' => 'btn btn-info',
                            'title' => Yii::t('app', 'Sekretariat Daerah'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
        ],
    ],
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
            'type' => GridView::TYPE_INFO,
            'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Surat Perintah Perjalanan Dinas').'</strong>',
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}',
        ],

        'resizableColumns' => true,
    ]);
    ?>
    <?php Pjax::end(); ?>
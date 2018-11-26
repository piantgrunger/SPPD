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
        'class' => 'kartik\grid\ActionColumn', 'template' => '{kwitansi} {sppd}',
        'buttons' => [
            'kwitansi' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/print-kwitansi')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span> ',
                        ['print-kwitansi', 'id' => $model->id_spt],
                        [
                            'title' => Yii::t('app', 'Kwitansi Perorang'),
                            'data-pjax' => 0,
                        ]
                    );
                } else {
                    return ' ';
                }
            },
            'sppd' => function ($url, $model) {
                if (Mimin::checkRoute($this->context->id.'/print-realisasi')) {
                    return
                        Html::a(
                        '<span class="glyphicon glyphicon-print"></span> ',
                        ['print-realisasi', 'id' => $model->id_spt],
                        [
                            'title' => Yii::t('app', 'Realisasi Global'),
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
            'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Kwitansi Surat Perintah Perjalanan Dinas').'</strong>',
        ],
        'toolbar' => [
            '{export}',
            '{toggleData}',
        ],

        'resizableColumns' => true,
    ]);
    ?>
    <?php Pjax::end(); ?>
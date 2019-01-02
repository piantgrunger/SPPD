<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;

$gridColumns = [['class' => 'kartik\grid\SerialColumn'],
            'alat_kelengkapan',
            'tahun',

         ['class' => 'kartik\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route),
            ],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlatKelengkapanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Alat Kelengkapan');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alat-kelengkapan-index">

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
             'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Alat Kelengkapan').'</strong>',
      ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id.'/create'))) ? Html::a(Yii::t('app', 'Alat Kelengkapan Baru'), ['create'], ['class' => 'btn btn-success']) : '',
    ],
    ['content' => ((Mimin::checkRoute($this->context->id.'/copy'))) ? Html::a(Yii::t('app', 'Copy Alat Kelengkapan Tahun Lalu'), ['copy'], ['class' => 'btn btn-info']) : '',
],
        '{export}',
        '{toggleData}',
    ],

         'resizableColumns' => true,
    ]);
 ?>
</div>

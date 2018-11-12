<?php


use hscstudio\mimin\components\Mimin;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;

$gridColumns = [['class' => 'kartik\grid\SerialColumn'],
            'nip',
            'nama_personil',
            'status_personil',
            'golongan',
            'status',
            // 'id_pangkat',
            // 'setuju',
            // 'mengetahui',
            // 'lunas',
            // 'tanda_tangan_surat',

         ['class' => 'kartik\grid\ActionColumn',   'template' => Mimin::filterActionColumn([
              'update', 'delete', 'view', ], $this->context->route)],    ];

/* @var $this yii\web\View */
/* @var $searchModel app\models\PersonilSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Daftar Personil');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="personil-index">

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
             'heading' => '<i class="glyphicon glyphicon-tasks"></i>  <strong> '.Yii::t('app', 'Personil').'</strong>',
      ],
            'toolbar' => [
        ['content' => ((Mimin::checkRoute($this->context->id.'/create'))) ? Html::a(Yii::t('app', 'Personil Baru'), ['create'], ['class' => 'btn btn-success']) : ''],

        '{export}',
        '{toggleData}',
    ],

         'resizableColumns' => true,
    ]);
 ?>
    <?php Pjax::end(); ?>
</div>

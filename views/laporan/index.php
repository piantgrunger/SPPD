<?php


use kartik\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Html;
use yii\bootstrap\Tabs;

$item =
    [
    [
        'label' => 'Laporan SPPD Bulanan',
        'content' =>
            $this->render('_lap_bulanan', [
            'model' => $searchModel,
        ]),
        'active' => true,
    ],

    [
        'label' => 'Laporan SPPD Bulanan per Kegiatan',
        'content' =>
            $this->render('_lap_bulanan_kegiatan', [
            'model' => $searchModel2,
        ]),

    ],
];
?>
<div class="laporan">
  <?= Tabs::widget([
        'items' => $item,
        'options' => ['class' => 'nav-pills'], //
    ]);
    ?>

</div>
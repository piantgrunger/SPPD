<?php


use yii\bootstrap\Tabs;

$item =
    [
    [
        'label' => 'Laporan SPPD Bulanan',
        'content' => $this->render('_lap_bulanan', [
            'model' => $searchModel,
        ]),
        'active' => true,
    ],

    [
        'label' => 'Laporan SPPD Bulanan per Kegiatan',
        'content' => $this->render('_lap_bulanan_kegiatan', [
            'model' => $searchModel2,
        ]),
    ],
    [
        'label' => 'Laporan Monitoring SPPD Alat Kelengkapan Kab. Sidoarjo',
        'content' => $this->render('_lap_kelengkapan', [
            'model' => $searchModel3,
        ]),
    ],
    [
        'label' => 'Laporan Kegiatan Anggota Dewan Kab. Sidoarjo',
        'content' => $this->render('_lap_tahunan_kegiatan', [
            'model' => $searchModel4,
        ]),
    ],
];
?>
<div class="laporan">
  <?= Tabs::widget([
        'items' => $item,
        'options' => ['class' => 'nav-pills'],
    ]);
    ?>

</div>
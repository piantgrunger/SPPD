<?php

use yii\helpers\Html;
use hscstudio\mimin\components\Mimin;

$this->registerCSSFile('css/metro-all.css');
$this->registerCSSFile('css/start.css');
$this->registerJSFile(Yii::$app->homeUrl.'js/metro.min.js', ['depends' => [yii\web\JqueryAsset::className()]]);
$this->registerJSFile(Yii::$app->homeUrl.'js/start.js', ['depends' => [yii\web\JqueryAsset::className()]]);
/* @var $this yii\web\View */
/* @var $this yii\web\View */

?>
    <div class="container-fluid start-screen no-scroll-y h-100">



<div class="tiles-grid tiles-group  size-3">



        <?= (Mimin::checkRoute('pangkat/index')) ? Html::a("
        <span class='mif-flow-tree icon'></span>
        <span class='branding-bar'>Pangkat</span>
         ", ['/pangkat'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>

        <?= (Mimin::checkRoute('alat-kelengkapan/index')) ? Html::a("
        <span class='fa fa-id-badge icon'></span>
        <span class='branding-bar'>Alat Kelengkapan</span>
         ", ['/alat-kelengkapan'], ['data-role' => 'tile', 'class ' => 'bg-blue', 'data-effect' => 'animate-slide-up']) : ''; ?>

        <?= (Mimin::checkRoute('kota/index')) ? Html::a("
        <span class='fa fa-building-o icon'></span>
        <span class='branding-bar'>Kota</span>
         ", ['/kota'], ['data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>
 <?= (Mimin::checkRoute('kegiatan/index')) ? Html::a("
        <span class='fa fa-handshake-o icon'></span>
        <span class='branding-bar'>Kegiatan</span>
         ", ['/kegiatan'], ['data-role' => 'tile', 'class ' => 'bg-red', 'data-effect' => 'animate-slide-up']) : ''; ?>
 <?= (Mimin::checkRoute('kendaraan/index')) ? Html::a("
        <span class='fa fa-car icon'></span>
        <span class='branding-bar'>Kendaraan</span>
         ", ['/kendaraan'], ['data-role' => 'tile', 'class ' => 'bg-cyan', 'data-effect' => 'animate-slide-up']) : ''; ?>

 <?= (Mimin::checkRoute('tarif/index')) ? Html::a("
        <span class='fa fa-money icon'></span>
        <span class='branding-bar'>Tarif</span>
         ", ['/tarif'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>
 <?= (Mimin::checkRoute('personil/index')) ? Html::a("
        <span class='fa fa-user-o icon'></span>
        <span class='branding-bar'>Personil</span>
         ", ['/personil'], ['data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>


</div>
<div class="tiles-grid tiles-group  size-2">
      <?= (Mimin::checkRoute('alat-kelengkapan/index-mapping')) ? Html::a("
        <span class='fa fa-users icon'></span>
        <span class='branding-bar'>Mapping Alat Kelengkapan</span>
         ", ['/alat-kelengkapan/index-mapping'], ['data-size' => 'wide', 'data-role' => 'tile', 'class ' => 'bg-blue', 'data-effect' => 'animate-slide-up']) : ''; ?>
     <?= (Mimin::checkRoute('surat-perintah-tugas/index')) ? Html::a("
        <span class='fa fa-file-text-o icon'></span>
        <span class='branding-bar'>Surat Perintah Tugas</span>
         ", ['/surat-perintah-tugas'], ['data-size' => 'wide', 'data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>
   <?= (Mimin::checkRoute('surat-perintah-tugas/index-sppd')) ? Html::a("
        <span class='fa fa-plane icon'></span>
        <span class='branding-bar'>Surat Perintah Perjalanan Dinas</span>
         ", ['/surat-perintah-tugas/index-sppd'], ['data-size' => 'wide', 'data-role' => 'tile', 'class ' => 'bg-cyan', 'data-effect' => 'animate-slide-up']) : ''; ?>

</div>
<div class="tiles-grid tiles-group  size-1">
<?= (Mimin::checkRoute('surat-perintah-tugas/index-kwitansi')) ? Html::a("
        <span class='fa fa-envelope-o  icon'></span>
        <span class='branding-bar'>Kwitansi</span>
         ", ['/surat-perintah-tugas/index-kwitansi'], ['data-role' => 'tile', 'class ' => 'bg-green', 'data-effect' => 'animate-slide-up']) : ''; ?>
<?= (Mimin::checkRoute('laporan/index')) ? Html::a("
        <span class='fa fa-list  icon'></span>
        <span class='branding-bar'>Laporan</span>
         ", ['/laporan'], ['data-role' => 'tile', 'class ' => 'bg-pink', 'data-effect' => 'animate-slide-up']) : ''; ?>

</div>
</div>

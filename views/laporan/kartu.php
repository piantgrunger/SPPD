<?php $tanggal = strtotime($tanggal1); ?>

<p align='center'><b> KARTU MONITORING DAFTAR PERJALANAN DINAS <BR>TAHUN ANGGARAN <?= date('Y', $tanggal); ?></b></p>

<?php
   foreach ($list as $data) {
       $filter= $model->where("id_alat_kelengkapan=".$data->id_alat_kelengkapan)->all();

       echo  $this->render('kartu_detail', [
        'model' => $filter,
        'tanggal1' => $tanggal1,
        'alat_kelengkapan' => $data->nama_alat_kelengkapan
    ]);
   }
?>\
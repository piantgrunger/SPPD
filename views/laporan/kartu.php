<?php
 use app\models\AlatKelengkapan;

?>

<p align='center'><b> KARTU MONITORING SPPD ALAT KELENGKAPAN <BR>TAHUN ANGGARAN <?= $tahun; ?></b></p>

<?php

       $filter = $model->where('id_alat_kelengkapan='.$id_alat_kelengkapan)->orderBy('tgl_awal')->all();
      $data = AlatKelengkapan::findOne($id_alat_kelengkapan);
       echo  $this->render('kartu_detail', [
        'model' => $filter,

        'alat_kelengkapan' => $data->alat_kelengkapan,
    ]);

?>
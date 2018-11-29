<?php
$bulan = array(
    1 => 'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember',
);

?>
<p align='center'> TAHUN ANGGARAN <?= date('y', $tanggal) ?></p>
<Br>
<br>
  <?=$bulan[date('m', $tanggal)]?>       &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   Tanggal Cetak :<?=date('d/m/Y')?>    <br>

<table autosize="1" width="722" height="822" border="0" cellpadding="5" cellspacing="0">
<tr>
<td class="printatas printkanan printkiri " align="center">NO</td>
<td class="printatas printkanan " align="center">KOTA</td>
<td class="printatas printkanan " align="center">TANGGAL</td>
<td class="printatas printkanan " align="center">URAIAN</td>
<td class="printatas printkanan " align="center">ALAT KELENGKAPAN</td>
<td class="printatas printkanan " align="center">NAMA PERSONIL</td>
<td class="printatas printkanan " align="center">LAMA HARI</td>
<td class="printatas printkanan " align="center">PENGELUARAN</td>

</tr>

<?php
$formatter = \Yii::$app->formatter;

$i = 1;
$total = 0;
foreach ($model  as $detail) {
    $anggota = [];
    foreach ($data->detailSuratPerintahTugas as $detail) {
        $anggota[] = $detail->nama_personil;
    }
    return implode(' - ', $anggota);

    echo "<tr>
<td class=\"printatas printkanan printkiri\" align=\"center\">$i</td>
<td class=\"printatas printkanan \" >&nbsp;$detail->no_spt</td>
<td class=\"printatas printkanan \" >&nbsp;".Yii::$app->formatter->asDate($model->tgl_awal) .' - '. Yii::$app->formatter->asDate($model->tgl_akhir)."</td>
<td class=\"printatas printkanan \" >&nbsp;$model->untuk <br> Pada : < br > Hari : $model->hariCetak <br> Tanggal : $model->tanggalCetak <br> Tempat : $model->tujuan </td>
<td class=\"printatas printkanan \" >&nbsp;$detail->nama_kegiatan</td>
<td class=\"printatas printkanan \" >&nbsp;$detail->nama_kegiatan</td>
<td class=\"printatas printkanan \" >&nbsp;$detail->nama_alat_kelengkapan</td>
<td class=\"printatas printkanan \" >&nbsp;$anggota</td>
<td class=\"printatas printkanan \" >&nbsp;$detail->selisih</td>

<td class=\"printatas printkanan \" align ='right' >&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp; ".$formatter->asDecimal($detail->total_realisasi, 0).'</td>
</tr>
';
    ++$i;
    $total += $detail->total_realisasi;
}?>
</table>
<br><br>

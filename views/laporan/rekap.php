<?php
$tanggal=strtotime($tanggal1);
$bulan = array(
    '01' => 'Januari',
    '02' =>  'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' =>  'Juni',
    '07' => 'Juli',
    '08' =>  'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember',
);

?>
<p align='center'><b> TAHUN ANGGARAN <?= date('Y', $tanggal) ?></b></p>
<Br>
<br>
<table width="100%">
 <tr><td width="80%"> Bulan : <?=$bulan[date('m', $tanggal)]?></td>  <td align="right">    Tanggal Cetak :<?=date('d/m/Y')?>  </td>  </tr> <br>
</table>
<table autosize="1" width="100%"  border="0" cellpadding="1" cellspacing="0">
<tr>
<td class="printatas printkanan printkiri printbawah " align="center">NO</td>
<td class="printatas printkanan printbawah " align="center">KOTA</td>
<td class="printatas printkanan printbawah " align="center">TANGGAL</td>
<td class="printatas printkanan printbawah " align="center">URAIAN</td>
<td class="printatas printkanan printbawah " align="center">NAMA KEGIATAN</td>
<td class="printatas printkanan printbawah " align="center">ALAT KELENGKAPAN</td>

<td class="printatas printkanan printbawah " align="center">NAMA PERSONIL</td>
<td class="printatas printkanan printbawah " align="center">LAMA HARI</td>
<td class="printatas printkanan printbawah " align="center">PENGELUARAN</td>

</tr>

<?php
$formatter = \Yii::$app->formatter;

$i = 1;
$total = 0;
foreach ($model  as $detail) {
    $anggota = [];
    foreach ($detail->detailSuratPerintahTugas as $data) {
        $anggota[] = $data->nama_personil;
    }

    $anggota1= implode(' - ', $anggota);


    echo "<tr>
<td class=\" printkanan printkiri\" align=\"center\">$i</td>
<td class=\" printkanan \" align=\"center\" >&nbsp;$detail->no_spt</td>
<td class=\" printkanan \"align=\"center\" >&nbsp;".Yii::$app->formatter->asDate($detail->tgl_awal) .' - '. Yii::$app->formatter->asDate($detail->tgl_akhir)."</td>
<td class=\" printkanan \" align=\"center\" >&nbsp;$$detail->untuk <br> Pada : <br> Hari : $detail->hariCetak <br> Tanggal : $detail->tanggalCetak <br> Tempat : $detail->tujuan </td>
<td class=\" printkanan \" align=\"center\">&nbsp;$detail->nama_kegiatan</td>
<td class=\" printkanan \" align=\"center\" >&nbsp;$detail->nama_alat_kelengkapan</td>
<td class=\" printkanan \" align=\"center\">&nbsp;$anggota1</td>
<td class=\" printkanan \" align=\"center\">&nbsp;$detail->selisih</td>

<td class=\" printkanan \" align ='right' ><table><tr>  <td> Rp  </td> <td width=\"80% \"> ".$formatter->asDecimal($detail->total_realisasi, 0). '</td></tr></table></td>
</tr>
';
    ++$i;
    $total += $detail->total_realisasi;
}?>
<tr ><TD colspan=10 class="printatas">&nbsp;</td></tr>
</table>
<br><br>

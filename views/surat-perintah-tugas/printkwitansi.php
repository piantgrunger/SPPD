<?php
    $i = 1;
    $bulan1 = array(1 => 'Januari',
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
  function tanggal_indo($tgl, $cetak_hari = false)
  {
      $hari = array(1 => 'Senin',
              'Selasa',
              'Rabu',
              'Kamis',
              'Jumat',
              'Sabtu',
              'Minggu',
          );

      $bulan = array(1 => 'Januari',
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
      $split = explode('-', $tgl);
      //      echo "tgl:". $tgl ."##";
      $tgl_indo = $split[2].' '.$bulan[(int) $split[1]].' '.$split[0];

      if ($cetak_hari) {
          $num = date('N', strtotime($tgl));

          return $hari[$num].', '.$tgl_indo;
      }

      return $tgl_indo;
  }
$tgl = date('Y-m-d', strtotime($model->tgl_awal));
$tglSurat = date('Y-m-d', strtotime($model->tgl_surat));
$tglDoang = date('d', strtotime($model->tgl_awal));
$tgl2 = date('Y-m-d', strtotime($model->tgl_akhir));
$bulanSaja1 = date('m', strtotime($model->tgl_awal));
$bulanSaja2 = date('m', strtotime($model->tgl_akhir));

?>

      &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;&nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp;   No. BKU : ........                                    <br>

      KODE REK : <?=$model->rekening; ?> <br>
KEGIATAN : <?=$model->nama_kegiatan; ?><Br>
<br> 
<br> 
<br> 

<?php foreach ($model->detailSuratPerintahTugas  as $detail) {
    ?>
<div class="divprint">

<table>
<tr>
<td></td>
<td width="70%">
 DAFTAR :  Tanda Terima Uang Biaya Perjalanan Dinas <?=$model->nama_alat_kelengkapan; ?> melakukan Kunjungan kerja terkait <?=$model->untuk; ?> pada : <br>
<b>Tempat :  <?=$model->tujuan; ?></b>     <br>
<b>Tanggal : </b>     <?php
      $tanggal = $model->tgl_awal;
    $tanggal2 = $model->tgl_akhir;
    $tgl = explode(' ', tanggal_indo($tanggal, false));
    $tgl2 = explode(' ', tanggal_indo($tanggal2, false));

    if ($tgl[1] !== $tgl2[1]) {
        echo tanggal_indo($tanggal, false); ?>&nbsp; <?php echo ($tanggal !== $tanggal2) ? '-&nbsp;'.tanggal_indo($tanggal2, false) : '';
    } else {
        if ($tgl[0] !== $tgl2[0]) {
            echo $tgl[0].' - '.$tgl2[0].'  '.$tgl[1].'  '.$tgl[2];
        } else {
            echo tanggal_indo($tanggal, false); ?>&nbsp; <?php echo ($tanggal !== $tanggal2) ? '-&nbsp;'.tanggal_indo($tanggal2, false) : '';
        }
    } ?>            
    </td>
 </tr>
    </table>

<br> 

<table autosize="1" width="722" height="822" border="0" cellpadding="5" cellspacing="0">
<tr>
<td class="printatas printkanan printkiri abu" align="center">No</td>
<td class="printatas printkanan abu" align="center">Nama</td>
<td class="printatas printkanan abu" align="center">Pangkat / Gol</td>
<td class="printatas printkanan abu" align="center">Jumlah</td>
</tr>
<tr>
<td class="printatas printkanan printkiri abu" align="center">1</td>
<td class="printatas printkanan abu" align="center">2</td>
<td class="printatas printkanan abu" align="center">3</td>
<td class="printatas printkanan abu" align="center">4</td>
</tr>
<?php
$formatter = \Yii::$app->formatter;

    $total = 0;

    echo "<tr>
<td class=\"printatas printkanan printkiri printbawah\" align=\"center\">$i</td>
<td class=\"printatas printkanan printbawah\" >&nbsp;$detail->nama_personil '<br>
<table>";

    foreach ($detail->subDetPerintahTugas as $sub) {
        $realisasi = $sub->realisasi;

        //if ($realisasi > 0.00) {
            echo '<tr><td>  '.$sub->nama_biaya.'</td><td> :</td><td width ="40%" align="right"> '.$sub->durasi.' x Rp  '.$formatter->asDecimal(($sub->durasi === 0) ? 0 : $sub->realisasi / $sub->durasi, 0).'</td><td> =</td><td width ="20%" align="right"> Rp  '.$formatter->asDecimal($sub->realisasi, 0).'</td></tr>';
        
        //}
    }
    echo "</table></td><td class=\"printatas printkanan printbawah\" >&nbsp;$detail->pangkat</td>
<td class=\"printatas printkanan printbawah \" align ='right' >&nbsp;Rp&nbsp;&nbsp;&nbsp;&nbsp; ".$formatter->asDecimal($detail->total_realisasi, 0).'</td>
</tr>
';
    ++$i;
    $total += $detail->total_realisasi; ?>

</table>
<br><br>

<table class="divprint" autosize="1" width="722" height="822" border="0" cellpadding="5" cellspacing="0">
<tr>
<td align="center"> <br>
 <br>
<br>
<br>
<br>
<br>
<br>


</td>

<td align="center">
 <br>
 <br>
<br>
<br>
<br>
<br>
 <br>


</td>
<td align="right">PENERIMA UANG <br>
 <br>
<br>
<br>
<b><u><?=$detail->nama_personil; ?></u></b> <br>
</td>
</tr>
</table>
<br>
<br>
-------------------------------------------------------------------------------------------------------------------------------------
<br>
</div>

<?php
} ?>
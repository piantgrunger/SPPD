<?php
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
          return  '   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;        '.$bulan[(int) $split[1]].' '.$split[0];
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

<table>
<tr><td valign ="top"> DAFTAR : </td> <td> Tanda Terima Uang Biaya Perjalanan Dinas <?=$model->nama_alat_kelengkapan; ?> melakukan Kunjungan kerja terkait <?=$model->untuk; ?> pada : <br>
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
        }
       ?>            
</td></tr>
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

$i = 1;
$total = 0;
foreach ($model->detailSuratPerintahTugas  as $detail) {
    echo "<tr>
<td class=\"printatas printkanan printkiri\" align=\"center\">$i</td>
<td class=\"printatas printkanan \" >&nbsp;$detail->nama_personil</td>
<td class=\"printatas printkanan \" align=\"center\" >&nbsp;$detail->pangkat</td>
<td class=\"printatas printkanan \" align ='right' ><table><tr><td> &nbsp;Rp</td><td align=\"right\" width=\"85%\"> &nbsp;&nbsp;&nbsp;&nbsp; ".$formatter->asDecimal($detail->total_realisasi, 0).'</td> </tr> </table></td>
</tr>
';
    ++$i;
    $total += $detail->total_realisasi;
}?>
  <tr>
       <td class="printatas printkanan  " align="center" colspan=2>&nbsp;:</td>
       <td class="printatas printkanan printbawah abu" align="center">JUMLAH</td>
        <td class="printatas printkanan printbawah abu"  align ='right'><table><tr><td> &nbsp;Rp</td><td align="right" width="85%"> &nbsp;&nbsp;&nbsp;&nbsp; <?=$formatter->asDecimal($total, 0); ?></td> </tr> </table></td>
</tr>
</table>
<br><br>
<P align="right">  Dibayar Lunas Tgl: <?=tanggal_indo(date('Y-m-d'), true); ?></P>
<table autosize="1" width="722" height="822" border="0" cellpadding="5" cellspacing="0">
<tr>
<td align="center">Setuju Dibayar <br>
PPTK <br>
<br>
<br>
<br>
<br>
<b><u>DRA ENNIEK DWI ASTUTI</u></b> <br>
Nip :195910021986032011

</td>

<td align="center">
MENGETAHUI <br>
KUASA PENGGUNA ANGGARAN <br>
<br>
<br>
<br>
<br>
<b><u>SUTIKNO SH. MH.</u></b> <br>
Nip :195912011986031024

</td>
<td align="center">BENDAHARA PENGELUARAN <br>
PEMBANTU <br>
<br>
<br>
<br>
<br>
<b><u>HERLINA WIDYA NINGSIH</u></b> <br>
Nip :198111292008012005</td>
</tr>
</table>
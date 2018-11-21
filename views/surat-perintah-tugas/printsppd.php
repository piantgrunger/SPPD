<?php
use yii\helpers\Url;

?>

<?php
        function tanggal_indo($tanggal, $cetak_hari = false)
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
            $split = explode('-', $tanggal);
            $tgl_indo = $split[2].' '.$bulan[(int) $split[1]].' '.$split[0];

            if ($cetak_hari) {
                $num = date('N', strtotime($tanggal));

                return $hari[$num].', '.$tgl_indo;
            }

            return $tgl_indo;
        }

function terbilang($x)
{
    $angka = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    if ($x < 12) {
        return ' '.$angka[$x];
    } elseif ($x < 20) {
        return terbilang($x - 10).' belas';
    } elseif ($x < 100) {
        return terbilang($x / 10).' puluh'.terbilang($x % 10);
    } elseif ($x < 200) {
        return 'seratus'.terbilang($x - 100);
    } elseif ($x < 1000) {
        return terbilang($x / 100).' ratus'.terbilang($x % 100);
    } elseif ($x < 2000) {
        return 'seribu'.terbilang($x - 1000);
    } elseif ($x < 1000000) {
        return terbilang($x / 1000).' ribu'.terbilang($x % 1000);
    } elseif ($x < 1000000000) {
        return terbilang($x / 1000000).' juta'.terbilang($x % 1000000);
    }
}
?>

<?php
    foreach ($model->detailSuratPerintahTugas as $key => $row) {
        //echo $row["nama_personil"]."<br/>---<br/>";?>





<table class="dataprint"  autosize="1" width="722" height="822" border="0" cellpadding="5" cellspacing="0" >

<tr>
    <td width="715" height="56" colspan="10" align="left" valign="top" style="font-family:Arial, Helvetica, sans-serif; font-size:19px"><img src="<?=Url::to(['/Image/Kop'.$mode.'.png']); ?>" width="100%" height="145" /></td>

  </tr>
  <tr>
    <td colspan="10" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td class="judul" colspan="10" align="center"><strong>Surat Perintah Perjalanan Dinas</strong></td>
  </tr>
  <tr>
    <td class="judul" colspan="10" align="center"><strong>(S P P D)</strong></td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td></td>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"></td>
    <td width="13"></td>
    <td colspan="7">&nbsp;</td>
  </tr>
  <tr class="isi" >
    <td align="center" valign="top" class="printatas printkiri" >1.</td>
    <td valign="top"  class="printatas">Pejabat yang memberi perintah</td>
    <td class="printatas printkiri" >: </td    ><td colspan="7"  class="printatas printkanan"><?php echo $model->penanda_tangan; ?></td>
  </tr>
  <tr class="isi">
    <td align="center"  valign="top" class="printkiri printatas" >2.</td>
    <td  class="printatas">Nama / NIP Pegawai yang Diperintah mengadakan perjalanan dinas</td>
    <td valign="top" class="printkiri printatas">: </td>
    <td colspan="7" valign="top" class="printatas printkanan"><?php echo $row->nama_personil; ?> &nbsp;/&nbsp;<?php echo $row->nip; ?> </td>
  </tr>
  <tr class="isi">
    <td align="center" valign="top" class="printatas printkiri">3.</td>
    <td class="printatas" >Jabatan, Pangkat dan Golongan dari yang diperintah</td>
    <td valign="top" style = "" class="printatas printkiri">:</td>
    <td colspan="7" valign="top" class="printatas printkanan" ><?php  echo ($row->status_personil === 'Dewan') ? 'Anggota DPRD Kabupaten Sidoarjo' : $row->pangkat; ?>&nbsp;/ <?php echo $row->jenis; ?>&nbsp;</td>
  </tr>
  <tr class="isi">
    <td width="25" align="center" valign="top" class="printkiri printatas" >4.</td>
    <td valign="top" width="266" class="printatas">Perjalanan Dinas Diperintahkan</td>
    <td valign="top" class="printkiri printatas" >:  </td>
    <td width="32" valign="middle" class ="printatas">Dari </td>
    <td colspan="1" class ="printatas">: Sidoarjo</td>
    <td colspan="5" class="printkanan printatas">&nbsp;</td>
  </tr>
  <tr class="isi">
    <td class="printkiri" >&nbsp;</td>
    <td >&nbsp;</td>
    <td  class="printkiri">&nbsp;</td>
    <td>Ke  </td>
    <td colspan="6" class="printkanan">:&nbsp;<?php echo $model->nama_kota; ?></td>
  </tr>
  <tr class="isi">
    <td class="printkiri" >&nbsp;</td>
    <td >&nbsp;</td>
    <td class="printkiri" >&nbsp;</td>
    <td  colspan="7" class="printkanan">Transportasi Menggunakan :&nbsp;<?= $model->kendaraan; ?></td>
  </tr>
  <tr class="isi">
    <td valign="top" align="center" class="printkiri printatas">5.</td>
    <td valign="top" class="printatas" >Perjalanan Dinas direncanakan</td>
    <td valign="top"  class="printkiri printatas">:</td>
    <td colspan="7"  class="printatas printkanan">Selama : <?php echo $model->selisih; ?> ( <?php $angka = $model->selisih;
        echo terbilang($angka); ?> ) Hari</td>
  </tr>
  <tr class="isi">
    <td class="printkiri printbawah" >&nbsp;</td>
    <td class="printbawah" >&nbsp;</td>
    <td class="printbawah printkiri">&nbsp;</td>
    <td colspan="7" align="left" class="printbawah printkanan"  >
      Pada Tanggal &nbsp; : &nbsp;

   <?php
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
                echo  tanggal_indo($tanggal, false); ?>&nbsp; <?php echo ($tanggal !== $tanggal2) ? '-&nbsp;'.tanggal_indo($tanggal2, false) : '';
            }
        } ?></td>
  </tr>
  <tr class="isi">
    <td valign="top" align="center" class="printbawah printkiri" >6.</td>
    <td valign="top" class="printbawah" >Maksud Mengadakan Perjalanan</td>
    <td valign="top" class="printbawah printkiri" >:</td>
    <td  colspan="7" class="printbawah printkanan"><?php echo nl2br(stripcslashes($model->untuk)); ?></td>
  </tr>
  <tr class="isi">
    <td valign="top" align="center" class="printbawah printkiri" >7.</td>
    <td valign="top" class="printbawah">Perhitungan Biaya Perjalanan</td>
    <td valign="top" class="printbawah printkiri" >:</td>
    <td  colspan="7" class="printbawah printkanan">Atas Beban Sekertariat DPRD Kabupaten Sidoarjo Rekening <?php echo $model->nama_kegiatan.' ( '.$model->rekening.' ) '; ?> </td>
  </tr>
  <tr class="isi">
    <td valign="top" align="center" class="printkiri">8.</td>
    <td valign="top" >Keterangan</td>
    <td valign="top" class="printkiri">:</td>
    <td colspan="7" class="printkanan" >Surat Perintah No : <?php echo $model->no_spt; ?> </td>
  </tr>
  <tr class="isi">
    <td colspan="2" class="printbawah printkiri">&nbsp;</td>
    <td class="printbawah printkiri">&nbsp;</td>
    <td colspan="7" class="printbawah printkanan">Tanggal : <?php echo  is_null($model->tgl_surat) ? '' : tanggal_indo($model->tgl_surat, false); ?></td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr class="isi">
    <td >&nbsp; </td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td width="89" align="left">Ditetapkan di </td>
    <td width="9" align="center">:</td>
    <td width="116">S I D O A R J O</td>
  </tr>
  <tr class="isi">
    <td >&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td align="left">Pada Tanggal</td>
    <td align="center">:</td>
    <td>
         <?php echo  is_null($model->tgl_surat) ? '' : tanggal_indo($model->tgl_surat, false); ?>
    </td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="4">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr class="isi">
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td  >&nbsp;</td>
    <td colspan="7" align="center"><?=strtoupper($model->penandatangan->nama_pangkat); ?> DEWAN PERWAKILAN RAKYAT DAERAH</td>
  </tr>
  <tr class="isi">
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="7" align="center">KABUPATEN SIDOARJO</td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="10">&nbsp;</td>
  </tr>

  <tr class="isi">
    <td colspan="2" >&nbsp;</td>
    <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td colspan="7" align="center"><?php echo $model->penanda_tangan; ?></td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
  <tr>
    <td  colspan="10">&nbsp;</td>
  </tr>
</table>


<?php
    } ?>

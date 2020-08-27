<?php
  $tgl = date("dmYHis")."_".round(microtime(true) * 1000);
  $ins = strtoupper($p2hp->nm_instansi);
  $kec = "KECAMATAN ". strtoupper($p2hp->nm_kec);
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=P2HP-[$ins]-[$kec]-[$tgl].doc");
?>

<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
    <style>
    	.c {text-align: center}
      .b {font-weight: bold}

      #kop_header1 {border-bottom: 3px double #000}
      #kop_header2 {border-bottom: 3px double #000}
      .border {border-bottom: 2px solid #000}
      .pos-atas {vertical-align: top}
      td {vertical-align: top}
      .f13 {font-size: 13}
      h4 {text-align: center}
    </style>
  </head>

  <body>
    <table width="100%" border="0">
    	<tr>
    		<td class="c" rowspan="3" id="kop_header1"> <img src="<?= base_url(); ?>assets/images/logo2.png" width='70' height='70'> </td>
    		<td class="c"> <h3>PEMERINTAH KOTA PARIAMAN</h3> </td>
    	</tr>

    	<tr><td class="c b"> <h2>INSPEKTORAT</h2> </td></tr>
    	<tr><td class="c" id="kop_header2">  <p class="f13"> Alamat : Jl. Rohana Kudus No. 44 Kampung Baru, Kota Pariaman. <br>Telp : (0751) 93652, Fax : (0751) 91557 </p> </td></tr>
    </table>

    <h4>
      POKOK-POKOK HASIL PEMERIKSAAN (P2HP) <br/>
      <?= strtoupper($p2hp->nm_instansi) ." KECAMATAN ". strtoupper($p2hp->nm_kec) ." KOTA PARIAMAN <br/>"; ?>
      TAHUN ANGGARAN <?= date('Y'); ?>
    </h4> <br/>

    <label>
      Sesuai dengan Surat Perintah Pemeriksaan dari Inspektur Kota Pariaman Nomor : <?= $tgs->no_st; ?> tanggal <?= $tgl_surat; ?> untuk melaksanakan pemeriksaan di <?= ucwords($p2hp->nm_instansi) ." Kecamatan ". $p2hp->nm_kec ." Kota Pariaman"; ?> mulai Tanggal <?= $tgl_awal ." s.d ". $tgl_akhir; ?>.
    </label>

  </body>
</html>
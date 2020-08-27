<?php
  $tgl = date("dmYHis")."_".round(microtime(true) * 1000);
  $ins = strtoupper($lhp->nm_instansi);
  $kec = "KECAMATAN ". strtoupper($lhp->nm_kec);
  //if($lhp->nm_instansi != '-'){ $nm_instansi = "[$lhp->nm_instansi]-[$lhp->no_lhp]-[$tgl]"; } else { $nm_instansi = "[$lhp->no_lhp]-[$tgl]"; } 
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=LHP-[$lhp->no_lhp]-[$ins]-[$kec]-[$tgl].doc");
?>

<html>
  <head>
    <meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
    <style>
    	.c {text-align: center}
      .b {font-weight: bold}

      #kop_header1 {border-bottom: 3px double #000}
      #kop_header2 {border-bottom: 3px double #000}
      .border {border-bottom: 1px solid #000}
      .pos-atas {vertical-align: top}
      td {vertical-align: top}
      .f13 {font-size: 13}
      h4 {text-align: center}
    </style>
  </head>

  <body>
    <h4 class="border">
      LAPORAN HASIL PEMERIKSAAN <br/>
      PADA <?= $lhp->nm_instansi ." KECAMATAN ". $lhp->nm_kec ." TAHUN ". date('Y'); ?>
    </h4> <br/>   

    <table width="100%" class="border">
      <tr>
        <td width="26%"></td>
        <td width="20%"> Nomor LHP </td>
        <td width="2%"> : </td>
        <td> <?= $lhp->no_lhp; ?> </td>
      </tr>

      <tr>
        <td></td>
        <td> Tanggal </td>
        <td> : </td>
        <td> <?= date('d') ." ". get_nama_bulan(date('m')) ." ". date('Y'); ?> </td>
      </tr>
    </table>

  </body>
</html>
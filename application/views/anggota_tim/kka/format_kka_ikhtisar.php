<?php
 	$tgl = date("dmYHis")."_".round(microtime(true) * 1000);
  $kka = $sub_pka2->no_kka;
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=KKA-IKHTISAR-[$kka]-[$tgl].doc");
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

    <table width="100%" border="0">
      <tr>
        <td width="16%"> <p class="f13"> Nama Auditan </p> </td>
        <td width="2%"> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $tgs->nama_kp; ?> </p> </td>

        <td width="3%"> </td>

        <td width="15%"> <p class="f13"> No. Hal </p> </td>
        <td width="2%"> <p class="f13"> : </p> </td>
        <td width="25%"> <p class="f13"> 1 </p> </td>
      </tr>

       <tr>
        <td> <p class="f13"> Sasaran Auditan </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $tgs->sasaran_peng; ?> </p> </td>

        <td> </td>

        <td> <p class="f13"> No. KKA </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $sub_pka2->no_kka; ?> </p> </td>
      </tr>

       <tr>
        <td> <p class="f13"> Periode Audit </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $pka->masa_periksa; ?> </p> </td>

        <td> </td>

        <?php $jml_penyusun = count($penyusun); ?>

        <td> <p class="f13"> Disusun Oleh </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> 
            <?php 
              if($jml_penyusun != 1)
              {
                foreach($penyusun as $row)
                { echo $row->nama .", "; }
              } else { foreach($penyusun as $row) { echo $row->nama; } }
            ?> 
        </p> </td>
      </tr>

      <tr>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td> &nbsp; </td>

        <td> </td>

        <td> <p class="f13"> Tanggal/Paraf </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> </td>
      </tr>

      <tr>
        <td> <p class="f13"> Waktu Audit </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $tgl_awal ." s/d ". $tgl_akhir; ?> </p> </td>

        <td> </td>

        <td> <p class="f13"> Direviu Oleh </p> </td>
        <td> <p class="f13"> : </p> </td>
        <td> <p class="f13"> <?= $ketua_tim->nama; ?> </p> </td>
      </tr>

      <tr>
        <td class="border"> <p class="f13"> Surat Tugas </p> </td>
        <td class="border"> <p class="f13"> : </p> </td>
        <td class="border"> <p class="f13"> <?= $tgs->no_st; ?> </p> </td>

        <td class="border"> </td>

        <td class="border"> <p class="f13"> Tanggal/Paraf </p> </td>
        <td class="border"> <p class="f13"> : </p> </td>
        <td class="border"> </td>
      </tr>      
    </table>

    <h4> 
      KERTAS KERJA PENGAWASAN IKHTISAR <br/>
    </h4>

    <h5> A. KESIMPULAN PENGAWASAN </h5> <br/>
    <h5> B. KRITERIA </h5> <br/>
    <h5> C. SEBAB </h5> <br/>
    <h5> D. AKIBAT </h5> <br/>
    <h5> E. TANGGAPAN PEJABAT </h5> <br/>
    <h5> F. REKOMENDASI </h5> <br/>

  </body>
</html>
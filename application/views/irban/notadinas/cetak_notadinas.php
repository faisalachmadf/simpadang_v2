<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="icon" type="image/png" href="./assets/images/icon.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

        <title> Nota Dinas :  <?= $notadinass['nomor']; ?></title>

        <!-- Bootstrap -->
        <style type="text/css">
            body { font-family: times new roman }
            th {padding: 3px; text-align: center}
            td {padding: 2px; font-size: 13}

            .kop_header {margin-top:5px; border-bottom: 3px double #000}
            .kop_header2 {margin-top:2px; border-bottom: 1px double #000}
            .j {text-align: justify}
            .c {text-align: center}
            .b {font-weight: bold}
            .u {text-decoration: underline}
            .pad-10 {padding: 10px}
            .pad-top-10 {padding-top: 13px}
            .pad-b-5 {margin-bottom: -25px}
            .pad-l-30 {padding-left: 30px}
            .pos-atas {vertical-align: top}
            .pos-bawah {vertical-align: bottom}
            .ls-5 {letter-spacing: 5px}

            .f11 {font-size: 13}
            .f15 {font-size: 15}
            .f16 {font-size: 16}
            .f18 {font-size: 18}
            .f21 {font-size: 14}
            .f23 {font-size: 23}
            .f27 {font-size: 26}
        </style>
    </head>

    <body>
        <table width="100%">
            <thead>
                <tr>
                    <th width="16%"></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="c "><img src="./assets/images/logo2.png" width="85" height="91"></td>
                    <td class="c b">
                        <p class="f21" style="font-size: 14"> PEMERINTAH KOTA PARIAMAN </p>
                        <p class="f27" style="font-size: 26"> INSPEKTORAT </p>
                        <p class="f11"> Jl. Rohana Kudus No. 44 Kampung Baru Kota Pariaman
                            Telp./Fax. (0751) 91557
                        </p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="kop_header"></div> 

        <p class="f16 b c  pad-b-5" align="center"> NOTA DINAS </p> <br/>
        <br/><br>
        <table width="100%" border="0" >
            <thead>
                <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Kepada</th>
                    <th width="4%" style="font-weight: lighter;" >:</th>
                    <th style="text-align: left; font-weight: lighter;">Sdr/Sdri.  <?= $notadinass['ketua']; ?></th>
                </tr>
                 <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Dari</th>
                    <th width="4%" style="font-weight: lighter;" >:</th>
                    <th style="text-align: left; font-weight: lighter;"><?= $notadinass['irban']; ?></th>
                </tr>
                 <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Nomor</th>
                    <th width="4%" style="font-weight: lighter;" >:</th>
                    <th style="text-align: left; font-weight: lighter;"> <?= $notadinass['nomor']; ?></th>
                </tr>
                <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Tanggal</th>
                    <th width="4%" style="font-weight: lighter;" >:</th> 
                    <th style="text-align: left; font-weight: lighter;"> <?= $notadinass['tgl']; ?></th>
                </tr>
                <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Lampiran</th>
                    <th width="4%" style="font-weight: lighter;" >:</th>
                    <th style="text-align: left; font-weight: lighter;"> <?= $notadinass['lampiran']; ?></th>
                </tr>
                <tr>
                    
                    <th width="13%" style="text-align: left; font-weight: lighter;">Hal</th>
                    <th width="4%" style="font-weight: lighter;" >:</th>
                    <th style="text-align: left; font-weight: lighter;"> <?= $notadinass['hal']; ?></th>
                </tr>
            </thead>
        </table>
        <div class="kop_header2"></div> 
        
        <br/>

        <table width="100%" border="0">
            <thead>
                <tr>
                    
                    <th  style="text-align: justify; font-weight: lighter; line-height: 2;"><?= $notadinass['isi_nota']; ?></th>
                    
                </tr>
            </thead>
        </table>

        <br/><br/><br/>
        <table>
            <thead>
                <tr>
                    <td width="95%" ></td>
                    <td colspan="2" class="c b" style="text-transform:uppercase;" width="1%"><?= $notadinass['jabatan']; ?>,</td>
                </tr>


                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
<!-- 
                <tr>
                    <td></td>
                    <td colspan="2" class="c"><img src="./assets/verifikasi/<?= $data->ttd; ?>" width="210" height="80"></td>
                </tr> -->


                <tr>
                    <td width="90%" ></td>
                    <td colspan="2" class="c u b" width="5%"><?= $notadinass['irban']; ?></td>
                </tr>

                <tr>
                    <td width="90%" ></td>
                    <td colspan="2" class="c" width="5%">NIP. <?= $notadinass['nip']; ?></td>
                </tr>
            </thead>
        </table>

        <!-- ################## -->
        <!-- #### NEW PAGE #### -->
        <!-- ################## -->

       <?php
        if ($data->stat_sasaran == "pilih") {
            if($jml_sas->jml > 5)
            {
            }

            ?> 

        <pagebreak resetpagenum="1" pagenumstyle="1" suppress="" />

        <table width="100%" border="0">
            <tr>
                <td></td>
                <td width="24%">&nbsp;</td>
                <td width="24%"></td>
            </tr>

            <tr>
                <td class="b u">LAMPIRAN</td>
                <td colspan="2" align="right">Nomor Nota Dinas : <?= $notadinass->nomor; ?></td>
            </tr>

            <tr><td colspan="3">&nbsp;</td></tr>

            <tr><td colspan="3">Berikut nama-nama instansi yang menjadi sasaran pengawasan :</td></tr>

            <tr>
                <?php
                foreach ($sasaran as $row) {
                    if ($row->sasaran != NULL) {
                        echo "
						<tr><td colspan='3' class='pad-l-30'> $row->nomor. $row->sasaran </td></tr>";
                    }
                }
                ?>
            </tr>

            <tr><td colspan="3">&nbsp;</td></tr>

            <tr>
                <td></td>
                <td colspan="2">DIKELUARKAN DI : P A R I A M A N/td>
            </tr>

            <tr>
                <td></td>
                <td colspan="2" class="u">PADA TANGGAL &nbsp;&nbsp;  : <?= $tanggal_notadinas; ?></td>
            </tr>

            <tr><td colspan="3">&nbsp;</td></tr>

            <tr>
                <td></td>
                <td colspan="2" class="c">IRBAN,</td>
            </tr>

   <!--  <?php if ($data->ttd == NULL) { ?>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
                <tr><td colspan="3">&nbsp;</td></tr>
    <?php } else { ?>
                <tr>
                    <td></td>
                    <td colspan="2" class="c"><img src="./assets/verifikasi/<?= $data->ttd; ?>" width="210" height="80"></td>
                </tr>
    <?php } ?> -->

           <!--  <tr>
                <td></td>
                <td colspan="2" class="c u b"><?= $data->nama_inspektur; ?></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="2" class="c">NIP. <?= $data->nip_inspektur; ?></td>
            </tr>
        </table>  -->

<?php } //}	  ?>		

</body>
</html>
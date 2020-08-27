<?php
//--> include data header
$this->load->view('layout/header');
?>

<style type="text/css">
    .u {text-decoration: underline}
    .i {font-style: italic}
    .b {font-weight: bold}
    .c {text-align: center}
    .r {text-align: right;}
    .j {text-align: justify}

    .pos-atas {vertical-align: top}

    .pad-3 {padding: 5px}
    .pad-10 {padding: 10px}

    .bg-color  {background-color: #f1f6a3}
    .bg-color2 {background-color: #ef0d0d}
    .bg-color3 {background-color: #cdcdcd}
    .bg-color4 {background-color: #685cdf}
    .bg-color5 {background-color: #1faeff}
    .color-white {color:white;}

    .modal-width {width: 80%}

    td {padding: 5px}
</style>

<?php
//--> include data top navigasi
$this->load->view('layout/top_nav');
//--> include data sidebar navigasi
$this->load->view('layout/nav_sidebar');
?>
<div class="main-content">
    <div class="main-content-inner">

        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="<?= site_url('ketua_tim/home'); ?>"> Home </a>
                </li>
                <li>
                    <a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>"> Anggaran Waktu </a>
                </li>
                <li class="active"> Detail Anggaran Waktu </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Detail Anggaran Waktu
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Melihat rincian data alokasi anggaran waktu audit
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <!-- notifikasi -->
            <div><?= $this->session->flashdata("sukses"); ?></div>

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="widget-box">
                        <div class="widget-body">
                            <div class="widget-main">

                                <div class="row">

                                    <div class="col-sm-5">
                                        <h3 class="header">
                                            <i class="fa fa-file-text"></i> Data Alokasi Anggaran Waktu
                                        </h3>

                                        <dl id="dt-list-1" class="dl-horizontal">

                                            <?php
                                            ## keterangan :
                                            // des : jumlah desimal,
                                            // pd  : pemisah desimal,
                                            // pr  : pemisah ribuan
                                            $des = "0";
                                            $pd = ",";
                                            $pr = ".";
                                            ?>

                                            <dt> Nama Objek Audit : </dt>
                                            <dd align="justify"><?= $data->nama_op; ?></dd>

                                            <br/>

                                            <dt> Kegiatan yang di Audit : </dt>
                                            <dd align="justify"><?= $data->nama_kp; ?></dd>
                                        </dl>

                                        <?php if ($cek_rev > 0) { ?>
                                            <h3 class="header">
                                                <i class="fa fa-retweet"></i> Riwayat Reviu								
                                            </h3>

                                            <table width="100%" border="1">
                                                <tr>
                                                    <th class="bg-color5 c" width="6%"> No </th>															
                                                    <th class="bg-color5 c"> Tanggal Reviu </th>
                                                    <th class="bg-color5 c" width="16%"> Reviu Ke </th>
                                                    <th class="bg-color5 c" width="12%"> Dalnis </th>
                                                    <!-- <th class="bg-color5 c" width="12%"> Daltu </th> -->
                                                    <th class="bg-color5 c" width="10%"> Aksi </th>
                                                </tr>

                                                <?php
                                                $no = 1;
                                                foreach ($data_rev as $row) {
                                                    $tgl_rev = date('d', strtotime($row->tgl_reviu)) . " " .
                                                            get_nama_bulan(date('m', strtotime($row->tgl_reviu))) . " " .
                                                            date('Y', strtotime($row->tgl_reviu)) . " | " . date('H:i:s', strtotime($row->tgl_reviu));

                                                    if ($row->rev_dalnis == "-") {
                                                        $rev_dalnis = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>";
                                                    } else {
                                                        $rev_dalnis = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>";
                                                    }

                                                    /* if($row->rev_daltu == "-")
                                                      { $rev_daltu = "<i class='fa fa-check bigger-130 green' title='Tidak ada reviu'></i>"; }
                                                      else
                                                      {	$rev_daltu = "<i class='fa fa-times bigger-130 red' title='Terdapat reviu'></i>"; } */

                                                    echo "
																<tr>
																	<td class='c'> $no </td>
																	<td class='c'> $tgl_rev </td>
																	<td class='c'> $row->rev_ke </td>
																	<td class='c'> $rev_dalnis </td>
																	
																	<td class='c'>
																		<a href='" . site_url('ketua_tim/anggaran_waktu/detail_reviu/' . base64_encode($row->rev_agr1) . '/' . base64_encode($row->rev_ke)) . "' title='Detail Reviu'> <i class='fa fa-eye bigger-130'></i> </a>
																	</td>
																</tr>
																";
                                                    $no++;
                                                }
                                                ?>
                                            </table>
                                        <?php } ?>
                                    </div>

                                    <div class="col-sm-7">
                                        <h3 class="header">
                                            <i class="fa fa-bars"></i> Aksi Pilihan													
                                        </h3>

                                        <center>
                                            <a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
                                            &nbsp;&nbsp;
                                            <button class="btn btn-sm btn-success" id='reset_' data-waktu='<?php echo $data->id_anggaran_wkt ?>' data-tugas='<?php echo $data->id_tgs ?>'><i class="fa fa-refresh"> Reset</i></button>
                                            &nbsp;&nbsp;

                                            <?php if ($data->keputusan_agr != 'belum') { ?>
                                                <a href="<?= site_url('ketua_tim/anggaran_waktu/cetak_anggaran_waktu/' . base64_encode($data->id_anggaran_wkt)); ?>" class="btn btn-sm btn-danger" target="_blank">
                                                    <i class="fa fa-print"></i> Cetak Alokasi Anggaran Waktu 
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="<?= site_url('ketua_tim/anggaran_waktu/cetak_kartu_penugasan/' . base64_encode($data->id_anggaran_wkt)); ?>" class="btn btn-sm btn-danger" target="_blank">
                                                    <i class="fa fa-print"></i> Cetak Kartu Penugasan 
                                                </a>

                                            <?php } else { ?>
                                                <a href="#" class="btn btn-sm btn-danger disabled">
                                                    <i class="fa fa-print"></i> Cetak Alokasi Anggaran Waktu 
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="#" class="btn btn-sm btn-danger disabled">
                                                    <i class="fa fa-print"></i> Cetak Kartu Penugasan 
                                                </a>
                                            <?php } ?>
                                        </center>

                                        <h3 class="header">
                                            <i class="fa fa-recycle"></i> Hasil Reviu										
                                        </h3>

                                        <table width="100%" border="0">
                                            <tr>
                                                <td width="19%" class="pos-atas"> Reviu DALNIS </td>
                                                <td width="3%" class="pos-atas"> : </td>
                                                <td> 
                                                    <?php
                                                    if ($data->reviu_dalnis == NULL) {
                                                        echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>";
                                                    } elseif ($data->reviu_dalnis == "-") {
                                                        echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>";
                                                    } else {
                                                        echo "<span class='red'><strong> $data->reviu_dalnis </strong></span>";
                                                    }
                                                    ?> 
                                                </td>
                                            </tr>

                                                                                                                <!-- <tr>
                                                                                                                        <td class="pos-atas"> Reviu DALTU </td>
                                                                                                                        <td class="pos-atas"> : </td>
                                                                                                                        <td>
                                            <?php
                                            if ($data->reviu_daltu == NULL) {
                                                echo "<i class='fa fa-spinner fa-pulse orange'></i> <strong class='orange i'> Belum Direviu </strong>";
                                            } elseif ($data->reviu_daltu == "-") {
                                                echo "<i class='fa fa-check green'><strong> Tidak ada reviu </strong></i>";
                                            } else {
                                                echo "<span class='red'><strong> $data->reviu_daltu </strong></span>";
                                            }
                                            ?> 
                                                                                                                        </td>
                                                                                                                </tr> -->

                                            <?php
                                            if ($data->reviu_dalnis != NULL) { //&& $data->reviu_daltu != NULL) {
                                                if ($data->reviu_dalnis != "-") { //|| $data->reviu_daltu != "-") {
                                                    ?>
                                                    <tr>
                                                        <td colspan="3"><a href="<?= site_url('ketua_tim/anggaran_waktu/reviu_anggaran_waktu/' . base64_encode($data->id_anggaran_wkt) . '/' . base64_encode($data->id_tgs) . '/' . base64_encode($data->id_tim)) ?>" class="btn btn-sm btn-success"><i class='fa fa-edit'></i> Reviu Anggaran</a></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </table>

                                    </div>
                                </div> <br/>

                                <table width="100%" border="1">
                                    <tr>
                                        <th width="30%" class="c bg-color pad-10">PERSIAPAN</th>
                                        <th class="c bg-color pad-10">PELAKSANAAN</th>
                                        <th width="30%" class="c bg-color pad-10">PENYELESAIAN</th>
                                    </tr>	

                                    <tr>
                                        <td class="c"><?=
                                            $tgl1_1;
                                            if ($data->tgl2_persiapan != NULL) {
                                                echo " s/d $tgl2_1";
                                            }
                                            ?></td>
                                        <td class="c"><?=
                                            $tgl1_2;
                                            if ($data->tgl2_pelaksanaan != NULL) {
                                                echo " s/d $tgl2_2";
                                            }
                                            ?></td>
                                        <td class="c"><?=
                                            $tgl1_3;
                                            if ($data->tgl2_penyelesaian != NULL) {
                                                echo " s/d $tgl2_3";
                                            }
                                            ?></td>
                                    </tr>											
                                </table>

                                <br/>

                                <table width="100%" border="1">
                                    <tr>
                                        <th width="5%"></th>
                                        <th></th>
                                        <th width="13%"></th>
                                        <th width="13%"></th>
                                        <th width="13%"></th>
                                        <th width="13%"></th>
                                        <th width="13%"></th>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="c b bg-color"> JENIS KEGIATAN </td>
                                        <td class="c b bg-color">WAKIL PENANGGUNG JAWAB <br/> (HP/Jam)</td>
                                        <td class="c b bg-color">PENGENDALI TEKNIS <br/> (HP/Jam)</td>
                                        <td class="c b bg-color">KETUA TIM <br/> (HP/Jam)</td>
                                        <td class="c b bg-color">ANGGOTA TIM <br/> (HP/Jam)</td>
                                        <td class="c b bg-color">JUMLAH <br/> (HP/Jam)</td>
                                    </tr>

                                    <tr><td colspan="7">&nbsp;</td></tr>
                                    <tr>
                                        <td colspan="2"><i class='fa fa-circle'></i> PERSIAPAN AUDIT :</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <?php
                                    $no1 = 1;
                                    foreach ($anggaran as $row) {
                                        if ($row->kategori == "1") {
                                            if ($row->tugas_daltu == "aktif") {
                                                $daltu = $row->hari_daltu . " ( $row->jam_daltu )";
                                            } else {
                                                $daltu = "-";
                                            }

                                            if ($row->tugas_dalnis == "aktif") {
                                                $dalnis = $row->hari_dalnis . " ( $row->jam_dalnis )";
                                            } else {
                                                $dalnis = "-";
                                            }

                                            if ($row->tugas_ketua == "aktif") {
                                                $ketua = $row->hari_ketua . " ( $row->jam_ketua )";
                                            } else {
                                                $ketua = "-";
                                            }

                                            if ($row->tugas_anggota == "aktif") {
                                                $anggota = $row->hari_anggota . " ( $row->jam_anggota )";
                                            } else {
                                                $anggota = "-";
                                            }

                                            echo "
															<tr>
																<td align='center'> $no1). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
                                            $no_sub = $row->kategori;

                                            $sub_hri1 += $row->hari_daltu;
                                            $sub_hri_daltu1 = number_format($sub_hri1, 2);
                                            $sub_jam1 += $row->jam_daltu;
                                            $sub_jam_daltu1 = number_format($sub_jam1, 2);

                                            $sub_hri2 += $row->hari_dalnis;
                                            $sub_hri_dalnis1 = number_format($sub_hri2, 2);
                                            $sub_jam2 += $row->jam_dalnis;
                                            $sub_jam_dalnis1 = number_format($sub_jam2, 2);

                                            $sub_hri3 += $row->hari_ketua;
                                            $sub_hri_ketua1 = number_format($sub_hri3, 2);
                                            $sub_jam3 += $row->jam_ketua;
                                            $sub_jam_ketua1 = number_format($sub_jam3, 2);

                                            $sub_hri4 += $row->hari_anggota;
                                            $sub_hri_anggota1 = number_format($sub_hri4, 2);
                                            $sub_jam4 += $row->jam_anggota;
                                            $sub_jam_anggota1 = number_format($sub_jam4, 2);

                                            $sub_hri5 = $sub_hri_daltu1 + $sub_hri_dalnis1 + $sub_hri_ketua1 + $sub_hri_anggota1;
                                            $sub_hri_1 = number_format($sub_hri5, 2);
                                            $sub_jam5 = $sub_jam_daltu1 + $sub_jam_dalnis1 + $sub_jam_ketua1 + $sub_jam_anggota1;
                                            $sub_jam_1 = number_format($sub_jam5, 2);
                                        }
                                        $no1++;
                                    }

                                    echo "<tr>
																	<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_daltu1 ( $sub_jam_daltu1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_dalnis1 ( $sub_jam_dalnis1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_ketua1 ( $sub_jam_ketua1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_anggota1 ( $sub_jam_anggota1 ) </td>
																	<td class='c b bg-color4 color-white'> $sub_hri_1 ( $sub_jam_1 ) </td>
																</tr>";

                                    echo "<tr>
																	<td colspan='2'><i class='fa fa-circle'></i> PELAKSANAAN AUDIT :</td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>";

                                    $no2 = 1;
                                    foreach ($anggaran as $row) {
                                        if ($row->kategori == "2") {
                                            if ($row->tugas_daltu == "aktif") {
                                                $daltu = $row->hari_daltu . " ( $row->jam_daltu )";
                                            } else {
                                                $daltu = "-";
                                            }

                                            if ($row->tugas_dalnis == "aktif") {
                                                $dalnis = $row->hari_dalnis . " ( $row->jam_dalnis )";
                                            } else {
                                                $dalnis = "-";
                                            }

                                            if ($row->tugas_ketua == "aktif") {
                                                $ketua = $row->hari_ketua . " ( $row->jam_ketua )";
                                            } else {
                                                $ketua = "-";
                                            }

                                            if ($row->tugas_anggota == "aktif") {
                                                $anggota = $row->hari_anggota . " ( $row->jam_anggota )";
                                            } else {
                                                $anggota = "-";
                                            }

                                            echo "
															<tr>
																<td align='center'> $no2). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
                                            $no_sub = $row->kategori;

                                            $sub_hri11 += $row->hari_daltu;
                                            $sub_hri_daltu2 = number_format($sub_hri11, 2);
                                            $sub_jam11 += $row->jam_daltu;
                                            $sub_jam_daltu2 = number_format($sub_jam11, 2);

                                            $sub_hri22 += $row->hari_dalnis;
                                            $sub_hri_dalnis2 = number_format($sub_hri22, 2);
                                            $sub_jam22 += $row->jam_dalnis;
                                            $sub_jam_dalnis2 = number_format($sub_jam22, 2);

                                            $sub_hri33 += $row->hari_ketua;
                                            $sub_hri_ketua2 = number_format($sub_hri33, 2);
                                            $sub_jam33 += $row->jam_ketua;
                                            $sub_jam_ketua2 = number_format($sub_jam33, 2);

                                            $sub_hri44 += $row->hari_anggota;
                                            $sub_hri_anggota2 = number_format($sub_hri44, 2);
                                            $sub_jam44 += $row->jam_anggota;
                                            $sub_jam_anggota2 = number_format($sub_jam44, 2);

                                            $sub_hri55 = $sub_hri_daltu2 + $sub_hri_dalnis2 + $sub_hri_ketua2 + $sub_hri_anggota2;
                                            $sub_hri_2 = number_format($sub_hri55, 2);
                                            $sub_jam55 = $sub_jam_daltu2 + $sub_jam_dalnis2 + $sub_jam_ketua2 + $sub_jam_anggota2;
                                            $sub_jam_2 = number_format($sub_jam55, 2);

                                            $no2++;
                                        }
                                    }

                                    echo "
														<tr>
															<td colspan='2' class='c b bg-color3'> Sub Jumlah $no_sub </td>
															<td class='c b bg-color4 color-white'> $sub_hri_daltu2 ( $sub_jam_daltu2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_dalnis2 ( $sub_jam_dalnis2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_ketua2 ( $sub_jam_ketua2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_anggota2 ( $sub_jam_anggota2 ) </td>
															<td class='c b bg-color4 color-white'> $sub_hri_2 ( $sub_jam_2 ) </td>
														</tr>

														<tr>
															<td colspan='2'><i class='fa fa-circle'></i> PENYELESAIAN AUDIT :</td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
															<td></td>
														</tr>";

                                    $no3 = 1;
                                    foreach ($anggaran as $row) {
                                        if ($row->kategori == "3") {
                                            if ($row->tugas_daltu == "aktif") {
                                                $daltu = $row->hari_daltu . " ( $row->jam_daltu )";
                                            } else {
                                                $daltu = "-";
                                            }

                                            if ($row->tugas_dalnis == "aktif") {
                                                $dalnis = $row->hari_dalnis . " ( $row->jam_dalnis )";
                                            } else {
                                                $dalnis = "-";
                                            }

                                            if ($row->tugas_ketua == "aktif") {
                                                $ketua = $row->hari_ketua . " ( $row->jam_ketua )";
                                            } else {
                                                $ketua = "-";
                                            }

                                            if ($row->tugas_anggota == "aktif") {
                                                $anggota = $row->hari_anggota . " ( $row->jam_anggota )";
                                            } else {
                                                $anggota = "-";
                                            }

                                            echo "
															<tr>
																<td align='center'> $no3). </td>
																<td> $row->jenis_pekerjaan </td>
																<td class='pad-3 c'> $daltu </td>
																<td class='pad-3 c'> $dalnis </td>
																<td class='pad-3 c'> $ketua </td>
																<td class='pad-3 c'> $anggota </td>
																<td class='pad-3 c'> $row->jml_hari ( $row->jml_jam ) </td>
															</tr>
															";
                                            $no_sub = $row->kategori;

                                            $sub_hri111 += $row->hari_daltu;
                                            $sub_hri_daltu3 = number_format($sub_hri111, 2);
                                            $sub_jam111 += $row->jam_daltu;
                                            $sub_jam_daltu3 = number_format($sub_jam111, 2);

                                            $sub_hri222 += $row->hari_dalnis;
                                            $sub_hri_dalnis3 = number_format($sub_hri222, 2);
                                            $sub_jam222 += $row->jam_dalnis;
                                            $sub_jam_dalnis3 = number_format($sub_jam222, 2);

                                            $sub_hri333 += $row->hari_ketua;
                                            $sub_hri_ketua3 = number_format($sub_hri333, 2);
                                            $sub_jam333 += $row->jam_ketua;
                                            $sub_jam_ketua3 = number_format($sub_jam333, 2);

                                            $sub_hri444 += $row->hari_anggota;
                                            $sub_hri_anggota3 = number_format($sub_hri444, 2);
                                            $sub_jam444 += $row->jam_anggota;
                                            $sub_jam_anggota3 = number_format($sub_jam444, 2);

                                            $sub_hri555 = $sub_hri_daltu3 + $sub_hri_dalnis3 + $sub_hri_ketua3 + $sub_hri_anggota3;
                                            $sub_hri_3 = number_format($sub_hri555, 2);
                                            $sub_jam555 = $sub_jam_daltu3 + $sub_jam_dalnis3 + $sub_jam_ketua3 + $sub_jam_anggota3;
                                            $sub_jam_3 = number_format($sub_jam555, 2);

                                            $no3++;
                                        }
                                    }

                                    $hr_daltu = $sub_hri_daltu1 + $sub_hri_daltu2 + $sub_hri_daltu3;
                                    $tot_hri_daltu = number_format($hr_daltu, 2);
                                    $jm_daltu = $sub_jam_daltu1 + $sub_jam_daltu2 + $sub_jam_daltu3;
                                    $tot_jam_daltu = number_format($jm_daltu, 2);

                                    $hr_dalnis = $sub_hri_dalnis1 + $sub_hri_dalnis2 + $sub_hri_dalnis3;
                                    $tot_hri_dalnis = number_format($hr_dalnis, 2);
                                    $jm_dalnis = $sub_jam_dalnis1 + $sub_jam_dalnis2 + $sub_jam_dalnis3;
                                    $tot_jam_dalnis = number_format($jm_dalnis, 2);

                                    $hr_ketua = $sub_hri_ketua1 + $sub_hri_ketua2 + $sub_hri_ketua3;
                                    $tot_hri_ketua = number_format($hr_ketua, 2);
                                    $jm_ketua = $sub_jam_ketua1 + $sub_jam_ketua2 + $sub_jam_ketua3;
                                    $tot_jam_ketua = number_format($jm_ketua, 2);

                                    $hr_anggota = $sub_hri_anggota1 + $sub_hri_anggota2 + $sub_hri_anggota3;
                                    $tot_hri_anggota = number_format($hr_anggota, 2);
                                    $jm_anggota = $sub_jam_anggota1 + $sub_jam_anggota2 + $sub_jam_anggota3;
                                    $tot_jam_anggota = number_format($jm_anggota, 2);

                                    $tot_hri = $tot_hri_daltu + $tot_hri_dalnis + $tot_hri_ketua + $tot_hri_anggota;
                                    $jml_tot_hri = number_format($tot_hri, 2);
                                    $tot_jam = $tot_jam_daltu + $tot_jam_dalnis + $tot_jam_ketua + $tot_jam_anggota;
                                    $jml_tot_jam = number_format($tot_jam, 2);
                                    ?>

                                    <tr>
                                        <td colspan='2' class='c b bg-color3'> <?= "Sub Jumlah " . $no_sub; ?> </td>
                                        <td class='c b bg-color4 color-white'> <?= $sub_hri_daltu3 . " ( $sub_jam_daltu3 )"; ?> </td>
                                        <td class='c b bg-color4 color-white'> <?= $sub_hri_dalnis3 . " ( $sub_jam_dalnis3 )"; ?> </td>
                                        <td class='c b bg-color4 color-white'> <?= $sub_hri_ketua3 . " ( $sub_jam_ketua3 )"; ?> </td>
                                        <td class='c b bg-color4 color-white'> <?= $sub_hri_anggota3 . " ( $sub_jam_anggota3 )"; ?> </td>
                                        <td class='c b bg-color4 color-white'> <?= $sub_hri_3 . " ( $sub_jam_3 )"; ?> </td>
                                    </tr>

                                    <tr>
                                        <td colspan="2" class="c b"> JUMLAH HARI/JAM AUDIT YANG DIANGGARKAN </td>
                                        <td class='c b bg-color2 color-white'> <?= $tot_hri_daltu . " ( $tot_jam_daltu )"; ?> </td>
                                        <td class='c b bg-color2 color-white'> <?= $tot_hri_dalnis . " ( $tot_jam_dalnis )"; ?> </td>
                                        <td class='c b bg-color2 color-white'> <?= $tot_hri_ketua . " ( $tot_jam_ketua )"; ?> </td>
                                        <td class='c b bg-color2 color-white'> <?= $tot_hri_anggota . " ( $tot_jam_anggota )"; ?> </td>
                                        <td class='c b bg-color2 color-white'> <?= $jml_tot_hri . " ( $jml_tot_jam )"; ?> </td>
                                    </tr>								
                                </table>

                            </div>
                        </div>
                    </div>

                    <div id="modal-rev" class="modal fade" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger"> Reviu Anggaran Waktu</h4>
                                </div>

                                <div class="modal-body">
                                    <!-- ISI CONTEN -->
                                </div>

                                <div class="modal-footer">
                                    <button class="btn btn-sm" data-dismiss="modal">
                                        <i class="ace-icon fa fa-arrow-left"></i>
                                        Kembali
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->


<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>
<script type="text/javascript">
    $(function () {
        $('#reset_').click(function () {
            var param = {
                'waktu': $(this).data('waktu'),
                'tugas': $(this).data('tugas'),
            };
            swal({
                title: "Reset Anggaran waktu ? Jika PKA sudah terbuat, maka PKA juga akan terhapus!",
//                text: "Sok barang tidak memenuhi.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, tetap lanjutkan!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "<?php echo base_url('index.php/ketua_tim/anggaran_waktu/reset_anggaran_waktu') ?>",
                    dataType: 'JSON',
                    type: 'POST',
                    data: param,
                    success: function (e) {
                        swal("Deleted!", "Data telah di reset.!", "success");
                        setTimeout(function () {
                            window.location.replace("<?php echo base_url('index.php/ketua_tim/penugasan') ?>");
                        }, 500);

                    }
                })
            })
        })
    })
</script>
</body>
</html>
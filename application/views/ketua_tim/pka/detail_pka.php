<?php
//--> include data header
$this->load->view('layout/header');
?>

<style type="text/css">
    .u {text-decoration: underline}
    .b {font-weight: bold}
    .i {font-style: italic}
    .c {text-align: center}
    .r {text-align: right;}
    .j {text-align: justify}

    .pad-3 {padding: 5px}
    .bot-bor {border-bottom: 1px black solid}

    .bg-color  {background-color: #f1f6a3}
    .bg-color5 {background-color: #1faeff}

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
                    <a href="<?= site_url('ketua_tim/pka'); ?>"> Program Kerja Audit </a>
                </li>
                <li class="active"> Detail Program Kerja Audit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Detail Program Kerja Audit
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Melihat rincian data program kerja audit (PKA)
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
                                    <div class="col-sm-6">
                                        <h3 class="header">
                                            <i class="fa fa-file-text"></i> Data Program Kerja Audit
                                        </h3>
                                        <dl id="dt-list-1" class="dl-horizontal">
                                            <dt> Nama Objek Audit : </dt>
                                            <dd align="justify"><?= $data->nama_op; ?></dd>

                                            <dt> Sasaran : </dt>
                                            <dd align="justify"><?= $data->sasaran_peng; ?></dd>

                                            <dt> Masa yang diperiksa : </dt>
                                            <dd align="justify"><?= $data->masa_periksa; ?></dd>

                                            <dt> Waktu Pemeriksaan : </dt>
                                            <dd align="justify"><?= $tgl_awal . " s.d. " . $tgl_akhir; ?></dd>

                                            <dt> No. Ref. PKA : </dt>
                                            <dd align="justify"><?= $data->no_ref_pka; ?></dd>
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
																		<a href='" . site_url('ketua_tim/pka/detail_reviu/' . base64_encode($row->rev_pka1) . '/' . base64_encode($row->rev_ke)) . "' title='Detail Reviu'> <i class='fa fa-eye bigger-130'></i> </a>
																	</td>
																</tr>
																";
                                                    $no++;
                                                }
                                                ?>
                                            </table>
                                        <?php } ?>
                                    </div>

                                    <div class="col-sm-6">
                                        <h3 class="header">
                                            <i class="fa fa-bars"></i> Aksi Pilihan
                                        </h3>

                                        <center>
                                            <a href="<?= site_url('ketua_tim/pka'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
                                            &nbsp;&nbsp;
                                            <button class="btn btn-sm btn-success" id='reset_' data-id_pka='<?php echo $data->id_pka; ?>' data-tugas='<?php echo $data->id_tgs ?>'><i class="fa fa-refresh"> Reset</i></button>
                                            &nbsp;&nbsp;
                                            <?php if ($data->keputusan_pka != 'belum') { ?>
                                                <a href="<?= site_url('ketua_tim/pka/cetak_pka/' . base64_encode($data->id_pka)); ?>" class="btn btn-sm btn-danger" target="_blank">
                                                    <i class="fa fa-print"></i> Cetak P K A
                                                </a>
                                                &nbsp;&nbsp;
                                                <a href="<?= site_url('ketua_tim/pka/kka/' . base64_encode($data->id_pka)); ?>" class="btn btn-sm btn-primary">
                                                    <i class="fa fa-file-text-o"></i> Kertas Kerja Audit (KKA)
                                                </a>

                                            <?php } else { ?>
                                                <a href="#" class="btn btn-sm btn-danger disabled">
                                                    <i class="fa fa-print"></i> Cetak P K A
                                                </a>

                                                &nbsp;&nbsp;

                                                <a href="#" class="btn btn-sm btn-primary disabled">
                                                    <i class="fa fa-file-text-o"></i> Kertas Kerja Audit (KKA)
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
                                                        <td colspan="3"><a href="<?= site_url('ketua_tim/pka/reviu_pka/' . base64_encode($data->id_pka) . '/' . base64_encode($data->id_tgs) . '/' . base64_encode($data->id_tim)) ?>" class="btn btn-sm btn-success"><i class='fa fa-edit'></i> Reviu PKA</a></td>
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
                                        <th width="3%"></th>
                                        <th></th>
                                        <th width="35%"></th>
                                        <th width="9%"></th>
                                        <th width="9%"></th>
                                        <th width="13%"></th>
                                    </tr>

                                    <tr>
                                        <td class="c b bg-color"> No. </td>
                                        <td class="c b bg-color"> Uraian </td>
                                        <td class="c b bg-color"> Dilaksanakan Oleh </td>
                                        <td class="c b bg-color"> Waktu Pemeriksaan </td>
                                        <td class="c b bg-color"> No. KKA </td>
                                        <td class="c b bg-color"> Ket</td>
                                    </tr>

                                    <tr>
                                        <td > <h5 class='b'></h5> </td>
                                        <td colspan='5'> <h5 class='b u'> TUJUAN PROGRAM KERJA AUDIT</h5> </td>
                                    </tr>

                                    <?php
                                    $no = 1;
                                    foreach ($sub1 as $row) {
                                        if ($row->tujuan_pka != NULL) {
                                            echo "
															<tr>
																<td class='r'> $no. </td>
																<td colspan='5'> $row->tujuan_pka </td>
															</tr>";
                                            $no++;
                                        }
                                    }
                                    ?>

                                    <tr>
                                        <td >  </td>
                                        <td colspan='5'> &nbsp; </td>
                                    </tr>

                                    <tr>
                                        <td > <h5 class='b'>1.</h5> </td>
                                        <td colspan='5'> <h5 class='b u'>PERSIAPAN AUDIT</h5> </td>
                                    </tr>

                                    <?php
                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

                                            $no1 = 1;
                                            foreach ($sub1 as $row) {
                                                if ($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadA = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        if ($row3->kode_uraian == "$no_ins1-$no1-A") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadA = chr(ord($abjadA) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadB = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                        if ($row3->kode_uraian == "$no_ins1-$no1-B") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
                                                            $no_plk = 1;
                                                            foreach ($sub3 as $row4) {
                                                                if ($row4->sub_no_kka == $row3->no_kka) {
                                                                    echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                    $no_plk++;
                                                                }
                                                            }
                                                            echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadB = chr(ord($abjadB) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $no1++;
                                                    $no2 = $no1;
                                                }
                                            }

                                            echo "<tr><td colspan='6'>&nbsp;</td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                            $no_ins1++;
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no1 = 1;
                                        foreach ($sub1 as $row) {
                                            if ($row->kategori == "1") {
                                                echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadA = 'a';
                                                foreach ($sub2 as $row3) {
                                                    if ($row3->kode_uraian == "$no1-A") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadA = chr(ord($abjadA) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadB = 'a';
                                                foreach ($sub2 as $row3) {
                                                    $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                    if ($row3->kode_uraian == "$no1-B") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
                                                        $no_plk = 1;
                                                        foreach ($sub3 as $row4) {
                                                            if ($row4->sub_no_kka == $row3->no_kka) {
                                                                echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                $no_plk++;
                                                            }
                                                        }
                                                        echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadB = chr(ord($abjadB) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $no1++;
                                                $no2 = $no1;
                                            }
                                        }
                                    }

                                    ##########################################
                                    //--> BATAS KATEGORI
                                    ##########################################

                                    echo "
													<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
													<tr>
														<td > <h5 class='b'>2.</h5> </td>
														<td colspan='5'> <h5 class='b u'>PELAKSANAAN AUDIT</h5> </td>
													</tr>";

                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

                                            $no1 = 1;
                                            foreach ($sub1 as $row) {
                                                if ($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadA = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        if ($row3->kode_uraian == "$no_ins1-$no2-A") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadA = chr(ord($abjadA) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadB = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                        if ($row3->kode_uraian == "$no_ins1-$no2-B") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
                                                            $no_plk = 1;
                                                            foreach ($sub3 as $row4) {
                                                                if ($row4->sub_no_kka == $row3->no_kka) {
                                                                    echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                    $no_plk++;
                                                                }
                                                            }
                                                            echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadB = chr(ord($abjadB) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $no1++;
                                                    $no2++;
                                                    $no3 = $no2;
                                                }
                                            }

                                            echo "<tr><td colspan='6'>&nbsp;</td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                            $no_ins1++;
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no1 = 1;
                                        foreach ($sub1 as $row) {
                                            if ($row->kategori == "2") {
                                                echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadA = 'a';
                                                foreach ($sub2 as $row3) {
                                                    if ($row3->kode_uraian == "$no2-A") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadA = chr(ord($abjadA) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadB = 'a';
                                                foreach ($sub2 as $row3) {
                                                    $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                    if ($row3->kode_uraian == "$no2-B") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
                                                        $no_plk = 1;
                                                        foreach ($sub3 as $row4) {
                                                            if ($row4->sub_no_kka == $row3->no_kka) {
                                                                echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                $no_plk++;
                                                            }
                                                        }
                                                        echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadB = chr(ord($abjadB) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $no1++;
                                                $no2++;
                                                $no3 = $no2;
                                            }
                                        }
                                    }

                                    ##########################################
                                    //--> BATAS KATEGORI
                                    ##########################################

                                    echo "
													<tr><td colspan='6'><div class='hr hr-double hr-dotted hr18'></div></td></tr>
													<tr>
														<td> <h5 class='b'>3.</h5> </td>
														<td colspan='5'> <h5 class='b u'>PENYELESAIAN AUDIT</h5> </td>
													</tr>";

                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
															<tr>
																<td class='r'><h5 class='b'> $abj_ins1). </h5></td>
																<td colspan='5'><h5 class='b'> $key->nama_instansi </h5></td>
															</tr>";

                                            $no1 = 1;
                                            foreach ($sub1 as $row) {
                                                if ($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no1). </td>
																		<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																	</tr>

																	<tr>
																		<td></td>
																		<td class='i'> A. Tujuan Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadA = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        //$tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                        if ($row3->kode_uraian == "$no_ins1-$no3-A") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadA. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>  </td>
																						<td width='9%' class='c'> </td>
																						<td width='9%' class='c'> </td>
																						<td width='13%'> </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadA = chr(ord($abjadA) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> B. Langkah Pemeriksaan </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $abjadB = 'a';
                                                    foreach ($sub2 as $row3) {
                                                        $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                        if ($row3->kode_uraian == "$no_ins1-$no3-B") {
                                                            echo "
																			<tr>
																				<td colspan='6'>
																				<table width='100%'>
																					<tr>
																						<td width='6%' class='r'> $abjadB. </td>
																						<td> $row3->uraian </td>
																						<td width='35%'>";
                                                            $no_plk = 1;
                                                            foreach ($sub3 as $row4) {
                                                                if ($row4->sub_no_kka == $row3->no_kka) {
                                                                    echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                    $no_plk++;
                                                                }
                                                            }
                                                            echo " </td>
																						<td width='9%' class='c'> $tgl </td>
																						<td width='9%' class='c'> $row3->no_kka </td>
																						<td width='13%'> $row3->keterangan </td>
																					</tr>
																				</table>
																				</td>
																			</tr>
																			";
                                                            $abjadB = chr(ord($abjadB) + 1);
                                                        }
                                                    }

                                                    echo "
																	<tr>
																		<td></td>
																		<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																		<td></td>
																		<td></td>
																		<td></td>
																		<td></td>
																	</tr>
																	";

                                                    $no1++;
                                                    $no3++;
                                                }
                                            }

                                            echo "<tr><td colspan='6'>&nbsp;</td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                            $no_ins1++;
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no1 = 1;
                                        foreach ($sub1 as $row) {
                                            if ($row->kategori == "3") {
                                                echo "
																<tr>
																	<td class='r'> $no1). </td>
																	<td class='b' colspan='5'> $row->jenis_pekerjaan </td>
																</tr>

																<tr>
																	<td></td>
																	<td class='i'> A. Tujuan Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadA = 'a';
                                                foreach ($sub2 as $row3) {
                                                    if ($row3->kode_uraian == "$no3-A") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadA. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>  </td>
																					<td width='9%' class='c'> </td>
																					<td width='9%' class='c'> </td>
																					<td width='13%'> </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadA = chr(ord($abjadA) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> B. Langkah Pemeriksaan </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $abjadB = 'a';
                                                foreach ($sub2 as $row3) {
                                                    $tgl = date('d-m-Y', strtotime($row3->tgl_kerja));
                                                    if ($row3->kode_uraian == "$no3-B") {
                                                        echo "
																		<tr>
																			<td colspan='6'>
																			<table width='100%'>
																				<tr>
																					<td width='6%' class='r'> $abjadB. </td>
																					<td> $row3->uraian </td>
																					<td width='35%'>";
                                                        $no_plk = 1;
                                                        foreach ($sub3 as $row4) {
                                                            if ($row4->sub_no_kka == $row3->no_kka) {
                                                                echo "$no_plk. $row4->nama [$row4->jbtn_tim] <br/>";
                                                                $no_plk++;
                                                            }
                                                        }
                                                        echo " </td>
																					<td width='9%' class='c'> $tgl </td>
																					<td width='9%' class='c'> $row3->no_kka </td>
																					<td width='13%'> $row3->keterangan </td>
																				</tr>
																			</table>
																			</td>
																		</tr>
																		";
                                                        $abjadB = chr(ord($abjadB) + 1);
                                                    }
                                                }

                                                echo "
																<tr>
																	<td></td>
																	<td class='i'> C. Buatkan kesimpulan dalam kertas kerja </td>
																	<td></td>
																	<td></td>
																	<td></td>
																	<td></td>
																</tr>
																";

                                                $no1++;
                                                $no3++;
                                            }
                                        }
                                    }
                                    ?>
                                </table>

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
                'tugas': $(this).data('tugas'),
                'id_pka': $(this).data('id_pka'),
            };
            swal({
                title: "Reset Program Kerja Audit ?",
//                text: "Sok barang tidak memenuhi.!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Ya, tetap lanjutkan!",
                closeOnConfirm: false
            }, function () {
                $.ajax({
                    url: "<?php echo base_url('index.php/ketua_tim/pka/reset_pka') ?>",
                    dataType: 'JSON',
                    type: 'POST',
                    data: param,
                    success: function (e) {
                        swal("Deleted!", "Data telah di reset.!", "success");
                        setTimeout(function () {
                            window.location.replace("<?php echo base_url('index.php/ketua_tim/anggaran_waktu') ?>");
                        }, 500);

                    }
                })
            })
        })
    })
</script>
</body>
</html>
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
    .pos-atas {vertical-align: top}

    .bg-color  {background-color: #f1f6a3}
    .bg-color5 {background-color: #1faeff}

    td {padding: 5px}
    th {padding: 5px}

    .modal-width {width: 50%}
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
                <li>
                    <a href="<?= site_url('ketua_tim/pka/detail_pka/' . base64_encode($data->id_pka)); ?>"> Detail Program Kerja Audit </a>
                </li>
                <li class="active"> Kertas Kerja Audit </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Kertas Kerja Audit
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Melihat rincian data kertas kerja audit (KKA)
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
                                    </div>

                                    <div class="col-sm-6">
                                        <h3 class="header">
                                            <i class="fa fa-bars"></i> Aksi Pilihan
                                        </h3>

                                        <center>
                                            <a href="<?= site_url('ketua_tim/pka/detail_pka/' . base64_encode($data->id_pka)); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>
                                        </center>
                                    </div>
                                </div>

                                <h3 class="header">
                                    <i class="fa fa-file-text-o"></i> Daftar Kertas Kerja Audit (KKA)
                                </h3>

                                <table width="100%" border="1">
                                    <tr>
                                        <th width="3%" class="c b bg-color"> No. </th>
                                        <th class="c b bg-color"> Uraian </th>
                                        <th width="8%" class="c b bg-color"> No. KKA </th>
                                        <th width="25%" class="c b bg-color"> Pelaksana </th>
                                        <th width="13%" class="c b bg-color"> Jabatan Tim </th>
                                        <th width="12%" class="c b bg-color"> KKA </th>
                                        <th width="8%" class="c b bg-color"> Keputusan </th>
                                    </tr>

                                    <tr>
                                        <td> <h6 class='b'>1.</h6> </td>
                                        <td colspan='6'> <h6 class='b u'>PERSIAPAN AUDIT</h6> </td>
                                    </tr>

                                    <?php
                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
                                                <tr>
                                                        <td class='r'><h6 class='b'> $abj_ins1). </h6></td>
                                                        <td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
                                                </tr>";

                                            $no = 1;
                                            foreach ($sub1 as $row) {
                                                $no2 = 1;
                                                if ($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                                                    foreach ($kka as $row2) {
                                                        if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                            echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->sub_no_kka </td>
																				<td> $row2->nama </td>
																				<td class='c'> $row2->jbtn_tim </td>
																				<td class='c'>";
                                                            if ($row2->keputusan_kka == 'belum') {
                                                                echo "-";
                                                            } else {
                                                                echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                            }
                                                            echo "
																				</td>
																				<td class='c'>";
                                                            if ($row2->reviu_kka_ketua == NULL) {
                                                                echo "-";
                                                            } elseif ($row2->reviu_kka_ketua != '-') {
                                                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                            } else {
                                                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                            }
                                                            echo "
																				</td>
																			</tr>
																			";
                                                            $no2++;
                                                        }
                                                    }

                                                    $no++;
                                                }
                                            }

                                            echo "<tr><td colspan='7'> &nbsp; </td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no = 1;
                                        foreach ($sub1 as $row) {
                                            $no2 = 1;
                                            if ($row->kategori == "1") {
                                                echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

                                                foreach ($kka as $row2) {
                                                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                        echo "
																		<tr>
																			<td class='r'> $no2. </td>
																			<td> $row2->uraian </td>
																			<td class='c'> $row2->sub_no_kka </td>
																			<td> $row2->nama </td>
																			<td class='c'> $row2->jbtn_tim </td>
																			<td class='c'>";
                                                        if ($row2->keputusan_kka == 'belum') {
                                                            echo "-";
                                                        } else {
                                                            echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                        }
                                                        echo "
																			</td>
																			<td class='c'>";
                                                        if ($row2->reviu_kka_ketua == NULL) {
                                                            echo "-";
                                                        } elseif ($row2->reviu_kka_ketua != '-') {
                                                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                        } else {
                                                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                        }
                                                        echo "
																			</td>
																		</tr>
																		";
                                                        $no2++;
                                                    }
                                                }

                                                $no++;
                                            }
                                        }
                                    }

                                    ##########################################
                                    //--> BATAS KATEGORI
                                    ##########################################

                                    echo "
													<tr><td colspan='7'> &nbsp; </td></tr>
													<tr>
														<td> <h6 class='b'>2.</h6> </td>
														<td colspan='6'> <h6 class='b u'>PELAKSANAAN AUDIT</h6> </td>
													</tr>";

                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
															<tr>
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";

                                            $no = 1;
                                            foreach ($sub1 as $row) {
                                                $no2 = 1;
                                                if ($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                                                    foreach ($kka as $row2) {
                                                        if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                            echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->sub_no_kka </td>
																				<td> $row2->nama </td>
																				<td class='c'> $row2->jbtn_tim </td>
																				<td class='c'>";
                                                            if ($row2->keputusan_kka == 'belum') {
                                                                echo "-";
                                                            } else {
                                                                echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                            }
                                                            echo "
																				</td>
																				<td class='c'>";
                                                            if ($row2->reviu_kka_ketua == NULL) {
                                                                echo "-";
                                                            } elseif ($row2->reviu_kka_ketua != '-') {
                                                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                            } else {
                                                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                            }
                                                            echo "
																				</td>
																			</tr>
																			";
                                                            $no2++;
                                                        }
                                                    }

                                                    $no++;
                                                }
                                            }

                                            echo "<tr><td colspan='7'> &nbsp; </td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no = 1;
                                        foreach ($sub1 as $row) {
                                            $no2 = 1;
                                            if ($row->kategori == "2") {
                                                echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

                                                foreach ($kka as $row2) {
                                                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                        echo "
																		<tr>
																			<td class='r'> $no2. </td>
																			<td> $row2->uraian </td>
																			<td class='c'> $row2->sub_no_kka </td>
																			<td> $row2->nama </td>
																			<td class='c'> $row2->jbtn_tim </td>
																			<td class='c'>";
                                                        if ($row2->keputusan_kka == 'belum') {
                                                            echo "-";
                                                        } else {
                                                            echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                        }
                                                        echo "
																			</td>
																			<td class='c'>";
                                                        if ($row2->reviu_kka_ketua == NULL) {
                                                            echo "-";
                                                        } elseif ($row2->reviu_kka_ketua != '-') {
                                                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                        } else {
                                                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                        }
                                                        echo "
																			</td>
																		</tr>
																		";
                                                        $no2++;
                                                    }
                                                }

                                                $no++;
                                            }
                                        }
                                    }

                                    ##########################################
                                    //--> BATAS KATEGORI
                                    ##########################################

                                    echo "
													<tr><td colspan='7'> &nbsp; </td></tr>
													<tr>
														<td> <h6 class='b'>3.</h6> </td>
														<td colspan='6'> <h6 class='b u'>PENYELESAIAN AUDIT</h6> </td>
													</tr>";

                                    //-> KONDISI LEBIH DARI 1 INSTANSI
                                    if (count($sasaran) != 0) {
                                        $abj_ins1 = 'A';
                                        $no_ins1 = 1;
                                        foreach ($ins as $key) {
                                            echo "
															<tr>
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";

                                            $no = 1;
                                            foreach ($sub1 as $row) {
                                                $no2 = 1;
                                                if ($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi) {
                                                    echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                                                    foreach ($kka as $row2) {
                                                        if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                            echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->sub_no_kka </td>
																				<td> $row2->nama </td>
																				<td class='c'> $row2->jbtn_tim </td>
																				<td class='c'>";
                                                            if ($row2->keputusan_kka == 'belum') {
                                                                echo "-";
                                                            } else {
                                                                echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                            }
                                                            echo "
																				</td>
																				<td class='c'>";
                                                            if ($row2->reviu_kka_ketua == NULL) {
                                                                echo "-";
                                                            } elseif ($row2->reviu_kka_ketua != '-') {
                                                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                            } else {
                                                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                            }
                                                            echo "
																				</td>
																			</tr>
																			";
                                                            $no2++;
                                                        }
                                                    }

                                                    $no++;
                                                }
                                            }

                                            echo "<tr><td colspan='7'> &nbsp; </td></tr>";

                                            $abj_ins1 = chr(ord($abj_ins1) + 1);
                                        }
                                    }

                                    //-> KONDISI 1 INSTANSI
                                    else {
                                        $no = 1;
                                        foreach ($sub1 as $row) {
                                            $no2 = 1;
                                            if ($row->kategori == "3") {
                                                echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

                                                foreach ($kka as $row2) {
                                                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                                                        echo "
																		<tr>
																			<td class='r'> $no2. </td>
																			<td> $row2->uraian </td>
																			<td class='c'> $row2->sub_no_kka </td>
																			<td> $row2->nama </td>
																			<td class='c'> $row2->jbtn_tim </td>
																			<td class='c'>";
                                                        if ($row2->keputusan_kka == 'belum') {
                                                            echo "-";
                                                        } else {
                                                            echo "<a href='#modal-kka' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka3' data-id2='$row2->sub_no_kka' data-id3='$row2->pelaksana' title='Cek hasil kertas kerja audit'><i class='fa fa-file-text-o'></i> Detail KKA </a>";
                                                        }
                                                        echo "
																			</td>
																			<td class='c'>";
                                                        if ($row2->reviu_kka_ketua == NULL) {
                                                            echo "-";
                                                        } elseif ($row2->reviu_kka_ketua != '-') {
                                                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                                                        } else {
                                                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                                                        }
                                                        echo "
																			</td>
																		</tr>
																		";
                                                        $no2++;
                                                    }
                                                }

                                                $no++;
                                            }
                                        }
                                    }
                                    ?>
                                </table> <br/>

                                <h3 class="header col-sm-8">
                                    <i class="fa fa-file-text-o"></i> Daftar Kertas Kerja Audit (KKA) Ikhtisar
                                </h3>

                                <table width="67%" border="1">
                                    <tr>
                                        <th width="3%" class="c b bg-color"> No. </th>
                                        <th class="c b bg-color"> Jenis Pekerjaan </th>
                                        <th width="12%" class="c b bg-color"> No. KKA </th>
                                        <th width="26%" class="c b bg-color"> KKA Ikhtisar </th>
                                        <th width="11%" class="c b bg-color"> Keputusan </th>
                                    </tr>

                                    <tr>
                                        <td> <h6 class='b'>1.</h6> </td>
                                        <td colspan='4'> <h6 class='b u'> PERSIAPAN AUDIT </h6> </td>
                                    </tr>

<?php
//-> KONDISI LEBIH DARI 1 INSTANSI
if (count($sasaran) != 0) {
    $abj_ins1 = 'A';
    $no_ins1 = 1;
    foreach ($ins as $key) {
        echo "
															<tr>
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";

        $no = 1;
        foreach ($sub1 as $row) {
            $no2 = 1;
            if ($row->kategori == "1" && $row->nama_instansi == $key->nama_instansi) {
                echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                foreach ($kka_ikhtisar as $row2) {
                    //--> mengambil jumlah KKA di setiap jenis pekerjaan
                    $cek1 = $this->db->select('count(*) as jml_kka')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    ->where('jbtn_tim', 'Anggota Tim')
                                    //->like('kode_uraian', 'B')
                                    ->get()->row();

                    //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                    $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    //->like('kode_uraian', 'B')
                                    ->where('keputusan_kka', 'selesai')
                                    ->get()->row();

                    $cekPlk = $this->db->select('*')
                                    ->from('sub_pka3')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    ->get()->row();

                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                        if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                            echo "
																				<tr>
																					<td class='r'> $no2. </td>
																					<td> $row2->uraian </td>
																					<td class='c'> $row2->no_kka </td>
																					<td class='c'>";
                            if ($cek1->jml_kka != 0) {
                                if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                    if ($row2->kka_ikhtisar == NULL) {
                                        echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span>";
                                    } else {
                                        echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                    }
                                } else {
                                    echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                                }
                            } else {
                                echo "-";
                            }
                            echo "
																					</td>
																					<td class='c'>";
                            if ($row2->reviu_ketua == NULL) {
                                echo "-";
                            } elseif ($row2->reviu_ketua != '-') {
                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                            } else {
                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                            }
                            echo "
																					</td>
																				</tr>
																				";
                            $no2++;
                        }
                    }
                }

                $no++;
            }
        }

        $abj_ins1 = chr(ord($abj_ins1) + 1);
        $no_ins1++;
    }
}

//-> KONDISI 1 INSTANSI
else {
    $no = 1;
    foreach ($sub1 as $row) {
        $no2 = 1;
        if ($row->kategori == "1") {
            echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

            foreach ($kka_ikhtisar as $row2) {
                //--> mengambil jumlah KKA di setiap jenis pekerjaan
                $cek1 = $this->db->select('count(*) as jml_kka')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                ->where('jbtn_tim', 'Anggota Tim')
                                //->like('kode_uraian', 'B')
                                ->get()->row();

                //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                //->like('kode_uraian', 'B')
                                ->where('keputusan_kka', 'selesai')
                                ->get()->row();

                $cekPlk = $this->db->select('*')
                                ->from('sub_pka3')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                ->get()->row();

                if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                    if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                        echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->no_kka </td>
																				<td class='c'>";
                        if ($cek1->jml_kka != 0) {
                            if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                if ($row2->kka_ikhtisar == NULL) {
                                    echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span> <br/> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka";
                                } else {
                                    echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                }
                            } else {
                                echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                            }
                        } else {
                            echo "-";
                        }
                        echo "
																				</td>
																				<td class='c'>";
                        if ($row2->reviu_ketua == NULL) {
                            echo "-";
                        } elseif ($row2->reviu_ketua != '-') {
                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                        } else {
                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                        }
                        echo "
																				</td>
																			</tr>
																			";
                        $no2++;
                    }
                }
            }

            $no++;
        }
    }
}

##########################################
//--> BATAS KATEGORI
##########################################

echo "
													<tr><td colspan='6'> &nbsp; </td></tr>
													<tr>
														<td> <h6 class='b'>2.</h6> </td>
														<td colspan='5'> <h6 class='b u'>PELAKSANAAN AUDIT</h6> </td>
													</tr>";

//-> KONDISI LEBIH DARI 1 INSTANSI
if (count($sasaran) != 0) {
    $abj_ins1 = 'A';
    $no_ins1 = 1;
    foreach ($ins as $key) {
        echo "
															<tr>
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";

        $no = 1;
        foreach ($sub1 as $row) {
            $no2 = 1;
            if ($row->kategori == "2" && $row->nama_instansi == $key->nama_instansi) {
                echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                foreach ($kka_ikhtisar as $row2) {
                    //--> mengambil jumlah KKA di setiap jenis pekerjaan
                    $cek1 = $this->db->select('count(*) as jml_kka')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    ->where('jbtn_tim', 'Anggota Tim')
                                    //->like('kode_uraian', 'B')
                                    ->get()->row();

                    //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                    $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    //->like('kode_uraian', 'B')
                                    ->where('keputusan_kka', 'selesai')
                                    ->get()->row();

                    $cekPlk = $this->db->select('*')
                                    ->from('sub_pka3')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    ->get()->row();

                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                        if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                            echo "
																				<tr>
																					<td class='r'> $no2. </td>
																					<td> $row2->uraian </td>
																					<td class='c'> $row2->no_kka </td>
																					<td class='c'>";
                            if ($cek1->jml_kka != 0) {
                                if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                    if ($row2->kka_ikhtisar == NULL) {
                                        echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span>";
                                    } else {
                                        echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                    }
                                } else {
                                    echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                                }
                            } else {
                                echo "-";
                            }
                            echo "
																					</td>
																					<td class='c'>";
                            if ($row2->reviu_ketua == NULL) {
                                echo "-";
                            } elseif ($row2->reviu_ketua != '-') {
                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                            } else {
                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                            }
                            echo "
																					</td>
																				</tr>
																				";
                            $no2++;
                        }
                    }
                }

                $no++;
            }
        }

        $abj_ins1 = chr(ord($abj_ins1) + 1);
        $no_ins1++;
    }
}

//-> KONDISI 1 INSTANSI
else {
    $no = 1;
    foreach ($sub1 as $row) {
        $no2 = 1;
        if ($row->kategori == "2") {
            echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

            foreach ($kka_ikhtisar as $row2) {
                //--> mengambil jumlah KKA di setiap jenis pekerjaan
                $cek1 = $this->db->select('count(*) as jml_kka')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                ->where('jbtn_tim', 'Anggota Tim')
                                //->like('kode_uraian', 'B')
                                ->get()->row();

                //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                //->like('kode_uraian', 'B')
                                ->where('keputusan_kka', 'selesai')
                                ->get()->row();

                $cekPlk = $this->db->select('*')
                                ->from('sub_pka3')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                ->get()->row();

                if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                    if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                        echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->no_kka </td>
																				<td class='c'>";
                        if ($cek1->jml_kka != 0) {
                            if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                if ($row2->kka_ikhtisar == NULL) {
                                    echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span>";
                                } else {
                                    echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                }
                            } else {
                                echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                            }
                        } else {
                            echo "-";
                        }
                        echo "
																				</td>
																				<td class='c'>";
                        if ($row2->reviu_ketua == NULL) {
                            echo "-";
                        } elseif ($row2->reviu_ketua != '-') {
                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                        } else {
                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                        }
                        echo "
																				</td>
																			</tr>
																			";
                        $no2++;
                    }
                }
            }

            $no++;
        }
    }
}

##########################################
//--> BATAS KATEGORI
##########################################

echo "
													<tr><td colspan='6'> &nbsp; </td></tr>
													<tr>
														<td> <h6 class='b'>3.</h6> </td>
														<td colspan='5'> <h6 class='b u'>PENYELESAIAN AUDIT</h6> </td>
													</tr>";

//-> KONDISI LEBIH DARI 1 INSTANSI
if (count($sasaran) != 0) {
    $abj_ins1 = 'A';
    $no_ins1 = 1;
    foreach ($ins as $key) {
        echo "
															<tr>
																<td class='r'><h6 class='b'> $abj_ins1). </h6></td>
																<td colspan='6'><h6 class='b'> $key->nama_instansi </h6></td>
															</tr>";

        $no = 1;
        foreach ($sub1 as $row) {
            $no2 = 1;
            if ($row->kategori == "3" && $row->nama_instansi == $key->nama_instansi) {
                echo "
																	<tr>
																		<td class='r'> $no). </td>
																		<td class='b'> $row->jenis_pekerjaan </td>
																		<td> </td>
																		<td> </td>
																		<td> </td>
																	</tr>
																	";

                foreach ($kka_ikhtisar as $row2) {
                    //--> mengambil jumlah KKA di setiap jenis pekerjaan
                    $cek1 = $this->db->select('count(*) as jml_kka')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    ->where('jbtn_tim', 'Anggota Tim')
                                    //->like('kode_uraian', 'B')
                                    ->get()->row();

                    //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                    $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                    ->from('sub_pka3')
                                    //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                    //->like('kode_uraian', 'B')
                                    ->where('keputusan_kka', 'selesai')
                                    ->get()->row();

                    $cekPlk = $this->db->select('*')
                                    ->from('sub_pka3')
                                    ->where('sub_pka3', $row2->sub_pka2)
                                    ->where('sub_no_kka', $row2->no_kka)
                                    ->get()->row();

                    if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                        if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                            echo "
																				<tr>
																					<td class='r'> $no2. </td>
																					<td> $row2->uraian </td>
																					<td class='c'> $row2->no_kka </td>
																					<td class='c'>";
                            if ($cek1->jml_kka != 0) {
                                if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                    if ($row2->kka_ikhtisar == NULL) {
                                        echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span>";
                                    } else {
                                        echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                    }
                                } else {
                                    echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                                }
                            } else {
                                echo "-";
                            }
                            echo "
																					</td>
																					<td class='c'>";
                            if ($row2->reviu_ketua == NULL) {
                                echo "-";
                            } elseif ($row2->reviu_ketua != '-') {
                                echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                            } else {
                                echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                            }
                            echo "
																					</td>
																				</tr>
																				";
                            $no2++;
                        }
                    }
                }

                $no++;
            }
        }

        $abj_ins1 = chr(ord($abj_ins1) + 1);
        $no_ins1++;
    }
}

//-> KONDISI 1 INSTANSI
else {
    $no = 1;
    foreach ($sub1 as $row) {
        $no2 = 1;
        if ($row->kategori == "3") {
            echo "
																<tr>
																	<td class='r'> $no). </td>
																	<td class='b'> $row->jenis_pekerjaan </td>
																	<td> </td>
																	<td> </td>
																	<td> </td>
																</tr>
																";

            foreach ($kka_ikhtisar as $row2) {
                //--> mengambil jumlah KKA di setiap jenis pekerjaan
                $cek1 = $this->db->select('count(*) as jml_kka')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                ->where('jbtn_tim', 'Anggota Tim')
                                //->like('kode_uraian', 'B')
                                ->get()->row();

                //--> mengambil jumlah KKA yang telah selesai (TIDAK ADA REVIU) di setiap jenis pekerjaan
                $cek2 = $this->db->select('count(*) as jml_kka_fix')
                                ->from('sub_pka3')
                                //->join('sub_pka2', 'sub_pka2.no_kka = sub_pka3.sub_no_kka')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                //->where('kode_pekerjaan', $row->kode_pekerjaan)
                                //->like('kode_uraian', 'B')
                                ->where('keputusan_kka', 'selesai')
                                ->get()->row();

                $cekPlk = $this->db->select('*')
                                ->from('sub_pka3')
                                ->where('sub_pka3', $row2->sub_pka2)
                                ->where('sub_no_kka', $row2->no_kka)
                                ->get()->row();

                if ($row2->kode_pekerjaan == $row->kode_pekerjaan) {
                    if ($cekPlk->pelaksana != 'KOSONG**' && $cekPlk->pelaksana != '-- Pilih' && $cekPlk->jbtn_tim != 'Ketua Tim') {
                        echo "
																			<tr>
																				<td class='r'> $no2. </td>
																				<td> $row2->uraian </td>
																				<td class='c'> $row2->no_kka </td>
																				<td class='c'>";
                        if ($cek1->jml_kka != 0) {
                            if ($cek1->jml_kka == $cek2->jml_kka_fix) {
                                if ($row2->kka_ikhtisar == NULL) {
                                    echo "<span class='red control-label i'><i class='fa fa-warning bigger-130'></i> Siap dibuat! </span>";
                                } else {
                                    echo "<a href='#modal-kka-ikhtisar' role='button' class='btn btn-sm btn-primary' data-toggle='modal' data-id1='$row2->sub_pka2' data-id2='$row2->no_kka' title='Cek hasil kertas kerja audit ikhtisar'><i class='fa fa-file-text-o'></i> Detail KKA Ikhtisar </a>";
                                }
                            } else {
                                echo "<span class='orange control-label'><i class='fa fa-spinner fa-pulse bigger-130'></i> KKA Pendukung $cek2->jml_kka_fix dari $cek1->jml_kka </span>";
                            }
                        } else {
                            echo "-";
                        }
                        echo "
																				</td>
																				<td class='c'>";
                        if ($row2->reviu_ketua == NULL) {
                            echo "-";
                        } elseif ($row2->reviu_ketua != '-') {
                            echo "<label class='red' title='Terdapat reviu'><i class='fa fa-times bigger-130'></i> Reviu </label>";
                        } else {
                            echo "<label class='green' title='Selesai'><i class='fa fa-check bigger-130'></i> Selesai </label>";
                        }
                        echo "
																				</td>
																			</tr>
																			";
                        $no2++;
                    }
                }
            }

            $no++;
        }
    }
}
?>
                                </table>

                            </div>
                        </div>
                    </div>

                    <div id="modal-kka" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-width">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger"> <i class="fa fa-file-text-o"></i> Detail Kertas Kerja Audit (KKA)</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="isi-data"></div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="modal-kka-ikhtisar" class="modal fade" tabindex="-1">
                        <div class="modal-dialog modal-width">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="blue bigger"> <i class="fa fa-file-text-o"></i> Detail Kertas Kerja Audit (KKA) Ikhtisar</h4>
                                </div>

                                <div class="modal-body">
                                    <div class="isi2-data"></div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Kembali </button>
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
    $('#modal-kka').on('show.bs.modal', function (e)
    {
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        var id3 = $(e.relatedTarget).data('id3');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: "<?= site_url('ketua_tim/pka/detail_kka'); ?>",
            data: {id1: id1, id2: id2, id3: id3}, //'rowid='+ rowid,
            success: function (data)
            {
                $('.isi-data').html(data); //menampilkan data ke dalam modal
            }
        });
    });

    $('#modal-kka-ikhtisar').on('show.bs.modal', function (e)
    {
        var id1 = $(e.relatedTarget).data('id1');
        var id2 = $(e.relatedTarget).data('id2');
        //menggunakan fungsi ajax untuk pengambilan data
        $.ajax({
            type: 'post',
            url: "<?= site_url('ketua_tim/pka/detail_kka_ikhtisar'); ?>",
            data: {id1: id1, id2: id2}, //'rowid='+ rowid,
            success: function (data)
            {
                $('.isi2-data').html(data); //menampilkan data ke dalam modal
            }
        });
    });

    function pageLoad()
    {
        //code
    }
    window.onload = pageLoad;
</script>

</body>
</html>
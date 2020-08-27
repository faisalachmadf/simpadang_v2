<?php
//--> include data header
$this->load->view('layout/header');
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
                    <a href="<?= site_url('ketua_tim/penugasan'); ?>"> Penugasan </a>
                </li>
                <li class="active"> Detail Penugasan </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Detail Penugasan
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Melihat rincian data tugas yang diberikan kepada tim audit
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
                                            <i class="fa fa-file-text"></i> Data Tugas
                                        </h3>

                                        <dl id="dt-list-1" class="dl-horizontal">
                                            <dt> Tanggal Penugasan : </dt>
                                            <dd><?= $tgl_tugas; ?></dd>

                                            <dt> Kegiatan Pengawasan : </dt>
                                            <dd align="justify"><?= $data->nama_kp; ?></dd>

                                            <br/>

                                            <dt> Objek Pengawasan : </dt>
                                            <dd align="justify"><?= $data->nama_op; ?></dd>

                                            <dt> Alamat Kantor : </dt>
                                            <dd align="justify"><?= $data->alamat_kantor; ?></dd>

                                            <dt> Nomor Telepon : </dt>
                                            <dd><?= $data->no_tlp; ?></dd>

                                            <br/>

                                            <dt> Program Pengawasan : </dt>
                                            <dd align="justify"><?= $data->program_peng; ?></dd>

                                            <dt> Sasaran Pengawasan : </dt>
                                            <dd align="justify"><?= $data->sasaran_peng; ?></dd>

                                            <dt> Tujuan Pengawasan : </dt>
                                            <dd align="justify"><?= $data->tujuan_peng; ?></dd>

                                            <br/>

                                            <dt> Nomor Surat Tugas : </dt>
                                            <dd><?= $data->no_st; ?></dd>

                                            <dt> Tangal Surat Tugas : </dt>
                                            <dd><?= $tgl_surat; ?></dd>

                                            <dt> Direncanakan Mulai Tgl : </dt>
                                            <dd><?= $tgl_awal; ?></dd>

                                            <dt> Direncanakan Selesai Tgl : </dt>
                                            <dd><?= $tgl_akhir; ?></dd>

                                            <dt>Realisasi Tgl Pelaksanaan : </dt>
                                            <dd><?= $tgl_awal . " s/d " . $tgl_akhir; ?></dd>

                                            <br/>

                                            <dt>Dasar Surat : </dt>
                                            <dd align='justify'><?= $data->dasar_surat; ?></dd>

                                            <br/>

                                            <dt> Sasaran : </dt>
                                            <?php
                                            foreach ($sasaran as $row) {
                                                if ($row->sasaran != NULL) {
                                                    echo "<dd>$row->nomor. $row->sasaran</dd>";
                                                }
                                            }
                                            ?>

                                            <br/>

                                            <dt> Tembusan Surat : </dt>
                                            <?php
                                            foreach ($tembusan as $row) {
                                                echo "<dd>$row->nomor. $row->tembusan</dd>";
                                            }
                                            ?>
                                        </dl>
                                    </div>

                                    <div class="col-sm-6">
                                        <h3 class="header">
                                            <i class="fa fa-users"></i> Tim Pemeriksa														
                                        </h3>

                                        <dl id="dt-list-1" class="dl-horizontal">
                                            <dt> Wakil Penanggung Jawab : </dt>
                                            <dd><?= $daltu->nama . " | " . $daltu->jabatan; ?></dd>

                                            <?php if ($data->dalnis != NULL) { ?>
                                                <dt> Pengendali Teknis : </dt>
                                                <dd><?= $dalnis->nama; ?></dd>
                                                <br/>
                                            <?php } ?>

                                            <dt> Ketua Tim : </dt>
                                            <dd><?= $ketua_tim->nama; ?></dd>

                                            <dt> Anggota : </dt>
                                            <?php
                                            foreach ($tim as $row) {
                                                if ($row->anggota != NULL) {
                                                    echo "<dd>$row->nomor. $row->nama</dd>";
                                                }
                                            }
                                            ?>	

                                            <div class="hr hr-double dotted"></div>													
                                        </dl>

                                        <center>
                                            <a href="<?= site_url('ketua_tim/penugasan'); ?>" class="btn btn-sm btn-default"><i class="fa fa-arrow-left"></i> Kembali </a>

                                            &nbsp;&nbsp;

                                            <?php
//                                            print_r($data);exit;
                                            if ($data->fk_agr == NULL) { ?>
                                                <a href="<?= site_url('ketua_tim/anggaran_waktu/tambah_anggaran_waktu/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-danger" title="Buat alokasi anggaran waktu">
                                                    <i class="fa fa-clock-o"></i> Buat Alokasi Anggaran Waktu
                                                </a>
                                            <?php } elseif (substr($data->fk_agr, 0, 4) == "temp") {
                                                $idagr = str_replace("temp_", "", $data->fk_agr); ?>
                                                <a href="<?= site_url('ketua_tim/anggaran_waktu/temp_anggaran_waktu/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim) . '/' . base64_encode($idagr)); ?>" class="btn btn-sm btn-danger" title="Buat alokasi anggaran waktu">
                                                    <i class="fa fa-clock-o"></i> Buat Alokasi Anggaran Waktu *
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?= site_url('ketua_tim/anggaran_waktu/detail_anggaran_waktu/' . base64_encode($data->fk_agr)); ?>" class="btn btn-sm btn-primary" title="Detail anggaran waktu">
                                                    <i class="fa fa-file-text"></i> Detail Anggaran Waktu
                                                </a>
                                            <?php } ?>

                                            &nbsp;&nbsp;

                                            <?php
                                            if ($data->fk_pka == NULL) {
                                                if ($data->fk_agr != NULL) {
                                                    ?>
                                                    <a href="<?= site_url('ketua_tim/pka/tambah_pka/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim) . '/' . base64_encode($data->fk_agr)); ?>" class="btn btn-sm btn-success" title="Buat program kerja audit">
                                                        <i class="fa fa-qrcode"></i> Buat Program Kerja Audit 
                                                    </a>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <a href="#" class="btn btn-sm btn-success" title="Buat program kerja audit" disabled>
                                                        <i class="fa fa-qrcode"></i> Buat Program Kerja Audit 
                                                    </a>
                                                    <?php
                                                }
                                            } elseif (substr($data->fk_pka, 0, 4) == "temp") {
                                                $idpka = str_replace("temp_", "", $data->fk_pka);
                                                ?>
                                                <a href="<?= site_url('ketua_tim/pka/temp_pka/' . base64_encode($idpka) . '/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim)); ?>" class="btn btn-sm btn-success" title="Buat program kerja audit">
                                                    <i class="fa fa-clock-o"></i> Buat Program Kerja Audit *
                                                </a>
                                            <?php } else { ?>
                                                <a href="<?= site_url('ketua_tim/pka/detail_pka/' . base64_encode($data->fk_pka)); ?>" class="btn btn-sm btn-primary" title="Detail program kerja audit">
                                                    <i class="fa fa-file-text"></i> Detail Program Kerja Audit 
                                                </a>
                                            <?php } ?>														
                                        </center> <br/>
                                        <i>* : Data telah disimpan sementara / temporary</i>

                                    </div>
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

</body>
</html>
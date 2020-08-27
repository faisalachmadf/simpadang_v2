<?php
error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));
//--> include data header
$this->load->view('layout/header');
?>

<style type="text/css">
    .u {text-decoration: underline}
    .b {font-weight: bold}
    .i {font-style: italic}
    .c {text-align: center}
    .r {text-align: right}
    .j {text-align: justify}

    .bor-top {border-top: 1px solid #000}
    .pos-atas {vertical-align: top}

    .pad-3 {padding: 5px}
    .pad-10 {padding: 10px}
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
                    <a href="<?= site_url('ketua_tl/home'); ?>"> Home </a>
                </li>
                <li>
                    <a href="<?= site_url('ketua_tl/tindak_lanjut'); ?>"> Tindak Lanjut </a>
                </li>
                <li>
                    <a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/' . base64_encode($data->id_tl) . '/' . base64_encode($data->id_tim)); ?>"> Detail Tindak Lanjut </a>
                </li>
                <li class="active"> Tambah Tindak Lanjut </li>
            </ul><!-- /.breadcrumb -->
        </div>
        <div class="page-content">
            <div class="page-header">
                <h1>Tambah Temuan
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan data
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                    <form id="validasi" class="form-horizontal" role="form" action="<?php echo site_url('staff_evlap/temuan/tambah_tl/') ?>" method="post" enctype='multipart/form-data'>
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah Temuan
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body" style="display: block; overflow: hidden;">
                                        <div class="widget-main">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan Data Temuan </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Objek Pengawasan </label>
                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="instansi" class="col-xs-12 col-sm-5" value="<?= $data->nm_instansi; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Kategori </label>
                                                <div class="col-sm-9">
                                                    <select required name="kategori_lhp" class="select2" data-placeholder=" --Pilih Kategori LHP --">
                                                        <option disabled selected></option>
                                                        <option value="LHP BPK">LHP BPK</option>
                                                        <option value="LHP BPKP">LHP BPKP</option>
                                                        <option value="LHP APIP Kementerian">LHP APIP Kementerian</option>
                                                        <option value="LHP APIP Provinsi">LHP APIP Provinsi</option>
                                                        <option value="LHP APIP Kota Pariaman">LHP APIP Kota Pariaman</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> No LHP </label>
                                                <div class="col-sm-5">
                                                    <input required type="text" class="form-control" name="no_lhp" class="col-xs-12 col-sm-5" value="<?= $data->no_lhp; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal LHP </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input required type='text' name='tgl_lhp' class='col-xs-8 col-sm-2' value="<?php echo date('Y-m-d')?>" placeholder='Tanggal' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> File LHP : </label>
                                                <div class="col-sm-4">
                                                  <input type='file' name='file_lhp' class='id-input-file-2' />
                                                </div>
                                            </div>

                                            
                                            <hr>

                                            <div class="col-md-12 list list-temuan-1" style="border: 1px solid #cdd8e3;min-height: 250px;padding: 10px;margin-top: 10px;margin-bottom:10px; background:#fdfdfd;">
                                                <h5><b><span>Temuan <span class="no">1</span></span></b></h5>
                                                <hr>
                                                <div class="col-md-12 no-padding">

                                                     <div class="col-md-3 no-padding-left">
                                                         <select required name="aspek[]" class="form-control" placeholder="">
                                                            <option value="" selected>-- Pilih Aspek --</option>
                                                            <option value="spi">Sistem Pengendalian Internal (SPI)</option>
                                                            <option value="e3">Efektif, Efisien, Ekonomis(EEE)</option>
                                                            <option value="kepatuhan">Kepatuhan</option>
                                                        </select>
                                                    </div>                                                    
                                                    <div class="col-md-3 no-padding-left no-padding-right">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                NIP
                                                            </span>
                                                            <input type="text" name="nip[]" class="form-control" placeholder="Masukkan NIP">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 no-padding-right">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="ace-icon fa fa-user"></i>
                                                            </span>
                                                            <input type="text" name="nama[]" class="form-control" placeholder="Masukkan Nama">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3"><span style="margin: 12px;display: block;width: 100%;">&nbsp;</span></div>

                                                </div>

                                                <div class="col-md-12" style="min-height: 170px;padding: 10px 0px">  
                                                    <div id="temuan" style="height:60px;"> 
                                                        <div class="col-md-6 no-padding">
                                                            <textarea required class="form-control" name="temuan[]" placeholder="Temuan"></textarea>
                                                        </div>
                                                        <div class="col-md-3 no-padding-right">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-barcode"></i>
                                                                </span>
                                                                <select name='kode_temuan[]' class='form-control' required>
                                                                    <option value=""> - Kode Temuan - </option>
                                                                    <option value='101' title="Kerugian negara/daerah atau kerugian negara/daerah yang terjadi pada perusahaan milik negara/daerah"> 101 </option>
                                                                    <option value='102' title="Potensi kerugian negara/daerah atau kerugian negara/daerah yang terjadi pada perusahaan milik negara/daerah"> 102 </option>
                                                                    <option value='103' title="Kekurangan penerimaan negara/daerah atau perusahaan milik negara/daerah "> 103 </option>
                                                                    <option value='104' title="Administrasi"> 104 </option>
                                                                    <option value='105' title="Indikasi tindak pidana"> 105 </option>
                                                                    <option value='201' title="Kelemahan sistem pengendalian akuntansi dan pelaporan"> 201 </option>
                                                                    <option value='202' title="Kelemahan sistem pengendalian pelaksanaan anggaran pendapatan dan belanja"> 202 </option>
                                                                    <option value='203' title="Kelemahan struktur pengendalian intern"> 203 </option>
                                                                    <option value='301' title="Ketidakhematan/pemborosan/ketidakekonomisan"> 301 </option>
                                                                    <option value='302' title="Ketidakefisienan"> 302 </option>
                                                                    <option value='303' title="Ketidakefektifan"> 303 </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3 no-padding-right">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-money"></i>
                                                                </span>
                                                                <input class="form-control" type="text" name="nilaitemuan[]" placeholder="Nilai">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class=" col-md-12 list-rekomendasi" style="min-height:72px; padding-top: 10px;">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label no-padding-right no-padding-left" for="rk-1"> Rekomendasi <span class='no_rekom'>1.1</span> :</label>
                                                            <div class="col-md-10 no-padding-right">
                                                                <div class="col-md-6">
                                                                    <textarea required name="rekomendasi[0][]" placeholder="Rekomendasi" class="rekom form-control"></textarea>
                                                                </div>
                                                                <div class="col-md-2 no-padding-left">  
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="ace-icon fa fa-barcode"></i>
                                                                        </span>
                                                                        <select required name='kode_rekomendasi[0][]' class="form-control">
                                                                            <option value=''>- Kode -</option>
                                                                            <option value='00'> 00 </option>
                                                                            <option value='01' title="Penyetoran ke kas negara/daerah, kas BUMN/D, dan masyararakat"> 01 </option>
                                                                            <option value='02' title="Pengembalian barang kepada negara, daerah, BUMN/D, dan masyarakat"> 02 </option>
                                                                            <option value='03' title="Perbaikan fisik barang/jasa dalam proses pembangunan atau penggantian barang/jasa oleh rekanan"> 03 </option>
                                                                            <option value='04' title="Penghapusan barang milik negara/daerah"> 04 </option>
                                                                            <option value='05' title="Pelaksanaan sanksi administrasi kepegawaian"> 05 </option>
                                                                            <option value='06' title="Perbaikan laporan dan penertiban administrasi/kelengkapan administrasi"> 06 </option>
                                                                            <option value='07' title="Perbaikan sistem dan prosedur akuntansi dan pelaporan"> 07 </option>
                                                                            <option value='08' title="Peningkatan kualitas dan kuantitas sumber daya manusia pendukung sistem pengendalian"> 08 </option>
                                                                            <option value='09' title="Perubahan atau perbaikan prosedur, peraturan dan kebijakan"> 09 </option>
                                                                            <option value='10' title="Perubahan atau perbaikan struktur organisasi"> 10 </option>
                                                                            <option value='11' title="Koordinasi antar instansi termasuk juga penyerahan penanganan kasus kepada instansi yang berwenang"> 11 </option>
                                                                            <option value='12' title="Pelaksanaan penelitian oleh tim khusus atau audit lanjutan oleh unit pengawas intern"> 12 </option>
                                                                            <option value='13' title="Pelaksanaan sosialisasi "> 13 </option>
                                                                            <option value='14' title="Lain-lain"> 14 </option>
                                                                        </select>
                                                                    </div>

                                                                </div>
                                                                <div class="col-md-4 no-padding">
                                                                    <div class="col-md-9 no-padding-left">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="ace-icon fa fa-money"></i>
                                                                            </span>
                                                                            <input class="form-control" type="text" name="nilairekomendasi[][]" placeholder="Nilai">
                                                                        </div>    
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <button type='button' class='btn pull-right btn-xs btn-warning' data-no='1' id="TambahRekomendasi" title='Tambah Rekomendasi'><i class='fa fa-plus'></i>  Rekom
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>                                                       
                                                        </div>
                                                    </div>   
                                                </div>



                                            </div>

                                            <div class="text-left" style="float: left;">
                                                <button type='button' class='btn pull-left btn-warning' style="margin:5px" id='TambahUraian' data-no='1' title='Tambah Temuan'><i class='fa fa-plus'></i> Tambah Temuan</button>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div align="center" class="clearfix form-actions">
                                                <button class="btn btn-info no-radius" name="submit" value="Simpan" type="submit">
                                                    <i class="ace-icon fa fa-save"></i>
                                                    Simpan
                                                </button>
                                            </div>

                                        </div><!-- /.widget-main -->


                                    </div>

                                </div>
                            </div><!-- /.page-content -->
                        </div>
                    </form>
                </div>
            </div><!-- /.main-content -->

            <input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

            <!-- include data footer -->
            <?php $this->load->view('layout/footer'); ?>

            <script type="text/javascript">
                $(document).ready(function ()
                {
                    $('.select2').css('width','310px').select2({allowClear:false});

                    var tgl = document.getElementById("tgl").value;

                    $('.datepicker2').datetimepicker({
                        weekStart: 1,
                        daysOfWeekDisabled: [0, 6],
                        language: 'id',
                        todayBtn: 1,
                        autoclose: 1,
                        todayHighlight: 1,
                        startView: 2,
                        minView: 2,
                        forceParse: 0
                    });
                    
                });
                $(document)
                        .on('click', '#TambahUraian', function () {
                            var list =
                                    "<div class='col-md-12 list list' style='border: 1px solid #cdd8e3;min-height: 250px;padding: 10px;margin-top: 10px;margin-bottom:10px; background:#fdfdfd;'>" +
                                    "<h5 style='display: inline-block;'><b><span>Temuan <span class='no'></span></span></b></h5><hr>" +
                                    "<div class='col-md-12 no-padding'>" +
                                    "<div class='col-md-3 no-padding-left'>"+
                                    "<select required name='aspek[]' class='form-control'>"+
                                    "<option value=''>-- Pilih Aspek --</option>"+
                                    "<option value='spi'>Sistem Pengendalian Internal (SPI)</option>"+
                                    "<option value='e3'>Efektif, Efisien, Ekonomis(EEE)</option>"+
                                    "<option value='kepatuhan'>Kepatuhan</option>"+
                                    "</select>"+
                                    "</div>"+
                                    "<div class='col-md-3 no-padding-left no-padding-right'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'> NIP</span>" +
                                    "<input type='text' name='nip[]' class='form-control' placeholder='Masukkan NIP'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-3 no-padding-right'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'><i class='ace-icon fa fa-user'></i></span>" +
                                    "<input type='text' name='nama[]' class='form-control' placeholder='Masukkan Nama'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-3'>" +
                                    "<button type='button' class='btn pull-right btn-sm btn-danger' style='margin:5px' id='HapusUraian' data-no='1' title='Hapus Temuan'><i class='fa fa-times'></i> Hapus Temuan</button>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-12' style='min-height: 170px; padding: 10px 0px'>" +
                                    "<div id='temuan' style='min-height:60px;'>" +
                                    "<div class='col-md-6 no-padding'>" +
                                    "<textarea required class='form-control' name='temuan[]' placeholder='Temuan'></textarea>" +
                                    "</div>" +
                                    "<div class='col-md-3 no-padding-right'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-barcode'></i>" +
                                    "</span>" +
                                    "<select required name='kode_temuan[]' class='form-control'>" +
                                    "<option value=''> - Kode Temuan - </option>" +
                                    "<option value='101'> 101 </option>" +
                                    "<option value='102'> 102 </option>" +
                                    "<option value='103'> 103 </option>" +
                                    "<option value='104'> 104 </option>" +
                                    "<option value='105'> 105 </option>" +
                                    "<option value='201'> 201 </option>" +
                                    "<option value='202'> 202 </option>" +
                                    "<option value='203'> 203 </option>" +
                                    "<option value='301'> 301 </option>" +
                                    "<option value='302'> 302 </option>" +
                                    "<option value='303'> 303 </option>" +
                                    "</select>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-3 no-padding-right'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-money'></i>" +
                                    "</span>" +
                                    "<input class='form-control' type='text' name='nilaitemuan[]' placeholder='Nilai'>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-12 list-rekomendasi' style='min-height:72px; padding-top: 10px;'>" +
                                    "<div class='form-group'>" +
                                    "<label class='col-md-2 control-label no-padding-right no-padding-left' for='rk-1'> Rekomendasi <span class='no_rekom'></span> :</label>" +
                                    "<div class='col-md-10 no-padding-right'>" +
                                    "<div class='col-md-6'>" +
                                    "<textarea required placeholder='Rekomendasi' class='rekom form-control'></textarea>" +
                                    "</div><div class='col-md-2 no-padding-left'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-barcode'></i></span>" +
                                    "<select required name='kode_rekomendasi[][]' class='koderekom form-control'>" +
                                    "<option value=''>- Kode -</option>" +
                                    "<option value='00'> 00 </option>" +
                                    "<option value='01'> 01 </option>" +
                                    "<option value='02'> 02 </option>" +
                                    "<option value='03'> 03 </option>" +
                                    "<option value='04'> 04 </option>" +
                                    "<option value='05'> 05 </option>" +
                                    "<option value='06'> 06 </option>" +
                                    "<option value='07'> 07 </option>" +
                                    "<option value='08'> 08 </option>" +
                                    "<option value='09'> 09 </option>" +
                                    "<option value='10'> 10 </option>" +
                                    "<option value='11'> 11 </option>" +
                                    "<option value='12'> 12 </option>" +
                                    "<option value='13'> 13 </option>" +
                                    "<option value='14'> 14 </option>" +
                                    "</select></div>" +
                                    "</div>" +
                                    "<div class='col-md-4 no-margin no-padding'>" +
                                    "<div class='col-md-9 no-padding-left'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-money'></i>" +
                                    "</span>" +
                                    "<input class='nilairekom form-control' type='text' name='nilairekomendasi[][]' placeholder='Nilai'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-3 no-padding'>" +
                                    "<button type='button' class='btn pull-right btn-xs btn-warning' id='TambahRekomendasi' title='Tambah Rekmendasi'><i class='fa fa-plus'></i> Rekom" +
                                    "</button>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>";

                            $(list).insertAfter($('.list').last());
                            cek(1);
                        })
                        .on('click', '#HapusUraian', function () {
                            $(this).parent().parent().parent().remove();
                            cek(1)
                        })
                        .on('click', '#TambahRekomendasi', function () {
                            var posisi = $(this).data('no');
                            var rekom = "<div class='col-md-12 list-rekomendasi' style='min-height:72px; padding-top: 10px;'>" +
                                    "<div class='form-group'>" +
                                    "<label class='col-md-2 control-label no-padding-right no-padding-left' for='rk-1'> Rekomendasi <span class='no_rekom'></span> :</label>" +
                                    "<div class='col-md-10 no-padding-right'>" +
                                    "<div class='col-md-6'>" +
                                    "<textarea required placeholder='Rekomendasi' class='rekom form-control'></textarea>" +
                                    "</div><div class='col-md-2 no-padding-left'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-barcode'></i></span>" +
                                    "<select required name='kode_rekomendasi[][]' class='koderekom form-control'>" +
                                    "<option value=''>- Kode -</option>" +
                                    "<option value='00'> 00 </option>" +
                                    "<option value='01'> 01 </option>" +
                                    "<option value='02'> 02 </option>" +
                                    "<option value='03'> 03 </option>" +
                                    "<option value='04'> 04 </option>" +
                                    "<option value='05'> 05 </option>" +
                                    "<option value='06'> 06 </option>" +
                                    "<option value='07'> 07 </option>" +
                                    "<option value='08'> 08 </option>" +
                                    "<option value='09'> 09 </option>" +
                                    "<option value='10'> 10 </option>" +
                                    "<option value='11'> 11 </option>" +
                                    "<option value='12'> 12 </option>" +
                                    "<option value='13'> 13 </option>" +
                                    "<option value='14'> 14 </option>" +
                                    "</select></div>" +
                                    "</div>" +
                                    "<div class='col-md-4 no-margin no-padding'>" +
                                    "<div class='col-md-9 no-padding-left'>" +
                                    "<div class='input-group'>" +
                                    "<span class='input-group-addon'>" +
                                    "<i class='ace-icon fa fa-money'></i>" +
                                    "</span>" +
                                    "<input class='nilairekom form-control' type='text' name='nilairekomendasi[][]' placeholder='Nilai'>" +
                                    "</div>" +
                                    "</div>" +
                                    "<div class='col-md-3 no-padding'>" +
                                    "<button type='button' class='btn pull-right btn-xs btn-danger' id='HapusRekomendasi' title='Hapus Rekmendasi'><i class='fa fa-minus'></i> Rekom " +
                                    "</button>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>" +
                                    "</div>";

                            $(rekom).insertAfter($(".list-temuan-" + posisi + " .list-rekomendasi").last());
                            cek2(posisi);
                        })
                        .on('click', '#HapusRekomendasi', function () {
                            var pos = $(this).data('no');
                            $(this).parent().parent().parent().parent().parent().remove();
                            cek2(pos);
                        })

                function cek(no) {
                    var no_ = '.list-temuan-' + no;
                    var No = 1;

                    $('.list').each(function () {
                        var norek = parseInt(No) - 1;
                        $(this).addClass('list-temuan-' + No);
                        $(".list-temuan-" + No + " .list-rekomendasi").addClass("list-rekomendasi-" + No);
                        $(".list-temuan-" + No + " .no").html(No);
                        $(".list-temuan-" + No + " .list-rekomendasi-" + No).find(".no_rekom").html(No + '.' + no);
                        $(".list-temuan-" + No + " .list-rekomendasi-" + No).find(".rekom").attr('name', 'rekomendasi[' + norek + ']' + '[]');
                        $(".list-temuan-" + No + " .list-rekomendasi-" + No).find(".koderekom").attr('name', 'kode_rekomendasi[' + norek + ']' + '[]');
                        $(".list-temuan-" + No + " .list-rekomendasi-" + No).find(".nilairekom").attr('name', 'nilairekomendasi[' + norek + ']' + '[]');
                        $(".list-temuan-" + No + " #TambahRekomendasi").attr('data-no', No);
                        No++;
                    });
                }

                function cek2(no) {
                    var no_ = '.list-temuan-' + no;
                    var No = 1;
                    var norek = parseInt(no) - 1;

                    $(no_ + " .list-rekomendasi").each(function () {
                        $(this).addClass('list-rekomendasi-' + No);
                        $(this).find(".no_rekom").html(no + '.' + No);
                        $(this).find(".rekom").attr('name', 'rekomendasi[' + norek + ']' + '[]');
                        $(this).find(".koderekom").attr('name', 'kode_rekomendasi[' + norek + ']' + '[]');
                        $(this).find(".nilairekom").attr('name', 'nilairekomendasi[' + norek + ']' + '[]');
                        $(this).find("#HapusRekomedasi").attr('data-no', no);
                        No++;
                    });
                }
            </script>
            <script type="text/javascript">
  jQuery(function($)
  {
    $('.id-input-file-2').ace_file_input({
      no_file    : 'Tidak ada File ...',
      btn_choose : 'Pilih',
      btn_change : 'Ubah',
      droppable  : false,
      onchange   : null,
      thumbnail  : false, //| true | large
      //whitelist:'doc|docx',
      //blacklist:'exe|php'
      //onchange:''
      //
    });
  });
</script>
            </body>
            </html>

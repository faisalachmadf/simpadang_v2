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
                    <form id="validasi" class="form-horizontal" role="form" action="<?php echo site_url('ketua_tim/tindak_lanjut/tambah_tl/').base64_encode($data->no_lhp)?>" method="post">
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

                                    <div class="widget-body">
                                        <div class="widget-main">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan Data Temuan </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Sasaran Pengawasan </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="instansi" class="col-xs-12 col-sm-5" value="<?= $data->nm_instansi; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> No LHP </label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" name="no_lhp" class="col-xs-12 col-sm-5" value="<?= $data->no_lhp; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Upload File LHP </label>
                                                <div class="col-sm-5">
                                                    <input type='text' class='btn btn-sm btn-info' value='Upload File' />
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal LHP </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input type='text' name='tgl_lhp' class='col-xs-8 col-sm-2' value="<?php echo date('Y-m-d')?>" placeholder='Tanggal' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Kategori LHP </label>
                                                <div class="col-sm-5">                                                    
                                                    <select name="kategori" class="form-control">
                                                        <option value="SPI">Sistem Pengendalian Internal (SPI)</option>
                                                        <option value="EEE">Efektif, Efisien, Ekonomis(EEE)</option>
                                                        <option value="KEPATUHAN">Kepatuhan</option>
                                                    </select>

                                                </div>
                                            </div>
                                            <hr>

                                            <div class="col-md-12 list list-temuan-1" style="border: 1px solid #cdd8e3;min-height: 250px;padding: 10px;margin-top: 10px;margin-bottom:10px;">
                                                <center><span>LAPORAN <span class="no">1</span></span></center>
                                                <hr>
                                                <div class="col-md-12 no-padding">
                                                    <div class="col-md-3 no-padding-left">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                NIP
                                                            </span>
                                                            <input type="text" name="nip[]" class="form-control" required placeholder="Masukkan NIP">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">
                                                                <i class="ace-icon fa fa-user"></i>
                                                            </span>
                                                            <input type="text" name="nama[]" required class="form-control" placeholder="Masukkan Nama">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <button type='button' class='btn pull-right btn-white btn-info' style="margin:5px" id='TambahUraian' data-no='1' title='Tambah Uraian'><i class='fa fa-plus'> Tambah Uraian</i></button>
                                                    </div>
                                                </div>

                                                <div class="col-md-12" style="border:1px solid #cdd8e3;min-height: 170px;padding: 10px">  
                                                    <div id="temuan" style="height:60px;border-bottom: 1px solid #080808"> 
                                                        <div class="col-md-6 no-padding">
                                                            <textarea class="form-control" name="temuan[]" placeholder="Uraian"></textarea>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-barcode"></i>
                                                                </span>
                                                                <select name='kode_temuan[]' required>
                                                                    <option value=""> - Kode Uraian - </option>
                                                                    <option value='101'> 101 </option>
                                                                    <option value='102'> 102 </option>
                                                                    <option value='103'> 103 </option>
                                                                    <option value='104'> 104 </option>
                                                                    <option value='105'> 105 </option>
                                                                    <option value='201'> 201 </option>
                                                                    <option value='202'> 202 </option>
                                                                    <option value='203'> 203 </option>
                                                                    <option value='301'> 301 </option>
                                                                    <option value='302'> 302 </option>
                                                                    <option value='303'> 303 </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 no-padding-right">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">
                                                                    <i class="ace-icon fa fa-money"></i>
                                                                </span>
                                                                <input class="form-control" type="text" name="nilaitemuan[]" placeholder="Nilai Uang">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class=" col-md-12 list-rekomendasi" style="height:72px; padding-top: 10px; border-bottom: 1px solid #cdd8e3">
                                                        <div class="form-group">
                                                            <label class="col-md-2 control-label no-padding-right no-padding-left" for="rk-1"> Rekomendasi <span class='no_rekom'>1.1</span> :</label>
                                                            <div class="col-md-10 no-padding-right">
                                                                <div class="col-md-6">
                                                                    <textarea name="rekomendasi[0][]" placeholder="Rekomendasi" class="rekom form-control"></textarea>
                                                                </div>
                                                                <div class="col-md-2 no-padding-left">  
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <i class="ace-icon fa fa-barcode"></i>
                                                                        </span>
                                                                        <select name='kode_rekomendasi[0][]' class="form-control">
                                                                            <option>- Kode -</option>
                                                                            <option value='00'> 00 </option>
                                                                            <option value='01'> 01 </option>
                                                                            <option value='02'> 02 </option>
                                                                            <option value='03'> 03 </option>
                                                                            <option value='04'> 04 </option>
                                                                            <option value='05'> 05 </option>
                                                                            <option value='06'> 06 </option>
                                                                            <option value='07'> 07 </option>
                                                                            <option value='08'> 08 </option>
                                                                            <option value='09'> 09 </option>
                                                                            <option value='10'> 10 </option>
                                                                            <option value='11'> 11 </option>
                                                                            <option value='12'> 12 </option>
                                                                            <option value='13'> 13 </option>
                                                                            <option value='14'> 14 </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 no-padding">
                                                                    <div class="col-md-9 no-padding">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon">
                                                                                <i class="ace-icon fa fa-money"></i>
                                                                            </span>
                                                                            <input class="form-control" type="text" name="nilairekomendasi[][]" placeholder="Nilai Uang">
                                                                        </div>    
                                                                    </div>
                                                                    <div class="col-md-3 no-padding">
                                                                        <button type='button' class='btn pull-right btn-xs btn-white btn-success' data-no='1' id="TambahRekomendasi" title='Tambah Rekomendasi'><i class='fa fa-plus'> Rekom</i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>                                                       
                                                        </div>
                                                    </div>   
                                                </div>

                                            </div>
                                            <div class="text-right">
                                                <button class="btn btn-sm btn-success no-radius" name="submit" value="Simpan" type="submit">
                                                    <i class="ace-icon fa fa-save"></i>
                                                    Submit
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
                    "<div class='col-md-12 list list' style='border: 1px solid #cdd8e3;min-height: 250px;padding: 10px;margin-top: 10px;margin-bottom:10px;'>" +
                    "<center><span>LAPORAN <span class='no'></span></span></center><hr>" +
                    "<div class='col-md-12 no-padding'>" +
                    "<div class='col-md-3 no-padding-left'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'> NIP</span>" +
                    "<input type='text' name='nip[]' class='form-control' required placeholder='Masukkan NIP'>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-4'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'><i class='ace-icon fa fa-user'></i></span>" +
                    "<input type='text' name='nama[]' class='form-control' required placeholder='Masukkan Nama'>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-5'>" +
                    "<button type='button' class='btn pull-right btn-white btn-danger' style='margin:5px' id='HapusUraian' data-no='1' title='Hapus Uraian'><i class='fa fa-minus'> Hapus Uraian</i></button>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-12' style='border:1px solid #cdd8e3;min-height: 170px;padding: 10px'>" +
                    "<div id='temuan' style='height:60px;border-bottom: 1px solid #080808'>" +
                    "<div class='col-md-6 no-padding'>" +
                    "<textarea class='form-control' name='temuan[]' placeholder='Uraian'></textarea>" +
                    "</div>" +
                    "<div class='col-md-2'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'>" +
                    "<i class='ace-icon fa fa-barcode'></i>" +
                    "</span>" +
                    "<select name='kode_temuan[]' required>" +
                    "<option value=''> - Kode Uraian - </option>" +
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
                    "<div class='col-md-4 no-padding-right'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'>" +
                    "<i class='ace-icon fa fa-money'></i>" +
                    "</span>" +
                    "<input class='form-control' type='text' name='nilaitemuan[]' placeholder='Nilai Uang'>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-12 list-rekomendasi' style='height:72px; padding-top: 10px;border-bottom: 1px solid #cdd8e3'>" +
                    "<div class='form-group'>" +
                    "<label class='col-md-2 control-label no-padding-right no-padding-left' for='rk-1'> Rekomendasi <span class='no_rekom'></span> :</label>" +
                    "<div class='col-md-10 no-padding-right'>" +
                    "<div class='col-md-6'>" +
                    "<textarea  placeholder='Rekomendasi' class='rekom form-control'></textarea>" +
                    "</div><div class='col-md-2 no-padding-left'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'>" +
                    "<i class='ace-icon fa fa-barcode'></i></span>" +
                    "<select name='kode_rekomendasi[][]' class='koderekom form-control'>" +
                    "<option>- Kode -</option>" +
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
                    "<div class='col-md-9 no-padding'>" +
                    "<div class='input-group'>" +
                    "<span class='input-group-addon'>" +
                    "<i class='ace-icon fa fa-money'></i>" +
                    "</span>" +
                    "<input class='nilairekom form-control' type='text' name='nilairekomendasi[][]' placeholder='Nilai Uang'>" +
                    "</div>" +
                    "</div>" +
                    "<div class='col-md-3 no-padding'>" +
                    "<button type='button' class='btn pull-right btn-xs btn-white btn-success' id='TambahRekomendasi' title='Tambah Rekmendasi'><i class='fa fa-plus'> Rekom </i>" +
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
                var rekom = "<div class='col-md-12 list-rekomendasi' style='height:72px; padding-top: 10px; border-bottom: 1px solid #cdd8e3'>" +
                "<div class='form-group'>" +
                "<label class='col-md-2 control-label no-padding-right no-padding-left' for='rk-1'> Rekomendasi <span class='no_rekom'></span> :</label>" +
                "<div class='col-md-10 no-padding-right'>" +
                "<div class='col-md-6'>" +
                "<textarea placeholder='Rekomendasi' class='rekom form-control'></textarea>" +
                "</div><div class='col-md-2 no-padding-left'>" +
                "<div class='input-group'>" +
                "<span class='input-group-addon'>" +
                "<i class='ace-icon fa fa-barcode'></i></span>" +
                "<select name='kode_rekomendasi[][]' class='koderekom form-control'>" +
                "<option>- Kode -</option>" +
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
                "<div class='col-md-9 no-padding'>" +
                "<div class='input-group'>" +
                "<span class='input-group-addon'>" +
                "<i class='ace-icon fa fa-money'></i>" +
                "</span>" +
                "<input class='nilairekom form-control' type='text' name='nilairekomendasi[][]' placeholder='Nilai Uang'>" +
                "</div>" +
                "</div>" +
                "<div class='col-md-3 no-padding'>" +
                "<button type='button' class='btn pull-right btn-xs btn-white btn-danger' id='HapusRekomendasi' title='Hapus Rekmendasi'><i class='fa fa-minus'> Rekom </i>" +
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
</body>
</html>

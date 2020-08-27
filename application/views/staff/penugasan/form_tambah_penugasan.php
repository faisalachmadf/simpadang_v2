<?php
error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));
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
                    <a href="<?= site_url('staff/home'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?= site_url('staff/penugasan'); ?>">Penugasan</a>
                </li>
                <li class="active"> Tambah Penugasan </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Tambah Penugasan
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan data penugasan pemeriksaan
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form id="validasi" class="form-horizontal" role="form" action="<?php site_url('staff/penugasan/tambah_penugasan'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah Penugasan
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                            <!-- ID Penugasan -->
                                            <input type="hidden" name="id_penugasan" value="<?= $id_tgs; ?>">
                                            <!-- ID Tim -->
                                            <input type="hidden" name="id_tim" value="<?= $id_tim; ?>">			   

                                            <!-- nomor urut (untuk surat tugas, rp & kp) -->
                                            <input type="hidden" name="no_urut" value="<?= $no_urut; ?>">
                                            <!-- nomor kegiatan pengawasan (KP) -->
                                            <input type="hidden" name="no_kp" value="705/KP-<?= $no_id; ?>">
                                            <!-- nomor rencana pengawasan (RP) -->
                                            <input type="hidden" name="no_rp" value="705/RP-<?= $no_id; ?>">
                                            <!-- kategori tim -->
                                            <input type="hidden" name="kategori_tim" value="Tim Pemeriksa" />	

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan data kegiatan pengawasan </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal Penugasan </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input type='text' name='tgl_tgs' class='col-xs-8 col-sm-2' placeholder='Tanggal' required/>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Wakil Penanggung Jawab </label>
                                                <div class="col-sm-9">
                                                    <select name="daltu" class="select2 required" data-placeholder="Pilih Wakil Penanggung Jawab" required>
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($irban as $row) {
                                                            echo "<option value='$row->id_pegawai'> $row->nama [$row->jabatan] </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right" for="form-field-tags">
                                                            Pengendali Teknis
                                                            <span class="help-button" title="Dalam pembuatan tim baru ini, apakan membutuhkan Pengendali Teknis?">?</span>
                                                    </label>
                                                    <div class="col-sm-9">
                                                            <div class="radio">
                                                                    <label>
                                                                            <input type="radio" name="stat_dalnis" class="ace dalnis" value="ya" checked="" />
                                                                            <span class="lbl"> Ya </span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;

                                                                    <label>
                                                                            <input type="radio" name="stat_dalnis" class="ace dalnis" value="tidak" />
                                                                            <span class="lbl"> Tidak </span>
                                                                    </label>
                                                            </div>
                                                    </div>
                                            </div> -->

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Pengendali Teknis </label>
                                                <div class="col-sm-9">
                                                    <select name="dalnis" class="select2 required" data-placeholder="Pilih Pengendali Teknis" required>
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($dalnis as $row) {
                                                            echo "<option value='$row->id_pegawai'> $row->nama </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>													

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Ketua Tim </label>
                                                <div class="col-sm-9">
                                                    <select name="ketua_tim" class="select2 required" data-placeholder="Pilih Ketua Tim" required>
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($pegawai as $row) {
                                                            echo "<option value='$row->id_pegawai'> $row->nama </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <input type="hidden" name="jml_agt" id="ke" value="2" />

                                            

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Anggota </label>
                                                <div class="col-sm-9">
                                                    <select name="anggota[]" class="select2 required" data-placeholder="Pilih Anggota Ke-1" required>
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($pegawai as $row) {
                                                            echo "<option value='$row->id_pegawai'> $row->nama </option>";
                                                        }
                                                        ?>
                                                    </select> <br/><br/>

                                                    <div id="form_agt"></div>

                                                    <div id="alert">
                                                        <i style="color:red">
                                                            <i class="fa fa-exclamation-triangle"></i> Batas Maks. 20 Anggota
                                                        </i>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> </label>
                                                <div class="col-sm-9">
                                                    <button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenAgt();
                                                            return false;" title="Tambah anggota">
                                                        <i class="fa fa-plus"></i>
                                                        Tambah Anggota
                                                    </button>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nama Kegiatan Pengawasan </label>
                                                <div class="col-sm-9">
                                                    <textarea required name="nama_kp" rows="3" cols="74" placeholder="Nama kegiatan pengawasan"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nama Objek Pengawasan </label>
                                                <div class="col-sm-9">
                                                    <textarea required name="nama_op" rows="3" cols="74" placeholder="Nama objek pengawasan"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Alamat Kantor </label>
                                                <div class="col-sm-9">
                                                    <textarea required name="alamat_kantor" rows="3" cols="50" placeholder="Alamat kantor"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nomor Telepon </label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="no_tlp" class="col-xs-10 col-sm-3" placeholder="Nomor telepon" />
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Program Pengawasan </label>
                                                <div class="col-sm-9">
                                                    <input required type="text" name="program_peng" class="col-xs-10 col-sm-8" placeholder="Program pengawasan" />
                                                </div>
                                            </div>

                                            <input type="hidden" name="jml_ins" id="kee" value="2" />
                                            <input type="hidden" name="kondisi_sasaran" id="kondisi-sasaran" value="input" />

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> </label>
                                                <div class="col-sm-9">
                                                    <div class='alert alert-block alert-danger'>
                                                        <p>
                                                            <strong>
                                                                <i class='ace-icon fa fa-exclamation-triangle'></i>
                                                                Penting!
                                                            </strong> <br/>
                                                            Jika hanya 1 (satu) sasaran pengawasan, maka tidak perlu memilih sasaran.<br/>
                                                            Cukup mengisi sasaran pengawasan pada form <strong>Sasaran Pengawasan</strong> berikut ini.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Sasaran Pengawasan </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="sasaran_peng" class="col-xs-10 col-sm-8" placeholder="Sasaran pengawasan" />

                                                    &nbsp;

                                                    <label class="control-label">
                                                        <input type="checkbox" name="file-format" id="pilih-sasaran" class="ace" />
                                                        <span class="lbl"> Pilih Sasaran</span>
                                                    </label>
                                                    <span class="help-button" title="Memilih instansi sebagai sasaran pengawasan.">?</span>
                                                    <br/><br/>

                                                    <input type="hidden" name="kecamatan" value=""/>

                                                    <!-- <div class="form-sasaran">
                                                        <select name="kecamatan" class="select2" data-placeholder="Pilih Kecamatan" id="kecamatan" >
                                                            <option>&nbsp;</option>
                                                            <?php
                                                            foreach ($kecamatan as $row) {
                                                                echo "<option value='$row->id_instansi'> $row->nama_kecamatan </option>";
                                                            }
                                                            ?>
                                                        </select> <br/><br/>
                                                    </div>  -->

                                                    

                                                    <div class="form-sasaran">
                                                        <select name="sasaran[]" class="select2 desa" data-placeholder="-- Pilih Instansi Ke-1 --">
                                                            <option disabled selected></option>
                                                            <?php
                                                            foreach ($desa as $row) {
                                                                echo "<option value='$row->nama_desa'> $row->nama_desa </option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <br/><br/>                                                                                                                               <!-- <select name="sasaran[]" class="select2" data-placeholder="Pilih Instansi Ke-1" id="form-sasaran1">
                                                        <?php
                                                        foreach ($instansi as $row) {
                                                            echo "<option value='$row->nama_instansi'> $row->nama_instansi </option>";
                                                        }
                                                        ?> </select> <br/><br/> -->
                                                    </div> 

                                                    <div id="form_ins" class="form-sasaran"></div>

                                                    <div id="tbh-sasaran">
                                                        <button type="button" class="btn btn-xs btn-warning" onclick="tambahElemenIns();
                                                                return false;" title="Tambah sasaran">
                                                            <i class="fa fa-plus"></i>
                                                            Tambah Sasaran
                                                        </button> <br/><br/>
                                                    </div> 

                                                    <div id="alert2">
                                                        <i style="color:red">
                                                            <i class="fa fa-exclamation-triangle"></i> Batas Maks. 30 Instansi
                                                        </i>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tujuan Pengawasan </label>
                                                <div class="col-sm-9">
                                                    <textarea required name="tujuan_peng" rows="5" cols="74" placeholder="Tujuan pengawasan"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Laporan Dikirim Kepada </label>
                                                <div class="col-sm-9">
                                                    <textarea required name="tujuan_lap" rows="3" cols="50" placeholder="Penerima laporan pemeriksaan"></textarea>
                                                </div>
                                            </div>

                                            <div class="hr hr-double dotted"></div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan data surat tugas untuk tim pemeriksa. </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal Surat </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input required type='text' name='tgl_surat' class='col-xs-8 col-sm-2' placeholder='Tanggal' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nomor Surat </label>
                                                <div class="col-sm-5">
                                                    <input required type="text" name="no_surat" class="col-xs-12 col-sm-5" value="705/ST-<?= $no_surat; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Dasar Surat </label>
                                                <div class="col-sm-5">
                                                    <textarea required name="dasar_surat" rows="3" cols="60" placeholder="Dasar surat"><?= $dasar->isi; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Perihal </label>
                                                <div class="col-sm-8">
                                                    <textarea name="perihal" id="ckeditor" class="ckeditor"></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Waktu Pelaksanaan </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input required type='text' name='tgl_awal' class='col-xs-8 col-sm-2' placeholder='Dari Tanggal' />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input required type='text' name='tgl_akhir' class='col-xs-8 col-sm-2' placeholder='Sampai Tanggal' />
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="jml_tbs" id="ke3" value="<?= $max_tbs->max_tbs + 1; ?>" />

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tembusan </label>
                                                <div class="col-sm-9">
                                                    <label class="control-label">
                                                        <?php
                                                        foreach ($tembusan as $row) {
                                                            echo "<p id='trow$row->nomor'><input type='text' name='tembusan[]' size='70' value='$row->isi' placeholder='Tembusan 1' required /> 
																	<a href='#' onclick='hapusElemenTbs(\"#trow$row->nomor\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan $row->nomor'> <i class='fa fa-minus'></i> </a></p> ";
                                                        }
                                                        ?>

                                                        <div id="form_tbs"></div>
                                                        <div id="alert3"><i style="color:red"><i class="fa fa-exclamation-triangle"></i> Batas Maks. 10 Tembusan</i></div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right">  &nbsp; </label>
                                                <div class="col-sm-9">
                                                    <label class="control-label">
                                                        <button type="button" class="btn btn-sm btn-warning" onclick="tambahElemenTbs();
                                                                return false;" title="Tambah tembusan">
                                                            <i class="fa fa-plus"></i>
                                                            Tambah Tembusan
                                                        </button>
                                                    </label>
                                                </div>
                                            </div>										

                                            <div align="center" class="clearfix form-actions">
                                                <a href="<?= site_url('staff/penugasan'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

                                                &nbsp;&nbsp;

                                                <a href="<?php site_url('staff/penugasan/tambah_penugasan'); ?>" class="btn btn-danger"><i class="ace-icon fa fa-refresh bigger-110"></i> Bersihkan</a>

                                                &nbsp; &nbsp;

                                                <input class="btn btn-info" type="submit" name="submit" value="Tambahkan"></input>														
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </form>

                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </div><!-- /.page-content -->

    </div>
</div><!-- /.main-content -->

<input type="hidden" id="tgl" value="<?= date('Y-m-d H:i'); ?>" />

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">

    $(document).ready(function ()
    {


        var tgl = document.getElementById("tgl").value;
        //datepicker
        $('.datepicker').datetimepicker({
            weekStart: 1,
            daysOfWeekDisabled: [0, 6],
            language: 'id',
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
        });
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
        $('#input-mask-phone').inputmask('0299-9{1,4}-9{1,4}');
        $('.select2').css('width', '310px').select2({allowClear: false});
        //dalnis
        /*$('.dalnis').click(function(){
         if($(this).val() == "ya")
         {
         $('#form-dalnis').slideDown('fast');
         }
         else
         {
         $('#form-dalnis').slideUp('fast');
         }
         });*/

        $("#tbh-sasaran").hide();
        $(".form-sasaran").hide();
        //--> kondisi sasaran
        $('#pilih-sasaran').removeAttr('checked').on('change', function () {
            if (this.checked) {
                $('#kec2').slideUp();
                $('#tbh-sasaran').slideDown();
                $('.form-sasaran').slideDown();
                document.getElementById("kondisi-sasaran").value = "pilih";
                $("[name='kecamatan']").val("INS00001");
                
            }
            else {
                $('#kec2').slideDown();
                $('#tbh-sasaran').slideUp();
                $('.form-sasaran').slideUp();
                document.getElementById("kondisi-sasaran").value = "input";
                $("[name='kecamatan']").val("");
            }
        });
        //tembusan
        $('#form-tembusan').hide();
        $('.rad2').click(function () {
            if ($(this).val() == "tbs_ada")
            {
                $('#form-tembusan').slideDown('fast');
            }
            else
            {
                $('#form-tembusan').slideUp('fast');
            }
        });



        
    });
    //Jumlah anggota
    $("#alert").hide();
    function tambahElemenAgt() {
        var ke = document.getElementById("ke").value;
        if (ke > 20)
        {
            $("#alert").show();
        }
        else
        {
            var stre;
            stre = "<p id='arow" + ke + "'>" +
            "	<select id='tbh_agt" + ke + "' name='anggota[]' class='select2 required' data-placeholder='-- Pilih Anggota Ke-" + ke + " --' required>" +
            "		<option value='' disabled selected>-- Pilih Anggota Ke-" + ke + " --</option><?php
            foreach ($pegawai as $row) {
                echo "<option value='$row->id_pegawai'> $row->nama </option>";
            }
            ?>" +
            "	</select>" +
            "  <a href='#' onclick='hapusElemenAgt(\"#arow" + ke + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus anggota ke-" + ke + "'> <i class='fa fa-minus'></i> </a>" +
            "</p>";
            $("#form_agt").append(stre);
            $('#tbh_agt'+ ke).select2();
            ke = (ke - 1) + 2;
            document.getElementById("ke").value = ke;
            $("#alert").hide();
        }
    }

    function hapusElemenAgt(ke) {
        $("#alert").hide();
        $(ke).remove();
        var ke2 = document.getElementById("ke").value;
        ke3 = ke2 - 1;
        document.getElementById("ke").value = ke3;
    }
    //.jumlah anggota

    //Jumlah instansi
    $("#alert2").hide();
    function tambahElemenIns() {

        var kee = document.getElementById("kee").value;
        if (kee > 30)
        {
            $("#alert2").show();
        }
        else
        {
            var stre;
            stre = "<p id='irow" + kee + "'>" +
                    "	<select data-placeholder='-- Pilih Instansi Ke-" + kee + " --' required id='tbh" + kee + "' name='sasaran[]' data-live-search='true' class='select2 desa'>" +
                    "	<option disabled selected></option>" +
                    "	<option>&nbsp;</option> <?php foreach ($desa as $row) { 
                        echo "<option value='$row->nama_desa'> $row->nama_desa </option>";}?>"+
                    "	</select>" +
                    "  <a href='#' onclick='hapusElemenIns(\"#irow" + kee + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus instansi ke-" + kee + "'> <i class='fa fa-minus'></i> </a>" +
                    "</p>";
            $("#form_ins").append(stre);
            $('#tbh'+ kee).select2();
            kee = (kee - 1) + 2;
            document.getElementById("kee").value = kee;
            $("#alert2").hide();

        }
    }

    function hapusElemenIns(kee) {
        $("#alert2").hide();
        $(kee).remove();
        var kee2 = document.getElementById("kee").value;
        kee3 = kee2 - 1;
        document.getElementById("kee").value = kee3;
    }
    //.jumlah anggota

    //Tembusan
    $("#alert3").hide();
    function tambahElemenTbs() {
        var ke3 = document.getElementById("ke3").value;
        if (ke3 > 10)
        {
            $("#alert3").show();
        }
        else
        {
            var stre;
            stre = "<p id='trow" + ke3 + "'> <input required type='text' size='70' name='tembusan[]' placeholder='Tembusan " + ke3 + "' /> <a href='#' onclick='hapusElemenTbs(\"#trow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan " + ke3 + "'> <i class='fa fa-minus'></i> </a> </p>";
            $("#form_tbs").append(stre);
            ke3 = (ke3 - 1) + 2;
            document.getElementById("ke3").value = ke3;
            $("#alert3").hide();
        }
    }

    function hapusElemenTbs(ke3) {
        $("#alert3").hide();
        $(ke3).remove();
        var ke4 = document.getElementById("ke3").value;
        ke5 = ke4 - 1;
        document.getElementById("ke3").value = ke5;
    }
    //.Tembusan	

</script>

</body>
</html>

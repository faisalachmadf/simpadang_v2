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
                    <a href="<?= site_url('staff/penugasan'); ?>">Nota Dinas</a>
                </li>
                <li class="active"> Buat Nota Dinas </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Buat Nota Dinas
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan data nota dinas
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form id="validasis" class="form-horizontal" role="form" action="<?php site_url('irban/notadinas/tambah_notadinas'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah Nota Dinas
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                            <!-- ID Nota Dinas -->
                                            <input type="hidden" name="notadinas_id" value="<?= $id_nd; ?>">
                                            <!-- ID Tim -->
                                            <input type="hidden" name="id_tim" value="<?= $id_tim; ?>">			   

                                            <!-- nomor urut (untuk surat tugas, rp & kp) -->
                                            <input type="hidden" name="no_urut" value="<?= $no_urut; ?>">
                                            <!-- nomor kegiatan pengawasan (KP) -->
                                            <input type="hidden" name="no_kp" value="705/KP-<?= $no_id; ?>">
                                            <!-- nomor rencana pengawasan (RP) -->
                                            <input type="hidden" name="no_rp" value="705/RP-<?= $no_id; ?>">
                                            <!-- kategori tim -->
                                            <input type="hidden" name="kategori_tim" value="Tim Nota Dinas" />	
                                            <!-- Status Nota Dinas -->
                                            <input type="hidden" name="status" value="0" />

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan data nota dinas </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal Nota Dinas </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input type='text' name='tgl' class='col-xs-8 col-sm-2' placeholder='Tanggal' value="<?= set_value('tgl'); ?>" required /> <small class="form-text text-danger"><?= form_error('tgl'); ?></small>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nomor Nota Dinas </label>

                                                <div class="col-sm-5">  
                                                    <input required type="text" name="nomor" class="col-xs-12 col-sm-5" value="708/<?= $no_id; ?>"><small class="form-text text-danger"><?= form_error('nomor'); ?></small>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Wakil Penanggung Jawab </label>
                                                <div class="col-sm-9">
                                                    <small class="form-text text-danger"></small>
                                                    <select required name="daltu" class="select2" data-placeholder="Pilih Wakil Penanggung Jawab" class="" >
                                                        <option disabled selected></option>
                                                        <?php
                                                        foreach ($irban as $row) {
                                                            echo "<option value='$row->id_pegawai'> $row->nama [$row->jabatan] </option>";
                                                        }
                                                        ?>
                                                    </select>
                                                    
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Pengendali Teknis </label>
                                                <div class="col-sm-9">
                                                    <small class="form-text text-danger"></small>
                                                    <select required name="dalnis" class="select2" data-placeholder="Pilih Pengendali Teknis" >
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
                                                <div class="col-sm-9" >
                                                    <small class="form-text text-danger"></small>
                                                    <select required name="ketua_tim" class="select2" data-placeholder="Pilih Ketua Tim" >
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
                                                    <small class="form-text text-danger"></small>
                                                    <select required name="anggota[]" class="select2" data-placeholder="Pilih Anggota Ke-1 " >
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
                                            <label class="col-sm-3 control-label no-padding-right"> Hal Nota Dinas </label>
                                            <div class="col-sm-9">
                                                <textarea required name="hal" rows="3" cols="74" placeholder="hal Pengawasan" ><?= set_value('hal'); ?></textarea><small class="form-text text-danger"><?= form_error('hal'); ?></small>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-3 control-label no-padding-right"> Nama Objek Pengawasan </label>
                                            <div class="col-sm-9">
                                                <textarea required name="nama_objek" rows="3" cols="74" placeholder="Nama objek pengawasan" ><?= set_value('nama_objek'); ?></textarea><small class="form-text text-danger"><?= form_error('nama_objek'); ?></small>
                                            </div>
                                        </div>

                                        <hr/>

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
                                                <input required type="text" required name="sasaran_peng" class="col-xs-10 col-sm-8" placeholder="Sasaran pengawasan" value="<?= set_value('sasaran_peng'); ?>" />
                                                <small class="form-text text-danger"><?= form_error('sasaran_peng'); ?></small>

                                                &nbsp;

                                                <label class="control-label">
                                                    <input type="checkbox" name="file-format" id="pilih-sasaran" class="ace" />
                                                    <span class="lbl"> Pilih Sasaran</span>
                                                </label>
                                                <span class="help-button" title="Memilih instansi sebagai sasaran pengawasan.">?</span>
                                                <br/><br/>

                                                <input type="hidden" name="kecamatan" value=""/>

                                                    <div class="form-sasaran">
                                                        <select  name="sasaran[]" class="select2 desa" data-placeholder="-- Pilih Instansi Ke-1">
                                                            <option disabled selected></option>
                                                            <?php
                                                            foreach ($desa as $row) {
                                                                echo "<option value='$row->nama_desa'> $row->nama_desa </option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        <br/><br/>                                                                                                                             
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



                                        <!--    <div id="form_ins" class="form-sasaran"></div> -->



                                    </div>
                                </div>




                                <div class="hr hr-double dotted"></div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Waktu Pelaksanaan </label>
                                    <div class="col-sm-9">
                                        <div class='input-group date datepicker'>
                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                            <input required type='text' name='tgl_awal' class='col-xs-8 col-sm-2' placeholder='Dari Tanggal'    value="<?= set_value('tgl_awal'); ?>"/>
                                        </div><small class="form-text text-danger"><?= form_error('tgl_awal'); ?></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> </label>
                                    <div class="col-sm-9">
                                        <div class='input-group date datepicker'>
                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                            <input  required type='text' name='tgl_akhir' class='col-xs-8 col-sm-2' placeholder='Sampai Tanggal'  value="<?= set_value('tgl_akhir'); ?>"/>
                                        </div><small class="form-text text-danger"><?= form_error('tgl_akhir'); ?></small>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Lampiran </label>
                                    <div class="col-sm-8">
                                        <input required type="text" name="lampiran" class="col-xs-12 col-sm-5" value="<?= set_value('lampiran'); ?>"><small class="form-text text-danger"><?= form_error('lampiran'); ?></small>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label no-padding-right"> Isi Nota Dinas </label>
                                    <div class="col-sm-8">
                                        <textarea  name="isi_nota" id="ckeditor" class="ckeditor" ><?= set_value('isi_nota'); ?></textarea><small class="form-text text-danger"><?= form_error('isi_nota'); ?></small>
                                    </div>
                                </div>




                                <div align="center" class="clearfix form-actions">
                                    <a href="<?= site_url('irban/notadinas'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

                                    &nbsp;&nbsp;

                                    <button class="btn btn-danger" type="reset">
                                        <i class="ace-icon fa fa-refresh bigger-110"></i>
                                        Bersihkan
                                    </button>

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
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript">

    var bazit;
    bazit = 
    "  <?php
    foreach ($sasaran as $row) {
        echo "$row->id ";
    }
    ?>";

    var bazit_imam = [
    'imam',
    'cahya',
    'suka'
    ];

    $("#nama_instansi").autocomplete({
        source : bazit
        /*source: "<?=site_url('Notadinas/autocomplete_namainstansi/?')?>"*/
    });

    $("#nama_instansi2").autocomplete({
      source: bazit_imam
  });
</script>
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
            "	<select name='anggota[]' class='select2' data-placeholder='-- Pilih Anggota Ke-" + ke + " --' required>" +
            "		<option value='' disabled selected>-- Pilih Anggota Ke-" + ke + " --</option> <?php foreach ($pegawai as $row) { echo "<option value='$row->id_pegawai'> $row->nama </option>"; } ?>" +
            "	</select>" +
            "  <a href='#' onclick='hapusElemenAgt(\"#arow" + ke + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus anggota ke-" + ke + "'> <i class='fa fa-minus'></i> </a>" +
            "</p>";
            $("#form_agt").append(stre);
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
            "   <select data-placeholder='-- Pilih Instansi Ke-" + kee + " --' id='tbh" + kee + "' name='sasaran[]' data-live-search='true' class='select2 desa'>" +
            "   <option value='' disabled selected>-- Pilih Instansi Ke-" + kee + " --</option>" +
            "   <option>&nbsp;</option> <?php foreach ($desa as $row) { 
                echo "<option value='$row->nama_desa'> $row->nama_desa </option>";}?>"+
                "   </select>" +
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
            stre = "<p id='trow" + ke3 + "'> <input type='text' size='70' name='tembusan[]' placeholder='Tembusan " + ke3 + "' /> <a href='#' onclick='hapusElemenTbs(\"#trow" + ke3 + "\"); return false;' class='btn btn-sm btn-danger' title='Hapus tembusan " + ke3 + "'> <i class='fa fa-minus'></i> </a> </p>";
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

    $(document).ready(function ()
    {
        $("#kecamatan").change(function () {
            var value = $(this).val();
            $.ajax({
                type: 'post',
                url: "<?= site_url('staff/penugasan/get_desa'); ?>",
                data: {id: value}, //'rowid='+ rowid,
                success: function (data)
                {
                    $('.desa').html(data); //menampilkan data ke dalam modal
                }
            });
        });
    });
</script>

</body>
</html>

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
                <h1>
                    Tambah Tindak Lanjut
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan data penugasan tindak lanjut
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form id="validasi" class="form-horizontal" role="form" action="<?php site_url('ketua_tl/tindak_lanjut/tambah_tl'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah Tindak Lanjut
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                            <!-- ID Tidak lanjut -->
                                            <input type="hidden" name="id_tl" value="<?= $data->id_tl; ?>">
                                            <!-- ID tugas -->
                                            <input type="hidden" name="id_tgs" value="<?= $data->fk_tgs; ?>">
                                            <!-- ID Tim -->
                                            <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
                                            <!-- Nomor LHP -->
                                            <input type="hidden" name="no_lhp" value="<?= $data->no_lhp; ?>">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan data kegiatan tindak lanjut </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nomor LHP </label>
                                                <div class="col-sm-5">
                                                    <label class="control-label"> <strong><?= $data->no_lhp; ?></strong> </label>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Jumlah Setoran </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='jml_kas_negara' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Negara' /> </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Disetor </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='setor_kas_negara' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Negara' /> </label>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Jumlah Pengembalian </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='jml_kas_daerah' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Daerah' /> </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Disetor </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='setor_kas_daerah' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Daerah' /> </label>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Jumlah Pengembalian </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='jml_kas_desa' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Desa / Sekolah' /> </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Disetor </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='setor_kas_desa' class='col-xs-10 col-sm-4 mask-money' placeholder='Ke Rek. Kas Desa / Sekolah' /> </label>
                                                </div>
                                            </div>

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nama Pejabat Setempat </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='nama_pejabat' class='col-xs-10 col-sm-7' placeholder='Mengetahui . .' /> </label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> NIP Pejabat Setempat </label>
                                                <div class="col-sm-9">
                                                    <input type='text' name='nip_pejabat' class='col-xs-10 col-sm-4' placeholder='Masukan NIP pejabat' /> </label>
                                                </div>
                                            </div>

                                            <br/>

                                            <label class="i b red"> Keterangan Kategori Tindak Lanjut : S = SELESAI; DP = DALAM PROSES; B = BELUM dan CR = CACAT REKOMENDASI. </label> <br/>

                                            <table width="100%" border="0" id="get_row">
                                                <tr>
                                                    <th width="3%"></th>
                                                    <th width="3%"></th>
                                                    <th></th>
                                                    <th width="7%"></th>
                                                    <th width="25%"></th>
                                                    <th width="7%"></th>
                                                    <th width="25%"></th>
                                                    <th width="7%"></th>
                                                </tr>

                                                <tr><td colspan='8'><div class="hr hr-double hr-dotted hr18"></div></td></tr>

                                                <tr>
                                                    <td class="b u c"> No. </td>
                                                    <td class="c"> <i class="fa fa-cog"> </i> </td>
                                                    <td align="center" class="b u"> Uraian Temuan </td>
                                                    <td align="center" class="b u"> Kode Temuan </td>
                                                    <td align="center" class="b u"> Uraian Rekomendasi </td>
                                                    <td align="center" class="b u"> Kode Rekom. </td>
                                                    <td align="center" class="b u"> Uraian Tindak Lanjut </td>
                                                    <td align="center" class="b u"> Ket </td>
                                                </tr>

                                                <tr><td colspan='8'><div class="hr hr-double hr-dotted hr18"></div></td></tr>

                                                <input type="hidden" name="jml_uri" id="jml-uri" value="2" />

                                                <?php
                                                echo "
															<tr>
																<td class='c'> 1. </td>
																<td> 
																	<button type='button' class='btn btn-xs btn-warning' onclick='tambahElemenUri(); return false;' title='Tambah uraian'><i class='fa fa-plus'></i></button> 
																</td>
																<td class='pad-3'>
																	<textarea name='uraian_temuan[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian temuan'></textarea>
																</td>

																<td class='pad-3'>
																	<select name='kode_temuan[]'>
																		<option> - Pilih - </option>
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
																</td>

																<td class='pad-3'>
																	<textarea name='uraian_rekomendasi[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian rekomendasi'></textarea>
																</td>

																<td class='pad-3'>
																	<select name='kode_rekomendasi[]'>
																		<option> - Pilih - </option>
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
																</td>

																<td class='pad-3'>
																	<textarea name='uraian_tl[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian tindak lanjut'></textarea>
																</td>																

																<td class='pad-3'>
																	<input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' />
																</td>
															</tr>
															";
                                                ?>														
                                            </table>

                                                                                                                                <!-- <td class='pad-3'>
                                                                                                                                        <select name='kategori[]'>
                                                                                                                                                <option> -- Pilih -- </option>
                                                                                                                                                <option value='S'> S </option>
                                                                                                                                                <option value='DP'> DP </option>
                                                                                                                                                <option value='B'> B </option>
                                                                                                                                                <option value='CR'> CR </option>
                                                                                                                                        </select>
                                                                                                                                </td> -->

                                            <div align="center" class="clearfix form-actions">
                                                <a href="<?= site_url('ketua_tl/tindak_lanjut/detail_tl/' . base64_encode($data->id_tl) . '/' . base64_encode($data->id_tim)); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

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

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function ()
    {
        var tgl = document.getElementById("tgl").value;
        //datepicker
        $('.datepicker').datetimepicker({
            language: 'id',
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            startDate: tgl
        });

        $('.mask-money').maskMoney({prefix: 'Rp. ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false, precision: 0});
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
                $('#input-sasaran').hide();
                $('#tbh-sasaran').slideDown();
                $('.form-sasaran').slideDown();
                document.getElementById("kondisi-sasaran").value = "pilih";
            }
            else {
                $('#input-sasaran').show();
                $('#tbh-sasaran').slideUp();
                $('.form-sasaran').slideUp();
                document.getElementById("kondisi-sasaran").value = "input";
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

        /* Validasi */
        $('#validasi').validate({
            //-- Aturan karakter input --//
            rules:
                    {
                        daltu: {required: true},
                        dalnis: {required: true},
                        ketua_tim: {required: true},
                        nama_kp: {required: true},
                        nama_op: {required: true},
                        program_peng: {required: true},
                        sasaran_peng: {required: true},
                        tujuan_peng: {required: true},
                        tgl_awal: {required: true},
                        tgl_akhir: {required: true}
                        //password			 : {required: true, maxlength: 20}
                    },
            //-- Pesan error --//
            messages:
                    {
                        daltu:
                                {
                                    required: "<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label> &nbsp;"
                                            //maxlength : "<div style='color:red'>Tidak boleh lebih dari 50 huruf</div>"
                                },
                        dalnis:
                                {
                                    required: "<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label> &nbsp;"
                                },
                        ketua_tim:
                                {
                                    required: "<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label> &nbsp;"
                                },
                        nama_kp:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        nama_op:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        program_peng:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        sasaran_peng:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        tujuan_peng:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        tgl_awal:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                },
                        tgl_akhir:
                                {
                                    required: "&nbsp; <label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>"
                                }
                    },
            submitHandler: function (form) {
                form.submit();
            }
        });
    });

    //Jumlah tujuan pemeriksaan
    function tambahElemenUri()
    {
        var uri = document.getElementById("jml-uri").value;
        var stre;


        stre = "<tr id='uri_row" + uri + "' class='bor-top'>" +
                "	<td class='c'>" + uri + ".</td>" +
                "	<td class='c'>" +
                " 		<a href='#' onclick='hapusElemenUri(\"#uri_row" + uri + "\"); return false;' class='btn btn-xs btn-danger' title='Hapus uraian'> <i class='fa fa-minus'></i> </a>" +
                "  </td>" +
                "	<td class='pad-3'> <textarea name='uraian_temuan[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian temuan'></textarea> </td>" +
                "	<td class='pad-3'>" +
                "		<select name='kode_temuan[]'>" +
                "			<option> - Pilih - </option>" +
                "			<option value='101'> 101 </option>" +
                "			<option value='102'> 102 </option>" +
                "			<option value='103'> 103 </option>" +
                " 			<option value='104'> 104 </option>" +
                "			<option value='105'> 105 </option>" +
                "			<option value='201'> 201 </option>" +
                "			<option value='202'> 202 </option>" +
                "			<option value='203'> 203 </option>" +
                "			<option value='301'> 301 </option>" +
                "			<option value='302'> 302 </option>" +
                "			<option value='303'> 303 </option>" +
                "		</select>" +
                "	</td>" +
                "	<td class='pad-3'> <textarea name='uraian_rekomendasi[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian rekomendasi'></textarea> </td>" +
                "	<td class='pad-3'>" +
                "		<select name='kode_rekomendasi[]'>" +
                "			<option> - Pilih - </option>" +
                "			<option value='00'> 00 </option>" +
                "			<option value='01'> 01 </option>" +
                "			<option value='02'> 02 </option>" +
                " 			<option value='03'> 03 </option>" +
                "			<option value='04'> 04 </option>" +
                "			<option value='05'> 05 </option>" +
                "			<option value='06'> 06 </option>" +
                "			<option value='07'> 07 </option>" +
                "			<option value='08'> 08 </option>" +
                "			<option value='09'> 09 </option>" +
                "			<option value='10'> 10 </option>" +
                "			<option value='11'> 11 </option>" +
                "			<option value='12'> 12 </option>" +
                "			<option value='13'> 13 </option>" +
                "			<option value='14'> 14 </option>" +
                "		</select>" +
                "	</td>" +
                "	<td class='pad-3'> <textarea name='uraian_tl[]' rows='2' cols='33' style='color:black;' placeholder='Isi uraian tindak lanjut'></textarea> </td>" +
                /* "	<td class='pad-3'>"+
                 "		<select name='kategori[]'>"+
                 "			<option> - Pilih - </option>"+
                 "			<option value='S'> S </option>"+
                 "			<option value='DP'> DP </option>"+
                 "			<option value='B'> B </option>"+
                 " 			<option value='CR'> CR </option>"+
                 "		</select>"+
                 "	</td>"+*/
                "	<td class='pad-3'> <input type='text' name='keterangan[]' class='col-xs-10 col-sm-12' placeholder='Ket' /> </td>" +
                "</tr>";

        $("#get_row").append(stre);
        uri = (uri - 1) + 2;
        document.getElementById("jml-uri").value = uri;
    }

    function hapusElemenUri(id_elemen)
    {
        $(id_elemen).remove();

        var uri = document.getElementById("jml-uri").value;
        uri = uri - 1;
        document.getElementById("jml-uri").value = uri;
    }
    //.jumlah tujuan pemeriksaan

    $(document).ready(function ()
    {
        $("#kecamatan").change(function () {
            var value = $(this).val();

            $.ajax({
                type: 'post',
                url: "<?= site_url('staff/tindak_lanjut/get_desa'); ?>",
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

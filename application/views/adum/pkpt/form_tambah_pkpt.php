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
                    <a href="<?= site_url('staff/pkpt'); ?>">PKPT</a>
                </li>
                <li class="active"> Tambah PKPT </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="page-header">
                <h1>
                    Tambah PKPT
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan data PKPT
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->
                 
                    <form class="form-horizontal" role="form" action="<?php site_url('staff/pkpt/tambah_pkpt'); ?>" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah pkpt
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
                                                    <h4 class="header center"> Masukan data PKPT </h4>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                             <label class="col-sm-3 control-label no-padding-right"> TAHUN PKPT </label>
                                             <div class="col-sm-9">
                                                <div class="input-group">
                                                    <select class="form-control" name="tahun">
                                                      <option value="">--Pilih Tahun--</option>
                                                      <option value="2020">2020</option>
                                                      <option value="2021">2021</option>
                                                      <option value="2022">2022</option>
                                                      <option value="2023">2023</option>
                                                      <option value="2024">2024</option>
                                                  </select>
                                                  <small class="form-text text-danger"> <?= form_error('tahun'); ?></small>
                                                  </div>
                                              </div>
                                          </div>

                                          <!--   <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> TAHUN PKPT </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group date datepicker2'>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                        <input type='text' name='tgl_tgs' class='col-xs-8 col-sm-2' placeholder='TAHUN' readonly='' />
                                                    </div>
                                                </div>
                                            </div> -->

                                            <hr/>

                                          
                                        
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Judul PKPT </label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="judul" class="col-xs-10 col-sm-10" placeholder="Judul PKPT" value="<?= set_value('judul'); ?>"/>
                                                    <small class="form-text text-danger"> <?= form_error('judul'); ?></small>
                                                </div>
                                            </div>

                                            <hr/>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Upload PKPT </label>
                                                <div class="col-sm-9">
                                                    <div class='input-group '>
                                                        <span class='input-group-addon'><i class="ace-icon fa fa-files-o bigger-110"></i></span>

                                                        <input type="file" class="form-control-file" class='col-xs-8 col-sm-2' id="file" name="file_upload">
                                                        <br>

                                                      
                                                    </div>
                                                    <div class="alert alert-danger col-md-5" role="alert" >
                                                            <small><strong>file harus berformat PDF | DOC | DOCX | XSL | XSLS!</strong></small>
                                                        </div>
                                                      <small class="form-text text-danger"> <?= form_error('file_upload'); ?></small>
                                                </div>
                                            </div>
                                            <div align="center" class="clearfix form-actions">
                                                <a href="<?= site_url('adum/pkpt'); ?>" class="btn btn-default"><i class="fa fa-arrow-left"></i> Kembali</a>

                                                &nbsp;&nbsp;


                                                <input class="btn btn-info" type="submit" name="tambah_pkpt" value="Tambahkan"></input>                                                      
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

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function ()
    {
        var tgl = document.getElementById("tgl").value;
        //datepicker
        $('.datepicker2').datetimepicker({
            weekStart: 1,
            daysOfWeekDisabled: [0, 6],
            language: 'id',
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0,
            format : 'yyyy'
        });
    });

</script>

</body>
</html>

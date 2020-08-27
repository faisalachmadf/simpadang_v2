<?php
//--> include data header
$this->load->view('layout/header');
?>

<style type="text/css">
    .u {text-decoration: underline}
    .b {font-weight: bold}
    .c {text-align: center}
    .r {text-align: right}
    .j {text-align: justify}
    .pos-mid {vertical-align: top}
    .pos-mid {vertical-align: middle}

    .bor-bot {border-bottom: 1px solid #000}

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
                    <a href="<?= site_url('ketua_tim/home'); ?>">Home</a>
                </li>
                <li>
                    <a href="<?= site_url('ketua_tim/penugasan'); ?>">Penugasan</a>
                </li>
                <li>
                    <a href="<?= site_url('ketua_tim/penugasan/detail_penugasan/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim)); ?>">Detail Penugasan</a>
                </li>
                <li class="active"> Tambah Anggaran Waktu </li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">
            <!-- <div class="ace-settings-container" id="ace-settings-container" style="position:fixed">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn" title="Simpan sementara">
                            <input class="btn btn-xs btn-warning" type="submit" name="sm_temp" value="S"></input>
                    </div>
            </div> -->

            <div class="page-header">
                <h1>
                    Tambah Anggaran Waktu
                    <small>
                        <i class="ace-icon fa fa-angle-double-right"></i>
                        Menambahkan alokasi anggaran waktu untuk tugas pemeriksaan
                    </small>
                </h1>
            </div><!-- /.page-header -->

            <div class="row">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <form id="validasi" class="form-horizontal" role="form" action="<?= site_url('ketua_tim/anggaran_waktu/tambah_anggaran_waktu'); ?>" method="post">
                        <div class="row">
                            <div class="col-md-12">

                                <div class="widget-box">
                                    <div class="widget-header">
                                        <h4 class="widget-title">
                                            <i class="menu-icon fa fa-pencil-square-o"></i>
                                            Formulir Tambah Anggaran Waktu Pemeriksaan
                                        </h4>

                                        <div class="widget-toolbar">
                                            <a href="#" data-action="collapse">
                                                <i class="ace-icon fa fa-chevron-up"></i>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="widget-body">
                                        <div class="widget-main">

                                            <!-- ID Anggaran Waktu -->
                                            <input type="hidden" name="id_agr" value="<?= $id_agr; ?>">
                                            <input type="hidden" name="id_tim" value="<?= $data->id_tim; ?>">
                                            <!-- ID tugas (penugasan) -->
                                            <input type="hidden" name="id_tgs" value="<?= $data->id_tugas; ?>">
                                            <!-- Total jenis pekerjaan -->
                                            <input type="hidden" name="total" id="total" value="<?= $total->jml; ?>">

                                            <!-- Penyusun -->
                                            <input type="hidden" name="penyusun" value="<?= $pegawai->id_pegawai; ?>">
                                            <!-- Penyetuju -->
                                            <input type="hidden" name="penyetuju" value="<?= $dalnis->id_pegawai; ?>">

                                            <!-- Waktu pelaksanaan pengawasan -->
                                            <input type="hidden" id="tgl_awal" value="<?= $data->tgl_awal; ?>">
                                            <input type="hidden" id="tgl_akhir" value="<?= $data->tgl_akhir; ?>">

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Tanggal : </label>
                                                <div class="col-sm-5">
                                                    <label class="control-label"><?= $tanggal; ?></label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Nama Objek Audit : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="col-xs-10 col-sm-8" value="<?= $data->nama_op; ?>" readOnly="" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Kegiatan/Program yang di Audit : </label>
                                                <div class="col-sm-5">
                                                    <textarea cols="74" rows="3" readonly=""><?= $data->nama_kp; ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Disusun Oleh [Ketua Tim] : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="col-xs-10 col-sm-6" value="<?= $pegawai->nama; ?>" readOnly="" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"> Disetujui Oleh [DALNIS] : </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="col-xs-10 col-sm-6" value="<?= $dalnis->nama; ?>" readOnly="" />
                                                </div>
                                            </div>

                                            <!-- <div class="form-group">
                                                    <label class="col-sm-3 control-label no-padding-right"> Disetujui Oleh [DALTU] : </label>
                                                    <div class="col-sm-9">
                                                            <input type="text" class="col-xs-10 col-sm-6" value="<?= $daltu->nama; ?>" readOnly="" />
                                                    </div>
                                            </div> -->

                                            <hr/>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right"></label>
                                                <div class="col-sm-5">
                                                    <h4 class="header center"> Masukan data-data di bawah ini. </h4>
                                                </div>
                                            </div>

                                            <table width="100%" border="0">
                                                <tr>
                                                    <td width="25%"></td>
                                                    <td width="18%"></td>
                                                    <td></td>
                                                    <td width="18%"></td>
                                                    <td width="36%"></td>	
                                                </tr>

                                                <tr>
                                                    <td class="r pad-10">Waktu Persiapan : </td>
                                                    <td class="pad-3">
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl1_persiapan' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' required/>
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_persiapan' class='col-xs-12 col-sm-12' placeholder='Tanggal' required/>
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td class="r pad-10">Waktu Pelaksanaan : </td>
                                                    <td class="pad-3">
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl1_pelaksanaan' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' required />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_pelaksanaan' class='col-xs-12 col-sm-12' placeholder='Tanggal' required />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>

                                                <tr>
                                                    <td class="r pad-10">Waktu Penyelesaian : </td>
                                                    <td class="pad-3">
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl1_penyelesaian' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' required />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_penyelesaian' class='col-xs-12 col-sm-12' placeholder='Tanggal' required />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td></td>
                                                </tr>
                                            </table>

                                            <br/>

                                            <!-- <a href="<?= site_url('ketua_tim/pengaturan/list_anggaran_waktu') ?>" class="btn btn-xs btn-primary" title="Atur ulang jenis pekerjaan">
                                                <i class="fa fa-gear"></i>
                                                Atur Jenis Pekerjaan
                                            </a> -->

                                            <hr/>

                                            <table width="100%" border="0" id="anggaran_waktu">
                                                <tr>
                                                    <th width="3%"></th>
                                                    <th></th>
                                                    <th width="15%"></th>
                                                    <th width="15%"></th>
                                                    <th width="15%"></th>
                                                    <th width="15%"></th>
                                                    <th width="4%"></th>
                                                </tr>

                                                <tr>
                                                    <td align="center" class="b u" colspan="2"> JENIS PEKERJAAN </td>
                                                    <td align="center" class="b u"> WAKIL PENANGGUNG JAWAB <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> PENGENDALI TEKNIS <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> KETUA TIM <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> ANGGOTA TIM <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"></td>
                                                </tr>

                                                <tr><td colspan="6">&nbsp;</td></tr>
                                                <tr><td colspan="6" class="b"><i class='fa fa-circle'></i> PERSIAPAN AUDIT :</td></tr>

                                                <?php
                                                $no_kat1 = 1;
                                                foreach ($jp as $row) {
                                                    if ($row->kategori == "1") {
                                                        $button1 = ($no_kat1 == 1) ? "<div id='TambahBaris' data-agr='$id_agr' data-kategori='$row->kategori' class='btn btn-sm btn-success' data-agr='$id_agr' data-kat='satu' title='Tambah Kegiatan $no_kat1'> <i class='fa fa-plus'></i> </div>" : "<div id='HapusBaris' class='btn btn-sm btn-danger' data-kat='satu' title='Hapus Kegiatan $no_kat1'> <i class='fa fa-minus'></i> </div>";
                                                        echo "
							      <tr class='bor-bot satu elemen'>
							      <td align='center'>$no_kat1).</td>
							      <td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea>
                                  <input type='hidden' name='nomor_jenis_pekerjaan[]' value='$no_kat1'>
                                  <input type='hidden' name='kategori[]' value='$row->kategori'>
                                  <input type='hidden' name='kode_pekerjaan[]' class='agr' value='$id_agr-$no_kat1'>
                                  </td>
							      <td class='pad-3 pos-top'>
							      <div class='radio'>
                                                                    <label title='Wakil Penanggung Jawab Nonaktif'>
                                                                      <input type='radio' name='daltu_$no_kat1' data-no='$no_kat1' class='ace inpDaltu' checked='' value='nonaktif' />
                                                                      <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Wakil Penanggung Jawab Aktif'>
                                                                       <input type='radio' name='daltu_$no_kat1' data-no='$no_kat1' class='ace inpDaltu' value='aktif'' />
                                                                      <span class='lbl'> Aktif</span>
                                                                    </label>
                                                              </div>
                                                              <br/>
                                                              <label class='inpt-daltu' id='inpt-daltu-$no_kat1'>
                                                                <input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 haridaltu spinner' placeholder='Jam' data-no='$no_kat1' id='hari-daltu-$no_kat1' />
                                                                <input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6 jamdaltu' placeholder='Hari' data-no='$no_kat1' id='jam-daltu-$no_kat1' />
                                                              </label>																	 
                                                              </td>
                                                              <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Pengendali Teknis Nonaktif'>
                                                                        <input type='radio' name='dalnis_$no_kat1' data-no='$no_kat1' class='ace inpDalnis' checked='' value='nonaktif' />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Pengendali Teknis Aktif'>
                                                                    <input type='radio' name='dalnis_$no_kat1' data-no='$no_kat1' class='ace inpDalnis' value='aktif'/>
                                                                    <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                               <label class='inpt-dalnis' id='inpt-dalnis-$no_kat1'>
                                                               <input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 haridalnis spinner' placeholder='Jam' data-no='$no_kat1' id='hari-dalnis-$no_kat1' />
                                                               <input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6 jamdalnis'  placeholder='Hari' data-no='$no_kat1' id='jam-dalnis-$no_kat1' />
                                                               </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                  <div class='radio'>
                                                                   <label title='Ketua Tim Nonaktif'>
                                                                        <input type='radio' name='ketua_$no_kat1' data-no='$no_kat1' class='ace inpKetua' checked='' value='nonaktif'/>
                                                                           <span class='lbl'> Nonaktif</span>
                                                                   </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                   <label title='Ketua Tim Aktif'>
                                                                          <input type='radio' name='ketua_$no_kat1' data-no='$no_kat1' class='ace inpKetua' value='aktif'/>
                                                                           <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                 </div><br/>
                                                                 <label class='inpt-ketua' id='inpt-ketua-$no_kat1'>
                                                                       <input type='number' name='hari_ketua[]' data-no='$no_kat1' class='col-xs-10 hariketua col-sm-6 spinner' placeholder='Jam' id='hari-ketua-$no_kat1' />
                                                                       <input type='text' name='jam_ketua[]' class='col-xs-10 jamketua col-sm-6' placeholder='Hari' id='jam-ketua-$no_kat1' />
                                                                 </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                     <div class='radio'>
                                                                         <label title='Anggota Tim Nonaktif'>
                                                                          <input type='radio' name='anggota_$no_kat1' data-no='$no_kat1' class='ace inpAnggota' checked='' value='nonaktif' />
                                                                          <span class='lbl'> Nonaktif</span>
                                                                          </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                          <label title='Anggota Tim Aktif'>
                                                                              <input type='radio' name='anggota_$no_kat1' data-no='$no_kat1' class='ace inpAnggota' value='aktif'/>
                                                                                 <span class='lbl'> Aktif</span>
                                                                          </label>
                                                                      </div><br/>
                                                                  <label class='inpt-anggota' id='inpt-anggota-$no_kat1'>
                                                                        <input type='number' name='hari_anggota[]' data-no='$no_kat1' class='col-xs-10 harianggota col-sm-6 haridaltu spinner' placeholder='Jam' id='hari-anggota-$no_kat1' />
                                                                        <input type='text' name='jam_anggota[]' class='col-xs-10 jamanggota col-sm-6' jamdaltu placeholder='Hari' id='jam-anggota-$no_kat1' />
                                                                </label>																	 
                                                            </td>
                                                            <td>$button1</td>
                                                        </tr>
                                                        ";
                                                        $no_kat1++;
                                                        $no_kat2 = $no_kat1;
                                                    }
                                                }
                                                ?>

                                                <tr><td colspan='6'>&nbsp;</td></tr>
                                                <tr><td colspan='6' class="b"><i class='fa fa-circle'></i> PELAKSANAAN AUDIT :</td></tr>	

                                                <?php
                                                $no_kategori2 = 1;
                                                foreach ($jp as $row) {
                                                    if ($row->kategori == "2") {
                                                        $button2 = ($no_kategori2 == 1) ? "<div id='TambahBaris' data-agr='$id_agr' data-kategori='$row->kategori' data-kat='dua' class='btn btn-sm btn-success' title='Tambah Kegiatan'> <i class='fa fa-plus'></i> </div>" : "<div id='HapusBaris' data-agr='$id_agr' data-kat='dua' class='btn btn-sm btn-danger' title='Hapus Kegiatan'> <i class='fa fa-minus'></i> </div>";
                                                        echo "
                                                        
                                                        <tr class='bor-bot dua elemen'>
                                                              <td align='center'>$no_kategori2).</td>
							      <td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea>
                                  <input type='hidden' name='nomor_jenis_pekerjaan[]' value='$no_kat2'>
                                  <input type='hidden' name='kategori[]' value='$row->kategori'>
                                  <input type='hidden' name='kode_pekerjaan[]' class='agr' value='$id_agr-$no_kat2'>
                                  </td>
							      <td class='pad-3 pos-top'>
							      <div class='radio'>
                                                                    <label title='Wakil Penanggung Jawab Nonaktif'>
                                                                      <input type='radio' name='daltu_$no_kat2' data-no='$no_kat2' class='ace inpDaltu' checked='' value='nonaktif' />
                                                                      <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Wakil Penanggung Jawab Aktif'>
                                                                       <input type='radio' name='daltu_$no_kat2' data-no='$no_kat2' class='ace inpDaltu' value='aktif'' />
                                                                      <span class='lbl'> Aktif</span>
                                                                    </label>
                                                              </div>
                                                              <br/>
                                                              <label class='inpt-daltu' id='inpt-daltu-$no_kat2'>
                                                                <input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 haridaltu spinner' placeholder='Jam' data-no='$no_kat2' id='hari-daltu-$no_kat2' />
                                                                <input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6 jamdaltu' placeholder='Hari' data-no='$no_kat2' id='jam-daltu-$no_kat2' />
                                                              </label>																	 
                                                              </td>
                                                              <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Pengendali Teknis Nonaktif'>
                                                                        <input type='radio' name='dalnis_$no_kat2' data-no='$no_kat2' class='ace inpDalnis' checked='' value='nonaktif' />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Pengendali Teknis Aktif'>
                                                                    <input type='radio' name='dalnis_$no_kat2' data-no='$no_kat2' class='ace inpDalnis' value='aktif'/>
                                                                    <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                               <label class='inpt-dalnis' id='inpt-dalnis-$no_kat2'>
                                                               <input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 haridalnis spinner' placeholder='Jam' data-no='$no_kat2' id='hari-dalnis-$no_kat2' />
                                                               <input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6 jamdalnis'  placeholder='Hari' data-no='$no_kat2' id='jam-dalnis-$no_kat2' />
                                                               </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                  <div class='radio'>
                                                                   <label title='Ketua Tim Nonaktif'>
                                                                        <input type='radio' name='ketua_$no_kat2' data-no='$no_kat2' class='ace inpKetua' checked='' value='nonaktif'/>
                                                                           <span class='lbl'> Nonaktif</span>
                                                                   </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                   <label title='Ketua Tim Aktif'>
                                                                          <input type='radio' name='ketua_$no_kat2' data-no='$no_kat2' class='ace inpKetua' value='aktif'/>
                                                                           <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                 </div><br/>
                                                                 <label class='inpt-ketua' id='inpt-ketua-$no_kat2'>
                                                                       <input type='number' name='hari_ketua[]' data-no='$no_kat2' class='col-xs-10 hariketua col-sm-6 spinner' placeholder='Jam' id='hari-ketua-$no_kat2' />
                                                                       <input type='text' name='jam_ketua[]' data-no='$no_kat2' class='col-xs-10 jamketua col-sm-6' placeholder='Hari' id='jam-ketua-$no_kat2' />
                                                                 </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                     <div class='radio'>
                                                                         <label title='Anggota Tim Nonaktif'>
                                                                          <input type='radio' name='anggota_$no_kat2' data-no='$no_kat2' class='ace inpAnggota' checked='' value='nonaktif' />
                                                                          <span class='lbl'> Nonaktif</span>
                                                                          </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                          <label title='Anggota Tim Aktif'>
                                                                              <input type='radio' name='anggota_$no_kat2' data-no='$no_kat2' class='ace inpAnggota' value='aktif'/>
                                                                                 <span class='lbl'> Aktif</span>
                                                                          </label>
                                                                      </div><br/>
                                                                  <label class='inpt-anggota' id='inpt-anggota-$no_kat2'>
                                                                        <input type='number' name='hari_anggota[]' data-no='$no_kat2' class='col-xs-10 harianggota col-sm-6 haridaltu spinner' placeholder='Jam' id='hari-anggota-$no_kat2' />
                                                                        <input type='text' name='jam_anggota[]' data-no='$no_kat2' class='col-xs-10 jamanggota col-sm-6' jamdaltu placeholder='Hari' id='jam-anggota-$no_kat2' />
                                                                </label>																	 
                                                            </td>
                                                                <td>$button2</td>
                                                        </tr>
                                                        ";
                                                        $no_kat2++;
                                                        $no_kategori2++;

                                                        $no_kat3 = $no_kat2;
                                                    }
                                                }

                                                echo "<tr><td colspan='6'>&nbsp;</td></tr> <tr><td colspan='6' class='b'><i class='fa fa-circle'></i> PENYELESAIAN AUDIT :</td></tr>";

                                                $no_kategori3 = 1;
                                                foreach ($jp as $row) {
                                                    if ($row->kategori == "3") {
                                                        $button3 = ($no_kategori3 == 1) ? "<div id='TambahBaris' data-agr='$id_agr' data-kategori='$row->kategori' data-kat='tiga' class='btn btn-sm btn-success' title='Tambah Kegiatan'> <i class='fa fa-plus'></i> </div>" : "<div id='HapusBaris' data-agr='$id_agr' data-kat='tiga' class='btn btn-sm btn-danger' title='Hapus Kegiatan'> <i class='fa fa-minus'></i> </div>";
                                                        echo "
                                                        
                                                        <tr class='bor-bot tiga elemen'>
                                                                <td align='center'>$no_kategori3).</td>
							      <td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea>
                                  <input type='hidden' name='nomor_jenis_pekerjaan[]' value='$no_kat3'>
                                  <input type='hidden' name='kategori[]' value='$row->kategori'>
                                  <input type='hidden' name='kode_pekerjaan[]' class='agr' value='$id_agr-$no_kat3'>
                                  </td>
							      <td class='pad-3 pos-top'>
							      <div class='radio'>
                                                                    <label title='Wakil Penanggung Jawab Nonaktif'>
                                                                      <input type='radio' name='daltu_$no_kat3' data-no='$no_kat3' class='ace inpDaltu' checked='' value='nonaktif' />
                                                                      <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Wakil Penanggung Jawab Aktif'>
                                                                       <input type='radio' name='daltu_$no_kat3' data-no='$no_kat3' class='ace inpDaltu' value='aktif'' />
                                                                      <span class='lbl'> Aktif</span>
                                                                    </label>
                                                              </div>
                                                              <br/>
                                                              <label class='inpt-daltu' id='inpt-daltu-$no_kat3'>
                                                                <input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 haridaltu spinner' placeholder='Jam' data-no='$no_kat3' id='hari-daltu-$no_kat3' />
                                                                <input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6 jamdaltu' placeholder='Hari' data-no='$no_kat3' id='jam-daltu-$no_kat3' />
                                                              </label>																	 
                                                              </td>
                                                              <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Pengendali Teknis Nonaktif'>
                                                                        <input type='radio' name='dalnis_$no_kat3' data-no='$no_kat3' class='ace inpDalnis' checked='' value='nonaktif' />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Pengendali Teknis Aktif'>
                                                                    <input type='radio' name='dalnis_$no_kat3' data-no='$no_kat3' class='ace inpDalnis' value='aktif'/>
                                                                    <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                               <label class='inpt-dalnis' id='inpt-dalnis-$no_kat3'>
                                                               <input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 haridalnis spinner' placeholder='Jam' data-no='$no_kat3' id='hari-dalnis-$no_kat3' />
                                                               <input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6 jamdalnis'  placeholder='Hari' data-no='$no_kat3' id='jam-dalnis-$no_kat3' />
                                                               </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                  <div class='radio'>
                                                                   <label title='Ketua Tim Nonaktif'>
                                                                        <input type='radio' name='ketua_$no_kat3' data-no='$no_kat3' class='ace inpKetua' checked='' value='nonaktif'/>
                                                                           <span class='lbl'> Nonaktif</span>
                                                                   </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                   <label title='Ketua Tim Aktif'>
                                                                          <input type='radio' name='ketua_$no_kat3' data-no='$no_kat3' class='ace inpKetua' value='aktif'/>
                                                                           <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                 </div><br/>
                                                                 <label class='inpt-ketua' id='inpt-ketua-$no_kat3'>
                                                                       <input type='number' name='hari_ketua[]' data-no='$no_kat3' class='col-xs-10 hariketua col-sm-6 spinner' placeholder='Jam' id='hari-ketua-$no_kat3' />
                                                                       <input type='text' name='jam_ketua[]' data-no='$no_kat3' class='col-xs-10 jamketua col-sm-6' placeholder='Hari' id='jam-ketua-$no_kat3' />
                                                                 </label>																	 
                                                               </td>
                                                                <td class='pad-3 pos-top'>
                                                                     <div class='radio'>
                                                                         <label title='Anggota Tim Nonaktif'>
                                                                          <input type='radio' name='anggota_$no_kat3' data-no='$no_kat3' class='ace inpAnggota' checked='' value='nonaktif' />
                                                                          <span class='lbl'> Nonaktif</span>
                                                                          </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                          <label title='Anggota Tim Aktif'>
                                                                              <input type='radio' name='anggota_$no_kat3' data-no='$no_kat3' class='ace inpAnggota' value='aktif'/>
                                                                                 <span class='lbl'> Aktif</span>
                                                                          </label>
                                                                      </div><br/>
                                                                  <label class='inpt-anggota' id='inpt-anggota-$no_kat3'>
                                                                        <input type='number' name='hari_anggota[]' data-no='$no_kat3' class='col-xs-10 harianggota col-sm-6 haridaltu spinner' placeholder='Jam' id='hari-anggota-$no_kat3' />
                                                                        <input type='text' name='jam_anggota[]' data-no='$no_kat3' class='col-xs-10 jamanggota col-sm-6' jamdaltu placeholder='Hari' id='jam-anggota-$no_kat3' />
                                                                </label>																	 
                                                            </td>
                                                                <td>$button3</td>
                                                        </tr>
                                                        ";
                                                        $no_kat3++;
                                                        $no_kategori3++;
                                                    }
                                                }
                                                ?>
                                            </table>

                                            <div align="center" class="clearfix form-actions">
                                                <a href="javascript:history.back()" class="btn btn-default">
                                                    <i class="fa fa-arrow-left"></i> Kembali 
                                                </a>

                                                &nbsp; &nbsp;

                                                <a class="btn btn-danger" href="<?= site_url('ketua_tim/anggaran_waktu/tambah_anggaran_waktu/' . base64_encode($data->id_tugas) . '/' . base64_encode($data->id_tim)); ?>">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
                                                    Bersihkan
                                                </a>

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

<!-- include data footer -->
<?php $this->load->view('layout/footer'); ?>

<!-- inline scripts related to this page -->
<script type="text/javascript">
    $(document).ready(function ()
    {
        var tgl_awal = document.getElementById("tgl_awal").value;
        var tgl_akhir = document.getElementById("tgl_akhir").value;
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
            forceParse: 0
                    //startDate: tgl_awal,
                    //endDate: tgl_akhir
        });

        $('.spinner').spinner();
    });

    /*function inptDaltu(no_kat)
     {
     if($('#daltu-'+no_kat).val() == "off")
     {
     $('#inpt-daltu-'+no_kat).slideDown('fast'); 
     $('#daltu-'+no_kat).val("on");
     $('#title-daltu-'+no_kat).attr('title','Wakil Penanggung Jawab Bertugas');
     }
     else
     {	
     $('#inpt-daltu-'+no_kat).slideUp('fast'); 
     $('#daltu-'+no_kat).val("off");
     $('#title-daltu-'+no_kat).attr('title','Wakil Penanggung Jawab Tidak Bertugas');
     }
     }*/

    hide_();
    function tambahElemenAgt(form_agt) {
        var fagt = document.getElementById("f-agt").value;

        //var kat = document.getElementById("kat1").value;

        /*if(fagt > 20)
         {
         $("#alert").show();
         }
         else
         {*/
        var stre;
        stre = "<p id='srow" + fagt + "'>" +
                "	<select name='anggota[]' class='select2' data-placeholder='Pilih Pengendali Teknis'>" +
                "		<option> -- Pilih anggota [kasus-" + form_agt + "] -- </option>" +
                "		<option value='<?= $daltu->id_pegawai ?> " + form_agt + "'> <?= $daltu->nama ?> [DALTU] </option>" +
                "		<option value='<?= $dalnis->id_pegawai ?> " + form_agt + "'> <?= $dalnis->nama ?> [DALNIS] </option>" +
                "		<option value='<?= $pegawai->id_pegawai ?> " + form_agt + "'> <?= $pegawai->nama ?> [KETUA TIM] </option> <?php
foreach ($anggota as $row) {
    ?>" + "<option value='<?= $row->anggota; ?> " + form_agt + "'> <?= $row->nama; ?> [ANGGOTA] </option>" +
                    "<?php } ?>" +
                "</select>" +
                "<a href='#' onclick='hapusElemenAgt(\"#srow" + fagt + "\"); return false;' class='btn btn-xs btn-danger' title='Hapus anggota ke-" + fagt + "'> <i class='fa fa-minus'></i> </a>" +
                "</p>";

        $("#form_agt" + form_agt).append(stre);
        fagt = (fagt - 1) + 2;
        document.getElementById("f-agt").value = fagt;

        //$("#alert").hide();
        //}
    }

    function hapusElemenAgt(id_elemen) {
        $("#alert").hide();
        $(id_elemen).remove();

        var fagt = document.getElementById("f-agt").value;
        fagt2 = fagt - 1;
        document.getElementById("f-agt").value = fagt2;
    }
    //.jumlah anggota
    $(document)
            .on('click', '#TambahBaris', function (e) {
//        BarisBaru();

                e.preventDefault();
                var Baris = "<tr class='bor-bot " + $(this).data('kat') + " elemen'>";
                Baris += "<td align='center'></td>";
                Baris += "<input type='hidden' name='kategori[]' value='" + $(this).data('kategori') + "'>";
                Baris += "<input type='hidden' name='kode_pekerjaan[]' class='agr'>";
                Baris += "<td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'></textarea><input type='hidden' name='nomor_jenis_pekerjaan[]' class='nmr_pkj'></td>";
                Baris += "<td class='pad-3 pos-top'><div class='radio'><label title='Wakil Penanggung Jawab Nonaktif'>";
                Baris += "<input type='radio' class='ace inpDaltu' checked='' value='nonaktif' />";
                Baris += "<span class='lbl'> Nonaktif</span>";
                Baris += "</label> &nbsp;&nbsp;&nbsp;&nbsp;";
                Baris += "<label title='Wakil Penanggung Jawab Aktif'>";
                Baris += "<input type='radio' class='ace inpDaltu' value='aktif' />";
                Baris += "<span class='lbl'> Aktif</span></label></div><br/>";
                Baris += "<label class='inpt-daltu' style='display: none;'> ";
                Baris += "<input type='number' name='hari_daltu[]' class='col-xs-10 haridaltu col-sm-6 spinner' placeholder='Jam' />";
                Baris += "<input type='text' name='jam_daltu[]' class='col-xs-10 jamdaltu col-sm-6' placeholder='Hari'/>";
                Baris += "</label></td>";

                Baris += "<td class='pad-3 pos-top'><div class='radio'><label title='Pengendali Teknis Nonaktif'>";
                Baris += "<input type='radio' class='ace inpDalnis' checked='' value='nonaktif'/>";
                Baris += "<span class='lbl'> Nonaktif</span>";
                Baris += "</label> &nbsp;&nbsp;&nbsp;&nbsp;";
                Baris += "<label title='Wakil Pengendali Teknis Aktif'>";
                Baris += "<input type='radio' class='ace inpDalnis' value='aktif'/>";
                Baris += "<span class='lbl'> Aktif</span></label></div><br/>";
                Baris += "<label class='inpt-dalnis' style='display: none;'>";
                Baris += "<input type='number' name='hari_dalnis[]' class='col-xs-10 haridalnis col-sm-6 spinner' placeholder='Jam'  />";
                Baris += "<input type='text' name='jam_dalnis[]' class='col-xs-10 jamdalnis col-sm-6' placeholder='Hari' />";
                Baris += "</label></td>";

                Baris += "<td  class='pad-3 pos-top'><div class='radio'><label title='Ketua Tim Nonaktif'>";
                Baris += "<input type='radio' name='ketua_' class='ace inpKetua' checked='' value='nonaktif'/>";
                Baris += "<span class='lbl'> Nonaktif</span>";
                Baris += "</label> &nbsp;&nbsp;&nbsp;&nbsp;";
                Baris += "<label title='Ketua Tim Aktif'>";
                Baris += "<input type='radio' name='ketua_' class='ace inpKetua' value='aktif'/>";
                Baris += "<span class='lbl'> Aktif</span></label></div><br/>";
                Baris += "<label class='inpt-ketua' style='display: none;'>";
                Baris += "<input type='number' name='hari_ketua[]' class='col-xs-10 hariketua col-sm-6 spinner' placeholder='Jam' id='hari-ketua-$no_kat3' />";
                Baris += "<input type='text' name='jam_ketua[]' class='col-xs-10 jamketua col-sm-6' placeholder='Hari' id='jam-ketua-$no_kat3' />";
                Baris += "</label></td>";

                Baris += "<td class='pad-3 pos-top'><div class='radio'><label title='Anggota Tim Nonaktif'>";
                Baris += "<input type='radio' name='anggota_' class='ace inpAnggota' checked='' value='nonaktif'/>";
                Baris += "<span class='lbl'> Nonaktif</span>";
                Baris += "</label> &nbsp;&nbsp;&nbsp;&nbsp;";
                Baris += "<label title='Anggota Tim Aktif'>";
                Baris += "<input type='radio' name='anggota_' class='ace inpAnggota' value='aktif'/>";
                Baris += "<span class='lbl'> Aktif</span></label></div><br/>";
                Baris += "<label class='inpt-anggota' style='display: none;'>";
                Baris += "<input type='number' name='hari_anggota[]' class='col-xs-10 harianggota col-sm-6 spinner' placeholder='Jam' id='hari-anggota-$no_kat3' />";
                Baris += "<input type='text' name='jam_anggota[]' class='col-xs-10 jamanggota col-sm-6' placeholder='Hari' id='jam-anggota-$no_kat3' />";
                Baris += "</label></td>";
                Baris += "<td><div id='HapusBaris' class='btn btn-sm btn-danger' data-agr='" + $(this).data('agr') + "'  data-kat='" + $(this).data('kat') + "' title='Hapus Kegiatan'> <i class='fa fa-minus'></i> </div></td>";
                Baris += "</tr>";
                var after_ = '.' + $(this).data('kat') + ':last';
                $(Baris).insertAfter($(after_));
                hitung($(this).data('kat'), $(this).data('agr'));
                $('#total').val(parseInt($('#total').val())+1);
            })
            .on('click', '#HapusBaris', function (e) {
                e.preventDefault();
                $(this).parent().parent().remove();
                hitung($(this).data('kat'), $(this).data('agr'));
                $('#total').val(parseInt($('#total').val())-1);

            })
            .on('click', '.inpDaltu', function () {
                var no_kat = $(this).data('no');
                if ($("input:radio[name='daltu_" + no_kat + "']:checked").val() == "nonaktif")
                {
                    $('#inpt-daltu-' + no_kat).slideUp('fast');
                }
                else
                {
                    $('#inpt-daltu-' + no_kat).slideDown('fast');
                }
            })
            .on('click', '.inpDalnis', function () {
                var no_kat = $(this).data('no');
                if ($("input:radio[name='dalnis_" + no_kat + "']:checked").val() == "nonaktif")
                {
                    $('#inpt-dalnis-' + no_kat).slideUp('fast');
                }
                else
                {
                    $('#inpt-dalnis-' + no_kat).slideDown('fast');
                }
            })
            .on('click', '.inpKetua', function () {
                var no_kat = $(this).data('no');
                if ($("input:radio[name='ketua_" + no_kat + "']:checked").val() == "nonaktif")
                {
                    $('#inpt-ketua-' + no_kat).slideUp('fast');
                }
                else
                {
                    $('#inpt-ketua-' + no_kat).slideDown('fast');
                }
            })
            .on('click', '.inpAnggota', function () {
                var no_kat = $(this).data('no');
                if ($("input:radio[name='anggota_" + no_kat + "']:checked").val() == "nonaktif")
                {
                    $('#inpt-anggota-' + no_kat).slideUp('fast');
                }
                else
                {
                    $('#inpt-anggota-' + no_kat).slideDown('fast');
                }
            })
            .on('keyup', '.haridaltu', function () {
                var hari = parseFloat($('#hari-daltu-' + $(this).data('no')).val());
                var hasil = hari / (2 * 3.25); //6.5*hari
                $('#jam-daltu-' + $(this).data('no')).val(hasil.toFixed(2));
            })
            .on('keyup', '.haridalnis', function () {
                var hari = parseFloat($('#hari-dalnis-' + $(this).data('no')).val());
                var hasil = hari / (2 * 3.25); //6.5*hari
                $('#jam-dalnis-' + $(this).data('no')).val(hasil.toFixed(2));
            })
            .on('keyup', '.hariketua', function () {
                var hari = parseFloat($('#hari-ketua-' + $(this).data('no')).val());
                var hasil = hari / (2 * 3.25); //6.5*hari
                $('#jam-ketua-' + $(this).data('no')).val(hasil.toFixed(2));
            })
            .on('keyup', '.harianggota', function () {
                var hari = parseFloat($('#hari-anggota-' + $(this).data('no')).val());
                var hasil = hari / (2 * 3.25); //6.5*hari
                $('#jam-anggota-' + $(this).data('no')).val(hasil.toFixed(2));
            })
    function hitung(kategori, agr, nmr_pkj) {
        var no_ = '.' + kategori;
        var No = 1;
        $(no_).each(function () {
            $(this).find('td:nth-child(1)').html(No + ').');
            No++;
        })
        var Nomor = 1;
        $('.elemen').each(function () {
            $(this).find(".agr").val(agr + '-' + Nomor);
            $(this).find(".nmr_pkj").val(Nomor);
            $(this).find(".inpDaltu").attr('name', 'daltu_' + Nomor);
            $(this).find(".inpDaltu").attr('data-no', Nomor);
            $(this).find(".inpt-daltu").attr('id', 'inpt-daltu-' + Nomor);
            $(this).find(".inpDalnis").attr('name', 'dalnis_' + Nomor);
            $(this).find(".inpDalnis").attr('data-no', Nomor);
            $(this).find(".inpt-dalnis").attr('id', 'inpt-dalnis-' + Nomor).attr('data-no', Nomor);
            $(this).find(".inpKetua").attr('name', 'ketua_' + Nomor);
            $(this).find(".inpKetua").attr('data-no', Nomor);
            $(this).find(".inpt-ketua").attr('id', 'inpt-ketua-' + Nomor);
            $(this).find(".inpAnggota").attr('name', 'anggota_' + Nomor);
            $(this).find(".inpAnggota").attr('data-no', Nomor);
            $(this).find(".inpt-anggota").attr('id', 'inpt-anggota-' + Nomor);
            $(this).find(".haridaltu").attr('id', 'hari-daltu-' + Nomor).attr('data-no', Nomor);
            $(this).find(".jamdaltu").attr('id', 'jam-daltu-' + Nomor).attr('data-no', Nomor);
            $(this).find(".jamdalnis").attr('id', 'jam-dalnis-' + Nomor).attr('data-no', Nomor);
            $(this).find(".haridalnis").attr('id', 'hari-dalnis-' + Nomor).attr('data-no', Nomor);
            $(this).find(".jamketua").attr('id', 'jam-ketua-' + Nomor).attr('data-no', Nomor);
            $(this).find(".hariketua").attr('id', 'hari-ketua-' + Nomor).attr('data-no', Nomor);
            $(this).find(".jamanggota").attr('id', 'jam-anggota-' + Nomor).attr('data-no', Nomor);
            $(this).find(".harianggota").attr('id', 'hari-anggota-' + Nomor).attr('data-no', Nomor);

            Nomor++;
        });
    }
    function hide_() {
        $('.inpt-daltu').hide();
        $('.inpt-dalnis').hide();
        $('.inpt-ketua').hide();
        $('.inpt-anggota').hide();
        //Jumlah anggota
        $("#alert").hide();
    }



</script>

</body>
</html>

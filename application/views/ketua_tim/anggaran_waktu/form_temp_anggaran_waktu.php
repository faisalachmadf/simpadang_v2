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

            <div class='alert alert-block alert-warning'>
                <button type='button' class='close' data-dismiss='alert'>
                    <i class='ace-icon fa fa-times'></i>
                </button>

                <p>
                    <strong>
                        <i class='ace-icon fa fa-exclamation-circle'></i>
                        Data Lanjutan!
                    </strong>
                    Melanjutkan data anggaran yang disimpan sementara dan belum di tambahkan secara keseluruhan.
                </p>
            </div>

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
                                            <input type="hidden" name="id_agr" value="<?= $data_agr->id_anggaran_wkt; ?>">
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
                                                    <td class="r pad-10">Waktu Periapan : </td>
                                                    <td class="pad-3">
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl1_persiapan' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' value="<?= $data_agr->tgl1_persiapan; ?>" />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_persiapan' class='col-xs-12 col-sm-12' placeholder='Tanggal' value="<?= $data_agr->tgl2_persiapan; ?>" />
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
                                                            <input type='text' name='tgl1_pelaksanaan' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' value="<?= $data_agr->tgl1_pelaksanaan; ?>" />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_pelaksanaan' class='col-xs-12 col-sm-12' placeholder='Tanggal' value="<?= $data_agr->tgl2_pelaksanaan; ?>" />
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
                                                            <input type='text' name='tgl1_penyelesaian' class='col-xs-12 col-sm-12' placeholder='Dari Tanggal' value="<?= $data_agr->tgl1_penyelesaian; ?>" />
                                                            <span class='input-group-addon' title='Ubah tanggal'><span class='glyphicon glyphicon-remove'></span></span>
                                                        </div>
                                                    </td>
                                                    <td class="c">s/d</td>
                                                    <td>
                                                        <div class='input-group date datepicker'>
                                                            <span class='input-group-addon'><i class="ace-icon fa fa-calendar bigger-110"></i></span>
                                                            <input type='text' name='tgl2_penyelesaian' class='col-xs-12 col-sm-12' placeholder='Tanggal' value="<?= $data_agr->tgl2_penyelesaian; ?>" />
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

                                            <table width="100%" border="0">
                                                <tr>
                                                    <th width="3%"></th>
                                                    <th></th>
                                                    <th width="16%"></th>
                                                    <th width="16%"></th>
                                                    <th width="16%"></th>
                                                    <th width="16%"></th>
                                                </tr>

                                                <tr>
                                                    <td align="center" class="b u" colspan="2"> JENIS PEKERJAAN </td>
                                                    <td align="center" class="b u"> WAKIL PENANGGUNG JAWAB <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> PENGENDALI TEKNIS <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> KETUA TIM <br/> (HP/Jam) </td>
                                                    <td align="center" class="b u"> ANGGOTA TIM <br/> (HP/Jam) </td>
                                                </tr>

                                                <tr><td colspan="6">&nbsp;</td></tr>
                                                <tr><td colspan="6" class="b"><i class='fa fa-circle'></i> PERSIAPAN AUDIT :</td></tr>

                                                <?php
                                                $no_kat1 = 1;
                                                foreach ($sub_agr as $row) {
                                                    if ($row->kategori == "1") {
                                                echo "
                                                    <input type='hidden' name='kategori[]' value='$row->kategori'>
                                                    <input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
                                                    <tr class='bor-bot'>
                                                            <td align='center'>$no_kat1).</td>
                                                            <td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea></td>
                                                            <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Wakil Penanggung Jawab Nonaktif'>
                                                                        <input type='radio' name='daltu_$row->nomor' class='ace' value='nonaktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_daltu == "nonaktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <label title='Wakil Penanggung Jawab Aktif'>
                                                                        <input type='radio' name='daltu_$row->nomor' class='ace' value='aktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_daltu == "aktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                                <label class='inpt-daltu' id='inpt-daltu-$row->nomor'>
                                                                        <input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_daltu' id='hari-daltu-$no_kat1' />
                                                                        <input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_daltu' id='jam-daltu-$no_kat1' />
                                                                </label>
                                                            </td>
                                                            <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Pengendali Teknis Nonaktif'>
                                                                        <input type='radio' name='dalnis_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_dalnis == "nonaktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Pengendali Teknis Aktif'>
                                                                        <input type='radio' name='dalnis_$row->nomor' class='ace' value='aktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_dalnis == "aktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                                <label class='inpt-dalnis' id='inpt-dalnis-$row->nomor'>
                                                                    <input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_dalnis' id='hari-dalnis-$no_kat1' />
                                                                    <input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_dalnis' id='jam-dalnis-$no_kat1' />
                                                                </label>
                                                            </td>
                                                            <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                    <label title='Ketua Tim Nonaktif'>
                                                                        <input type='radio' name='ketua_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_ketua == "nonaktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                    </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <label title='Ketua Tim Aktif'>
                                                                        <input type='radio' name='ketua_$row->nomor' class='ace' value='aktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_ketua == "aktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Aktif</span>
                                                                    </label>
                                                                </div><br/>
                                                                <label class='inpt-ketua' id='inpt-ketua-$row->nomor'>
                                                                    <input type='number' name='hari_ketua[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_ketua' id='hari-ketua-$no_kat1' />
                                                                    <input type='text' name='jam_ketua[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_ketua' id='jam-ketua-$no_kat1' />
                                                                </label>
                                                            </td>
                                                        <td class='pad-3 pos-top'>
                                                            <div class='radio'>
                                                                <label title='Anggota Tim Nonaktif'>
                                                                    <input type='radio' name='anggota_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                                    if ($row->tugas_anggota == "nonaktif") {
                                                                        echo "checked=''";
                                                                    } echo " />
                                                                <span class='lbl'> Nonaktif</span>
                                                                </label> &nbsp;&nbsp;&nbsp;&nbsp;   
                                                                <label title='Anggota Tim Aktif'>
                                                                    <input type='radio' name='anggota_$row->nomor' class='ace' value='aktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                                    if ($row->tugas_anggota == "aktif") {
                                                                        echo "checked=''";
                                                                    } echo " />																			<span class='lbl'> Aktif</span>
                                                                 </label>
                                                            </div><br/>
                                                            <label class='inpt-anggota' id='inpt-anggota-$row->nomor'>
                                                                <input type='number' name='hari_anggota[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_anggota' id='hari-anggota-$no_kat1' />
                                                                <input type='text' name='jam_anggota[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_anggota' id='jam-anggota-$no_kat1' />
                                                            </label>
                                                        </td>
                                                        </tr>
                                                        ";
                                                        $no_kat1++;
                                                    }
                                                }
                                                ?>
                                                <tr><td colspan='6'>&nbsp;</td></tr>
                                                <tr><td colspan='6' class="b"><i class='fa fa-circle'></i> PELAKSANAAN AUDIT :</td></tr>	
                                                <?php
                                                $no_kat2 = 1;
                                                foreach ($sub_agr as $row) {
                                                    if ($row->kategori == "2") {
                                                            echo "
                                                                <input type='hidden' name='kategori[]' value='$row->kategori'>
                                                                <input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
                                                                <tr class='bor-bot'>
                                                                <td align='center'>$no_kat2).</td>
                                                                <td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea></td>
                                                                <td class='pad-3 pos-top'>
                                                                <div class='radio'>
                                                                   <label title='Wakil Penanggung Jawab Nonaktif'>
                                                                   <input type='radio' name='daltu_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                                    if ($row->tugas_daltu == "nonaktif") {
                                                                        echo "checked=''";
                                                                    } echo " />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <label title='Wakil Penanggung Jawab Aktif'>
                                                                        <input type='radio' name='daltu_$row->nomor' class='ace' value='aktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_daltu == "aktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                            <span class='lbl'> Aktif</span>
                                                                            </label>
                                                                            </div><br/>
                                                                            <label class='inpt-daltu' id='inpt-daltu-$row->nomor'>
                                                                                    <input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_daltu' id='hari-daltu-$row->nomor' />
                                                                                    <input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_daltu' id='jam-daltu-$row->nomor' />
                                                                            </label>
                                                                        </td>
                                                                        <td class='pad-3 pos-top'>
                                                                        <div class='radio'>
                                                                                <label title='Pengendali Teknis Nonaktif'>
                                                                                        <input type='radio' name='dalnis_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                                        if ($row->tugas_dalnis == "nonaktif") {
                                                                            echo "checked=''";
                                                                        } echo " />
                                                                        <span class='lbl'> Nonaktif</span>
                                                                        </label> &nbsp;&nbsp;&nbsp;&nbsp;
                                                                        <label title='Pengendali Teknis Aktif'>
                                                                                <input type='radio' name='dalnis_$row->nomor' class='ace' value='aktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_dalnis == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-dalnis' id='inpt-dalnis-$row->nomor'>
																				<input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_dalnis' id='hari-dalnis-$row->nomor' />
																				<input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_dalnis' id='jam-dalnis-$row->nomor' />
																			</label>
																		</td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Ketua Tim Nonaktif'>
																					<input type='radio' name='ketua_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_ketua == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Ketua Tim Aktif'>
																					<input type='radio' name='ketua_$row->nomor' class='ace' value='aktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_ketua == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-ketua' id='inpt-ketua-$row->nomor'>
																				<input type='number' name='hari_ketua[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_ketua' id='hari-ketua-$row->nomor' />
																				<input type='text' name='jam_ketua[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_ketua' id='jam-ketua-$row->nomor' />
																			</label>
																		</td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Anggota Tim Nonaktif'>
																					<input type='radio' name='anggota_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_anggota == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Anggota Tim Aktif'>
																					<input type='radio' name='anggota_$row->nomor' class='ace' value='aktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_anggota == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-anggota' id='inpt-anggota-$row->nomor'>
																				<input type='number' name='hari_anggota[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_anggota' id='hari-anggota-$row->nomor' />
																				<input type='text' name='jam_anggota[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_anggota' id='jam-anggota-$row->nomor' />
																			</label>
																		</td>
																	</tr>
																	";

                                                        $no_kat2++;
                                                    }
                                                }

                                                echo "<tr><td colspan='6'>&nbsp;</td></tr> <tr><td colspan='6' class='b'><i class='fa fa-circle'></i> PENYELESAIAN AUDIT :</td></tr>";

                                                $no_kat3 = 1;
                                                foreach ($sub_agr as $row) {
                                                    if ($row->kategori == "3") {
                                                        echo "
																	<input type='hidden' name='kategori[]' value='$row->kategori'>
																	<input type='hidden' name='kode_pekerjaan[]' value='$row->kode_pekerjaan'>
																	<tr class='bor-bot'>
																		<td align='center'>$no_kat3).</td>
																		<td class='pad-3'><textarea name='jenis_pekerjaan[]' rows='2' cols='47' style='color:black;'>$row->jenis_pekerjaan</textarea></td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Wakil Penanggung Jawab Nonaktif'>
																					<input type='radio' name='daltu_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_daltu == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Wakil Penanggung Jawab Aktif'>
																					<input type='radio' name='daltu_$row->nomor' class='ace' value='aktif' onclick='inptDaltu(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_daltu == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-daltu' id='inpt-daltu-$row->nomor'>
																				<input type='number' name='hari_daltu[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_daltu' id='hari-daltu-$row->nomor' />
																				<input type='text' name='jam_daltu[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_daltu' id='jam-daltu-$row->nomor' />
																			</label>
																		</td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Pengendali Teknis Nonaktif'>
																					<input type='radio' name='dalnis_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_dalnis == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Pengendali Teknis Aktif'>
																					<input type='radio' name='dalnis_$row->nomor' class='ace' value='aktif' onclick='inptDalnis(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_dalnis == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-dalnis' id='inpt-dalnis-$row->nomor'>
																				<input type='number' name='hari_dalnis[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_dalnis' id='hari-dalnis-$row->nomor' />
																				<input type='text' name='jam_dalnis[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_dalnis' id='jam-dalnis-$row->nomor' />
																			</label>
																		</td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Ketua Tim Nonaktif'>
																					<input type='radio' name='ketua_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_ketua == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Ketua Tim Aktif'>
																					<input type='radio' name='ketua_$row->nomor' class='ace' value='aktif' onclick='inptKetua(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_ketua == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-ketua' id='inpt-ketua-$row->nomor'>
																				<input type='number' name='hari_ketua[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_ketua' id='hari-ketua-$row->nomor' />
																				<input type='text' name='jam_ketua[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_ketua' id='jam-ketua-$row->nomor' />
																			</label>
																		</td>

																		<td class='pad-3 pos-top'>
																			<div class='radio'>
																				<label title='Anggota Tim Nonaktif'>
																					<input type='radio' name='anggota_$row->nomor' class='ace' checked='' value='nonaktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_anggota == "nonaktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Nonaktif</span>
																				</label> &nbsp;&nbsp;&nbsp;&nbsp;

																				<label title='Anggota Tim Aktif'>
																					<input type='radio' name='anggota_$row->nomor' class='ace' value='aktif' onclick='inptAnggota(\"$row->nomor\"); return true;' ";
                                                        if ($row->tugas_anggota == "aktif") {
                                                            echo "checked=''";
                                                        } echo " />
																					<span class='lbl'> Aktif</span>
																				</label>
																			</div><br/>

																			<label class='inpt-anggota' id='inpt-anggota-$row->nomor'>
																				<input type='number' name='hari_anggota[]' class='col-xs-10 col-sm-6 spinner' placeholder='Jam' value='$row->hari_anggota' id='hari-anggota-$row->nomor' />
																				<input type='text' name='jam_anggota[]' class='col-xs-10 col-sm-6' placeholder='Hari' value='$row->jam_anggota' id='jam-anggota-$row->nomor' />
																			</label>
																		</td>
																	</tr>
																	";

                                                        $no_kat3++;
                                                    }
                                                }
                                                ?>
                                            </table>

                                            <div align="center" class="clearfix form-actions">
                                                <a href="javascript:history.back()" class="btn btn-default">
                                                    <i class="fa fa-arrow-left"></i> Kembali 
                                                </a>

                                                &nbsp; &nbsp;

                                                <button class="btn btn-danger" type="reset">
                                                    <i class="ace-icon fa fa-undo bigger-110"></i>
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

        /* Validasi */
        $('#validasi').validate({
            //-- Aturan karakter input --//
            rules:
                    {
                        nama_pengguna: {required: true}
                    },
            //-- Pesan error --//
            messages:
                    {
                        nama_pengguna:
                                {
                                    required: "&nbsp;<label style='color:red' class='control-label'> <i class='fa fa-exclamation-triangle'></i> <i>Tidak boleh kosong</i></label>",
                                    maxlength: "<div style='color:red'>Tidak boleh lebih dari 50 huruf</div>"
                                }
                    },
            submitHandler: function (form) {
                form.submit();
            }
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

    var total = document.getElementById("total").value;

    //***** DALTU ******\\
    var i = 1;
    $('.inpt-daltu').hide();
    //--> form daltu ketika load awal
    while (i <= total)
    {
        if ($("input:radio[name='daltu_" + i + "']:checked").val() == "aktif")
        {
            $('#inpt-daltu-' + i).show();
        }
        else
        {
            $('#inpt-daltu-' + i).hide();
        }

        i++;
    }
    function inptDaltu(no_kat)
    {
        if ($("input:radio[name='daltu_" + no_kat + "']:checked").val() == "nonaktif")
        {
            $('#inpt-daltu-' + no_kat).slideUp('fast');
        }
        else
        {
            $('#inpt-daltu-' + no_kat).slideDown('fast');
        }

        $('#hari-daltu-' + no_kat).keyup(function ()
        {
            var hari = parseFloat($('#hari-daltu-' + no_kat).val());
            var hasil = hari / (2 * 3.25); //6.5*hari
            $('#jam-daltu-' + no_kat).val(hasil.toFixed(2));
        });
    }

    //***** DALNIS ******\\
    var j = 1;
    $('.inpt-dalnis').hide();
    //--> form dalnis ketika load awal
    while (j <= total)
    {
        if ($("input:radio[name='dalnis_" + j + "']:checked").val() == "aktif")
        {
            $('#inpt-dalnis-' + j).show();
        }
        else
        {
            $('#inpt-dalnis-' + j).hide();
        }

        j++;
    }
    function inptDalnis(no_kat)
    {
        if ($("input:radio[name='dalnis_" + no_kat + "']:checked").val() == "nonaktif")
        {
            $('#inpt-dalnis-' + no_kat).slideUp('fast');
        }
        else
        {
            $('#inpt-dalnis-' + no_kat).slideDown('fast');
        }

        $('#hari-dalnis-' + no_kat).keyup(function ()
        {
            var hari = parseFloat($('#hari-dalnis-' + no_kat).val());
            var hasil = hari / (2 * 3.25); //6.5*hari
            $('#jam-dalnis-' + no_kat).val(hasil.toFixed(2));
        });
    }

    //***** KETUA ******\\
    var k = 1;
    $('.inpt-ketua').hide();
    //--> form ketua ketika load awal
    while (k <= total)
    {
        if ($("input:radio[name='ketua_" + k + "']:checked").val() == "aktif")
        {
            $('#inpt-ketua-' + k).show();
        }
        else
        {
            $('#inpt-ketua-' + k).hide();
        }

        k++;
    }
    function inptKetua(no_kat)
    {
        if ($("input:radio[name='ketua_" + no_kat + "']:checked").val() == "nonaktif")
        {
            $('#inpt-ketua-' + no_kat).slideUp('fast');
        }
        else
        {
            $('#inpt-ketua-' + no_kat).slideDown('fast');
        }

        $('#hari-ketua-' + no_kat).keyup(function ()
        {
            var hari = parseFloat($('#hari-ketua-' + no_kat).val());
            var hasil = hari / (2 * 3.25); //6.5*hari
            $('#jam-ketua-' + no_kat).val(hasil.toFixed(2));
        });
    }

    //***** ANGGOTA ******\\
    var l = 1;
    $('.inpt-anggota').hide();
    //--> form anggota ketika load awal
    while (l <= total)
    {
        if ($("input:radio[name='anggota_" + l + "']:checked").val() == "aktif")
        {
            $('#inpt-anggota-' + l).show();
        }
        else
        {
            $('#inpt-anggota-' + l).hide();
        }

        l++;
    }
    function inptAnggota(no_kat)
    {
        if ($("input:radio[name='anggota_" + no_kat + "']:checked").val() == "nonaktif")
        {
            $('#inpt-anggota-' + no_kat).slideUp('fast');
        }
        else
        {
            $('#inpt-anggota-' + no_kat).slideDown('fast');
        }

        $('#hari-anggota-' + no_kat).keyup(function ()
        {
            var hari = parseFloat($('#hari-anggota-' + no_kat).val());
            var hasil = hari / (2 * 3.25); //6.5*hari
            $('#jam-anggota-' + no_kat).val(hasil.toFixed(2));
        });
    }

    //Jumlah anggota
    $("#alert").hide();
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
    ?>" +
                    "<option value='<?= $row->anggota; ?> " + form_agt + "'> <?= $row->nama; ?> [ANGGOTA] </option>" +
                    "		<?php } ?>" +
                "	</select>" +
                "  <a href='#' onclick='hapusElemenAgt(\"#srow" + fagt + "\"); return false;' class='btn btn-xs btn-danger' title='Hapus anggota ke-" + fagt + "'> <i class='fa fa-minus'></i> </a>" +
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

</script>

</body>
</html>

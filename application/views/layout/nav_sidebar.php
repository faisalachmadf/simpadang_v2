  <div class="main-container ace-save-state" id="main-container">

      <div id="sidebar" class="sidebar responsive ace-save-state">

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
          <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
            <h4>SISTEM INFORMASI PENGAWASAN DAN TINDAK LANJUT</h4>
            <img src="<?= base_url(); ?>assets/images/logo.png" width="120" height="120"> <br/>
            <h4>I N S P E K T O R A T KOTA PARIAMAN</h4>
          </div>

          <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
            <img src="<?= base_url(); ?>assets/images/logo.png" width="27" height="27" style="margin-top:10px">
          </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list" id="side-menu">
          <?php if($level['jenis_jabatan'] == 'irban' && $level['level'] == ''){ ?>
          <li class="active">
            <a href="<?= site_url('irban/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
          <li class="">
            <a href="<?= site_url('irban/notadinas'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>

            <b class="arrow"></b>
          </li>
        <?php } ?>
        <!-- Jika level = admin, tampilkan menu admin -->
        <?php if($level['level']=='adm'){ ?>
          <li class="active">
            <a href="<?= site_url('adm/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('adm/kelola_pengguna/tambah_pengguna'); ?>" title="Tambah pengguna">
              <i class="menu-icon fa fa-user-plus"></i>
              <span class="menu-text"> Tambah Pengguna </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('adm/kelola_pengguna'); ?>" title="Kelola pengguna">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-text"> Data Pengguna </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle" title="Pengaturan">
              <i class="menu-icon fa fa-cogs"></i>
              <span class="menu-text"> Pengaturan </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="<?= site_url('adm/pengaturan'); ?>" title="Set golongan & jabatan pegawai">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Golongan & Jabatan
                </a>

                <b class="arrow"></b>
              </li>
            </ul>
          </li>
        <!-- /.menu admin -->

        <!-- Jika level = inspektur, tampilkan menu inspektur -->
        <?php }elseif($level['level']=='inspektur'){ ?>
          <li class="active">
            <a href="<?= site_url('inspektur/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('inspektur/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('inspektur/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-flag-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu inspektur -->

        <!-- Jika level = daltu, tampilkan menu daltu -->
        <?php }elseif(($level['level']=='daltu')){ ?>
          <li class="active">
            <a href="<?= site_url('daltu/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>
         
            <b class="arrow"></b>
          </li>
           <?php } ?>
          <li class="">
            <a href="<?= site_url('daltu/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <!-- <li class="">
            <a href="<?= site_url('daltu/anggaran_waktu'); ?>" title="Alokasi Anggaran Waktu">
              <i class="menu-icon fa fa-clock-o"></i>
              <span class="menu-text"> Anggaran Waktu </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('daltu/pka'); ?>" title="Program kerja audit">
              <i class="menu-icon fa fa-qrcode"></i>
              <span class="menu-text"> Program Kerja Audit </span>
            </a>

            <b class="arrow"></b>
          </li> -->

          <li class="">
            <a href="<?= site_url('daltu/p2hp_lhp'); ?>" title="Pokok-pokok hasil pemeriksaan & laporan hasil pemeriksaan">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text"> P2HP & LHP </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu daltu -->

        <!-- Jika level = dalnis, tampilkan menu dalnis -->
        <?php }elseif($level['level']=='dalnis'){ ?>
          <li class="active">
            <a href="<?= site_url('dalnis/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>
          
            <b class="arrow"></b>
          </li>
          <?php } ?>
          <li class="">
            <a href="<?= site_url('dalnis/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('dalnis/anggaran_waktu'); ?>" title="Alokasi Anggaran Waktu">
              <i class="menu-icon fa fa-clock-o"></i>
              <span class="menu-text"> Anggaran Waktu </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('dalnis/pka'); ?>" title="Program kerja audit">
              <i class="menu-icon fa fa-qrcode"></i>
              <span class="menu-text"> Program Kerja Audit </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('dalnis/p2hp_lhp'); ?>" title="Pokok-pokok hasil pemeriksaan & laporan hasil pemeriksaan">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text"> P2HP & LHP </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu dalnis -->

        <!-- Jika level = staff, tampilkan menu administrasi dan umum -->
        <?php }elseif($level['level']=='staff'){ ?>
          <li class="active">
            <a href="<?= site_url('staff/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <!-- <li class="">
            <a href="<?= site_url('staff/data_pegawai'); ?>" title="Data pegawai">
              <i class="menu-icon fa fa-users"></i>
              <span class="menu-text"> Data Pegawai </span>
            </a>

            <b class="arrow"></b>
          </li> -->

          <li class="">
            <a href="<?= site_url('staff/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>
          
          <li class="">
            <a href="<?= site_url('staff/temuan'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-bookmark-o"></i>
              <span class="menu-text"> Temuan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('staff/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-flag-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('staff/data_surat'); ?>" title="Surat tugas">
              <i class="menu-icon fa fa-file-text-o"></i>
              <span class="menu-text"> Surat Tugas </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('staff/instansi'); ?>" title="Instansi">
              <i class="menu-icon fa fa-building"></i>
              <span class="menu-text"> Instansi </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="<?= site_url('staff/rev_instansi'); ?>" title="Instansi">
              <i class="menu-icon fa fa-building"></i>
              <span class="menu-text"> Revisi Instansi  </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu staff -->

        <!-- Jika level = adum, tampilkan menu administrasi dan umum -->
  
        <?php }elseif($level['level']=='adum' || $level['jenis_jabatan'] == 'adum'){ ?>
          <li class="active">
            <a href="<?= site_url('adum/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('adum/pkpt'); ?>" title="Home">
              <i class="menu-icon fa fa-file-text-o"></i>
              <span class="menu-text"> PKPT Tahunan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('adum/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="<?= site_url('adum/temuan'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-bookmark-o"></i>
              <span class="menu-text"> Temuan </span>
            </a>
            <b class="arrow"></b>
          </li>
          
          <li class="">
            <a href="<?= site_url('adum/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-flag-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>

        <!-- /.menu adum -->
        
        <!-- Jika level = SEKRETARIS, tampilkan menu administrasi dan umum -->
        <?php }elseif($level['level']=='sekretaris'){ ?>
          <li class="active">
            <a href="<?= site_url('sekretaris/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('sekretaris/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('sekretaris/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-send-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu sekretaris -->

        <!-- Jika level = ketua tim, tampilkan menu ketua tim -->
        <?php }elseif($level['level']=='ketua_tim'){ ?>
          <li class="active">
            <a href="<?= site_url('ketua_tim/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>
          
            <b class="arrow"></b>
          </li>
          <?php } ?>
          <li class="">
            <a href="<?= site_url('ketua_tim/penugasan'); ?>" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Penugasan </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('ketua_tim/anggaran_waktu'); ?>" title="Alokasi anggaran waktu">
              <i class="menu-icon fa fa-clock-o"></i>
              <span class="menu-text"> Anggaran Waktu </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('ketua_tim/pka'); ?>" title="Program kerja audit">
              <i class="menu-icon fa fa-qrcode"></i>
              <span class="menu-text"> Program Kerja Audit </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('ketua_tim/p2hp_lhp'); ?>" title="Pokok-pokok hasil pemeriksaan & laporan hasil pemeriksaan">
              <i class="menu-icon fa fa-book"></i>
              <span class="menu-text"> P2HP & LHP </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="#" class="dropdown-toggle" title="Pengaturan">
              <i class="menu-icon fa fa-cogs"></i>
              <span class="menu-text"> Pengaturan </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              <li class="">
                <a href="<?= site_url('ketua_tim/pengaturan/list_anggaran_waktu'); ?>" title="Set alokasi anggaran waktu">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Anggaran Waktu
                </a>

                <b class="arrow"></b>
              </li>
            </ul>
          </li>
        <!-- /.menu ketua tim -->

        <!-- Jika level = anggota tim, tampilkan menu anggota tim -->
        <?php }elseif($level['level']=='anggota_tim'){ ?>
          <li class="active">
            <a href="<?= site_url('anggota_tim/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>

            <b class="arrow"></b>
          </li>
        <?php } ?>
          <li class="">
            <a href="<?= site_url('anggota_tim/kka'); ?>" title="Kertas Kerja Audit (KKA)">
              <i class="menu-icon fa fa-file-text-o"></i>
              <span class="menu-text"> Kertas Kerja Audit </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu anggota tim -->

        <!-- Jika level = ketua tim tindak lanjut, tampilkan menu ketua tim tl -->
        <?php }elseif($level['level']=='ketua_tl'){ ?>
          <li class="active">
            <a href="<?= site_url('ketua_tl/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>

           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>

            <b class="arrow"></b>
          </li>
        <?php } ?>
          <li class="">
            <a href="<?= site_url('ketua_tl/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-send-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu ketua tim tl -->

         <!-- Jika level = anggota tim tindak lanjut, tampilkan menu anggota tim tl -->
        <?php }elseif($level['level']=='anggota_tl' ){ ?>
          <li class="active">
            <a href="<?= site_url('anggota_tl/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
          <?php if($level['jenis_jabatan']=='irban'){ ?>
          <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Nota Dinas </span>
            </a>

            <b class="arrow"></b>
          </li>
           <li class="">
            <a href="#" title="Penugasan">
              <i class="menu-icon fa fa-edit"></i>
              <span class="menu-text"> Telahaan Staff </span>
            </a>

            <b class="arrow"></b>
          </li>
        <?php } ?>
          <li class="">
            <a href="<?= site_url('anggota_tl/tindak_lanjut'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-send-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu anggota tim tl -->

        <!-- Jika level = staff evlap, tampilkan menu evlap-->
        <?php }elseif($level['level']=='staff_evlap'){ ?>
          <li class="active">
            <a href="<?= site_url('staff_evlap/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('staff_evlap/temuan'); ?>" title="Temuan">
              <i class="menu-icon fa fa-bookmark-o"></i>
              <span class="menu-text"> Temuan </span>
            </a>
            <b class="arrow"></b>
          </li>

          <!-- <li class="">
            <a href="<?= site_url('staff_evlap/tindak_lanjut'); ?>" title="Tindak Lanjut">
              <i class="menu-icon fa fa-flag-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>
            <b class="arrow"></b>
          </li> -->

          <!-- Jika level = Ketua Tim Nota Dinas, tampilkan menu ketua nd-->
          <?php }elseif($level['level']=='ketua_nd'){ ?>
          <li class="active">
            <a href="<?= site_url('ketua_nd/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>
        
          <li class="">
            <a href="<?= site_url('ketua_nd/pka_umum'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-send-o"></i>
              <span class="menu-text"> PKA UMUM </span>
            </a>

            <b class="arrow"></b>
          </li>
          <hr/>
          <li class="">
            <a href="<?= site_url('Home'); ?>" title="Tindak lanjut">
              <i class="menu-icon fa fa-arrow-left"></i>
              <span class="menu-text"> Pemilihan Tugas<br/> </span>
            </a>

            <b class="arrow"></b>
          </li>
        <!-- /.menu ketua tim nd -->

        <!-- /.menu evlap -->

        <!-- Jika level = evlap, tampilkan menu evlap-->
        <?php }elseif($level['level']=='evlap'){ ?>
          <li class="active">
            <a href="<?= site_url('evlap/home'); ?>" title="Home">
              <i class="menu-icon fa fa-home"></i>
              <span class="menu-text"> Home </span>
            </a>

            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('evlap/temuan'); ?>" title="Temuan">
              <i class="menu-icon fa fa-bookmark-o"></i>
              <span class="menu-text"> Temuan </span>
            </a>
            <b class="arrow"></b>
          </li>

          <li class="">
            <a href="<?= site_url('evlap/tindak_lanjut'); ?>" title="Tindak Lanjut">
              <i class="menu-icon fa fa-flag-o"></i>
              <span class="menu-text"> Tindak Lanjut </span>
            </a>
            <b class="arrow"></b>
          </li>
        <!-- /.menu evlap -->
        <?php } ?>


        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>
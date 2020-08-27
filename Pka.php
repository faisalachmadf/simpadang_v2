<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pka extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->auth->cek_auth(); //--> ambil auth dari library
        //--> load model
        $this->load->model('notifikasi_m');
        $this->load->model('ketua_tim/anggaran_waktu_m');
        $this->load->model('ketua_tim/pka_m');
        $this->load->model('staff/penugasan_m');
        $this->load->model('staff/tim_m');
        $this->load->model('staff/instansi_m');

        //--> hak akses
        $hak_akses = $this->session->userdata('lvl');
        if ($hak_akses != 'ketua_tim') {
            echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
            redirect('log_in', 'refresh');
            exit();
        }
        // ./hak akses
    }

    //--> list pka
    public function index() {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'pka' => $this->pka_m->get_pka($kt->id_pegawai)
        );

        $this->load->view('ketua_tim/pka/list_pka', $data);
    }

    function get_abjad() {
        $mod = $this->input->post('modul');
        $id = $this->input->post('id');
        if ($mod == "plus") {
            echo $this->pka_m->get_abjad_plus($id);
        } else {
            echo $this->pka_m->get_abjad_minus($id);
        }
    }

    //--> detail pka
    public function detail_pka($id_pka) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_pka);

        //-> update notif penugasan
        $this->notifikasi_m->update_notif_ketua($key);

        $data_pka = $this->pka_m->get_row_pka($key);

        //--> tgl pemeriksaan
        $tgl_awal = date('d', strtotime($data_pka->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) . " " .
                date('Y', strtotime($data_pka->tgl_awal));
        $tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) . " " .
                date('Y', strtotime($data_pka->tgl_akhir));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'data' => $data_pka,
            'sub1' => $this->pka_m->get_sub_pka1($key),
            'sub2' => $this->pka_m->get_sub_pka2($key),
            'sub3' => $this->pka_m->get_sub_pka3($key),
            'ins' => $this->pka_m->get_sub_pka1_instansi($key),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'sasaran' => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
            'cek_rev' => $this->pka_m->cek_reviu($key),
            'data_rev' => $this->pka_m->get_rev_pka($key)
        );

        $this->load->view('ketua_tim/pka/detail_pka', $data);
    }

    //--> detail reviu pka
    public function detail_reviu($id_pka, $no_rev) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_pka);
        $key2 = base64_decode($no_rev);

        $data_rev_pka = $this->pka_m->get_rev_pka1($key, $key2);
        $data_pka = $this->pka_m->get_row_pka($key);

        $tgl_rev = date('d', strtotime($data_rev_pka->tgl_reviu)) . " " .
                get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_reviu))) . " " .
                date('Y', strtotime($data_rev_pka->tgl_reviu)) . " | " .
                date('H:i:s', strtotime($data_rev_pka->tgl_reviu));

        $tgl_rev_dn = date('d', strtotime($data_rev_pka->tgl_rev_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_rev_dalnis))) . " " .
                date('Y', strtotime($data_rev_pka->tgl_rev_dalnis)) . " | " .
                date('H:i:s', strtotime($data_rev_pka->tgl_rev_dalnis));

        $tgl_rev_dt = date('d', strtotime($data_rev_pka->tgl_rev_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_rev_daltu))) . " " .
                date('Y', strtotime($data_rev_pka->tgl_rev_daltu)) . " | " .
                date('H:i:s', strtotime($data_rev_pka->tgl_rev_daltu));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'data' => $data_rev_pka,
            'rev_pka2' => $this->pka_m->get_rev_pka2($key, $key2),
            'rev_pka3' => $this->pka_m->get_rev_pka3($key, $key2),
            'rev_pka4' => $this->pka_m->get_rev_pka4($key, $key2),
            'ins' => $this->pka_m->get_rev_pka2_instansi($key, $key2),
            'sasaran' => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
            'tgl_rev' => $tgl_rev,
            'tgl_rev_dn' => $tgl_rev_dn,
            'tgl_rev_dt' => $tgl_rev_dt,
        );

        $this->load->view('ketua_tim/pka/detail_rev_pka', $data);
    }

    //--> tambah pka
    public function tambah_pka($id_tugas, $id_tim, $id_agr) {
        ini_set('max_execution_time', 0);
        ini_set('max_input_time', 0);

        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);
        $key3 = base64_decode($id_agr);

        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $penugasan = $this->penugasan_m->get_row_penugasan($key);

        $tgl_awal = date('d', strtotime($penugasan->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($penugasan->tgl_awal))) . " " .
                date('Y', strtotime($penugasan->tgl_awal));
        $tgl_akhir = date('d', strtotime($penugasan->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($penugasan->tgl_akhir))) . " " .
                date('Y', strtotime($penugasan->tgl_akhir));

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'tanggal' => $tanggal,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'id_pka' => $this->pka_m->get_id_max_pka(),
            'jp' => $this->anggaran_waktu_m->get_sub_anggaran_waktu($key3),
            'total' => $this->anggaran_waktu_m->count_agr($key3),
            'data' => $penugasan,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'pegawai' => $this->login_model->get_pegawai($this->session->userdata('username')),
            'anggota' => $this->tim_m->get_sub_tim($key2),
            'sasaran' => $this->tim_m->get_sub_sasaran($key2)
        );

        $this->load->view('ketua_tim/pka/form_tambah_pka', $data);

        //--> jika form submit
        /* if($this->input->post('submit'))
          {

          } */
    }

    //--> form temporary pka
    public function temp_pka($id_pka, $id_tugas, $id_tim) {
        ini_set('max_execution_time', 0);
        ini_set('max_input_time', 0);

        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_pka);
        $key2 = base64_decode($id_tugas);
        $key3 = base64_decode($id_tim);

        $data_pka = $this->pka_m->get_row_temp_pka($key);

        $tgl_rev_dn = date('d', strtotime($data_pka->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_dalnis))) . " " .
                date('Y', strtotime($data_pka->tgl_dalnis)) . " | " .
                date('H:i:s', strtotime($data_pka->tgl_dalnis));

        $tgl_rev_dt = date('d', strtotime($data_pka->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_daltu))) . " " .
                date('Y', strtotime($data_pka->tgl_daltu)) . " | " .
                date('H:i:s', strtotime($data_pka->tgl_daltu));

        //--> tgl pemeriksaan
        $tgl_awal = date('d', strtotime($data_pka->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) . " " .
                date('Y', strtotime($data_pka->tgl_awal));
        $tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) . " " .
                date('Y', strtotime($data_pka->tgl_akhir));

        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $penugasan = $this->penugasan_m->get_row_penugasan($key2);

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'tanggal' => $tanggal,
            'data' => $data_pka,
            'sub1' => $this->pka_m->get_sub_temp_pka2($key),
            'sub2' => $this->pka_m->get_sub_temp_pka3($key),
            'sub3' => $this->pka_m->get_sub_temp_pka4($key),
            //'rev_ke'       => $this->pka_m->cek_rev_pka($key),
            'total_jp' => $this->pka_m->count_temp_pka2($key),
            'total_tjnPKA' => $this->pka_m->count_temp_pka2tjnPKA($key),
            'total_tjn' => $this->pka_m->count_temp_pka3tjn($key),
            'total_lkh' => $this->pka_m->count_temp_pka3lkh($key),
            'total_plk' => $this->pka_m->count_temp_pka4($key),
            'ins' => $this->pka_m->get_temp_pka2_instansi($key),
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'pegawai' => $this->login_model->get_pegawai($this->session->userdata('username')),
            'anggota' => $this->tim_m->get_sub_tim($key3),
            'sasaran' => $this->tim_m->get_sub_sasaran($key3),
            'tgl_rev_dn' => $tgl_rev_dn,
            'tgl_rev_dt' => $tgl_rev_dt,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );
        $this->load->view('ketua_tim/pka/form_temp_pka', $data);
    }

    public function proses_tambah_pka() {
        if ($this->input->post('submit')) {
//                    print_r($_POST);exit;
            $id = base64_encode($this->input->post('id_pka'));
            $this->pka_m->insert_pka();

            $id_pka_ori = $this->input->post('id_pka');
            $cek = $this->db->query("SELECT * FROM temp_pka1 WHERE id_pka = '$id_pka_ori'")->num_rows();
            if ($cek > 0) {
                $this->db->delete('temp_pka1', array('id_pka' => $id_pka_ori));
                $this->db->delete('temp_pka2', array('sub_pka1' => $id_pka_ori));
                $this->db->delete('temp_pka3', array('sub_pka2' => $id_pka_ori));
                $this->db->delete('temp_pka4', array('sub_pka3' => $id_pka_ori));
            }

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Membuat Program Kerja Audit!
								</strong>
								Data program kerja audit telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
            );

            redirect('ketua_tim/pka/detail_pka/' . $id);
        } elseif ($this->input->post('temp')) {
            //echo "insert temporary";
            $id = base64_encode($this->input->post('id_pka'));
            $id1 = base64_encode($this->input->post('id_tgs'));
            $id2 = base64_encode($this->input->post('id_tim'));
            $id_pka_ori = $this->input->post('id_pka');
            $cek = $this->db->query("SELECT * FROM temp_pka1 WHERE id_pka = '$id_pka_ori'")->num_rows();

            if ($cek > 0) {
                $this->pka_m->update_temp_pka();
            } else {
                $this->pka_m->insert_temp_pka();
            }

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Simpan Temp PKA!
								</strong>
								Data PKA di simpan secara temporary, cek data dengan klik <i><strong>Buat Program Kerja Audit</strong></i>.
							</p>
						</div>"
            );

            redirect('ketua_tim/penugasan/detail_penugasan/' . $id1 . '/' . $id2);
        }

        /* $id_pka = $this->input->post('id_pka');
          $id_tgs = $this->input->post('id_tgs');
          $id_tim = $this->input->post('id_tim');

          $masa_periksa = $this->input->post('masa_periksa');
          $no_ref_pka   = $this->input->post('no_ref_pka');

          $jml_ins = $this->input->post('jml_ins');
          $jml_jp  = $this->input->post('jml_jp');
          $jml_tjn = $this->input->post('jml_tjn');
          $jml_lkh = $this->input->post('jml_lkh');
          $jml_2	 = $jml_tjn + $jml_lkh;
          $jml_agt = $this->input->post('jml_agt');

          $kta = $this->input->post('kategori');
          $kod = $this->input->post('kode_pekerjaan');
          $jen = $this->input->post('jenis_pekerjaan');
          $ins = $this->input->post('nama_instansi');

          $no_ins       = $this->input->post('no_ins');
          $no_kat       = $this->input->post('no_kat');
          $nama_periksa = $this->input->post('nama_periksa');
          $kode_periksa = $this->input->post('kode_periksa');
          $tanggal      = $this->input->post('tanggal');
          $no_kka       = $this->input->post('no_kka');
          $keterangan   = $this->input->post('keterangan');

          $pelaksana     = $this->input->post('pelaksana');
          $no_kka2       = $this->input->post('no_kka2');
          $nomor         = $this->input->post('nomor');

          ######################################
          # TB PKA
          ######################################
          echo "
          <p> TABEL PKA </p> <hr/>
          <p> ID PKA : $id_pka </p>
          <p> ID TGS : $id_tgs </p>
          <p> Tanggal PKA : ". date("Y-m-d H:i:s") ."</p>
          <p> Masa Yang Diperiksa : $masa_periksa </p>
          <p> Nomor REF. PKA : $no_ref_pka </p> <br/>

          <p> Jumlah Jenis Pekerjaan : $jml_jp </p>
          <p> Jumlah Tujuan Pemeriksaan : $jml_tjn </p>
          <p> Jumlah Langkah Pemeriksaan : $jml_lkh </p>
          <p> Jumlah TUJUAN + LANGKAH : $jml_2 </p>
          <p> Jumlah Pelaksana : $jml_agt </p>
          ";

          ######################################
          # TB SUB PKA 1
          ######################################
          echo " <br/>
          <p> TABEL SUB 1 </p>
          <table border='1'>
          <tr>
          <th align='center'> SUB PKA 1 </th>
          <th align='center'> NO </th>
          <th align='center'> KATEGORI </th>
          <th align='center'> KODE PEKERJAAN </th>
          <th align='center'> JENIS PEKERJAAN </th>
          <th align='center'> KESIMPULAN KERJA </th>
          </tr>

          <tr><td colspan='6'>&nbsp;</td></tr>
          ";

          $i = 0;
          while($i < $jml_jp)
          {
          $no = $i+1;

          if($jml_ins != "1")
          { $instansi = $ins[$i]; }
          else
          { $instansi = "-"; }

          echo "
          <tr>
          <td> $id_pka </td>
          <td> $no </td>
          <td> $kta[$i] </td>
          <td> $kod[$i] </td>
          <td> $jen[$i] </td>
          <td> $instansi </td>
          </tr>
          ";
          $i++;
          }
          echo "</table> <br/>";

          ######################################
          # TB SUB PKA 2
          ######################################
          echo " <br/>
          <p> TABEL SUB 2 </p>
          <table border='1'>
          <tr>
          <th align='center'> SUB PKA 2 </th>
          <th align='center'> KODE PEKERJAAN </th>
          <th align='center'> KODE URAIAN </th>
          <th align='center'> URAIAN </th>
          <th align='center'> TANGGAL </th>
          <th align='center'> NO. KKA </th>
          <th align='center'> KET </th>
          </tr>

          <tr><td colspan='7'>&nbsp;</td></tr>
          ";

          $j = 0;
          while($j < $jml_2)
          {
          if($jml_ins != "1")
          {
          //if($no_kka[$j] != "-")
          //{
          //	$kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
          //}
          //else
          //{
          //	$kode_uraian = "-";
          //}

          $kode_uraian = "$no_ins[$j]-$no_kat[$j]-$kode_periksa[$j]";
          $kode_pekerjaan = "$id_pka-$no_ins[$j]-$no_kat[$j]";
          $nomor_kka 			= $no_kka[$j];
          }
          else
          {
          $kode_pekerjaan = "$id_pka-$no_kat[$j]";
          $kode_uraian    = "$no_kat[$j]-$kode_periksa[$j]";
          $nomor_kka 			= str_replace('..', '.', $no_kka[$j]);
          }

          echo "
          <tr>
          <td> $id_pka </td>
          <td> $kode_pekerjaan </td>
          <td> $kode_uraian </td>
          <td> $nama_periksa[$j] </td>
          <td> $tanggal[$j] </td>
          <td> $nomor_kka </td>
          <td> $keterangan[$j] </td>
          </tr>
          ";
          $j++;
          }
          echo "</table> <br/>";

          ######################################
          # TB SUB PKA 3
          ######################################
          echo " <br/>
          <p> TABEL SUB 3 </p>
          <table border='1'>
          <tr>
          <th align='center'> SUB NO KKA </th>
          <th align='center'> NOMOR </th>
          <th align='center'> PELAKSANA </th>
          <th align='center'> JABATAN </th>
          </tr>

          <tr><td colspan='4'>&nbsp;</td></tr>
          ";

          $k = 0;
          while($k < $jml_agt)
          {
          $no2 = $k+1;

          if($jml_ins != "1")
          { $nomor_kka2 = $no_kka2[$k]; }
          else
          { $nomor_kka2 = str_replace('..', '.', $no_kka2[$k]); }

          $getPelaksana  = substr($pelaksana[$k],0,8);
          $getKode 			 = substr($pelaksana[$k],9,1);

          $query = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND daltu = '$getPelaksana'");
          if($query->num_rows() > 0)
          {
          $jbtn = "Pengendali Mutu";
          }

          $query2 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND dalnis = '$getPelaksana'");
          if($query2->num_rows() > 0)
          {
          $jbtn = "Pengendali Teknis";
          }

          $query3 = $this->db->query("SELECT * FROM tb_tim WHERE id_tim = '$id_tim' AND ketua_tim = '$getPelaksana'");
          if($query3->num_rows() > 0)
          {
          $jbtn = "Ketua Tim";
          }

          $query4 = $this->db->query("SELECT * FROM sub_tim WHERE sub_id_tim = '$id_tim' AND anggota = '$getPelaksana'");
          if($query4->num_rows() > 0)
          {
          $jbtn = "Anggota Tim";
          }

          echo "
          <tr>
          <td> $nomor_kka2 </td>
          <td> $nomor[$k] </td>
          <td> $getPelaksana </td>
          <td> $jbtn </td>
          </tr>
          ";
          $k++;
          }
          echo "</table> <br/>"; */
    }

    //--> reviu pka
    public function reviu_pka($id_pka, $id_tugas, $id_tim) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_pka);
        $key2 = base64_decode($id_tugas);
        $key3 = base64_decode($id_tim);

        $data_pka = $this->pka_m->get_row_pka($key);

        $tgl_rev_dn = date('d', strtotime($data_pka->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_dalnis))) . " " .
                date('Y', strtotime($data_pka->tgl_dalnis)) . " | " .
                date('H:i:s', strtotime($data_pka->tgl_dalnis));

        $tgl_rev_dt = date('d', strtotime($data_pka->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_daltu))) . " " .
                date('Y', strtotime($data_pka->tgl_daltu)) . " | " .
                date('H:i:s', strtotime($data_pka->tgl_daltu));

        //--> tgl pemeriksaan
        $tgl_awal = date('d', strtotime($data_pka->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) . " " .
                date('Y', strtotime($data_pka->tgl_awal));
        $tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) . " " .
                date('Y', strtotime($data_pka->tgl_akhir));

        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $penugasan = $this->penugasan_m->get_row_penugasan($key2);

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'tanggal' => $tanggal,
            'data' => $data_pka,
            'sub1' => $this->pka_m->get_sub_pka1($key),
            'sub2' => $this->pka_m->get_sub_pka2($key),
            'sub3' => $this->pka_m->get_sub_pka3($key),
            'rev_ke' => $this->pka_m->cek_rev_pka($key),
            'total_jp' => $this->pka_m->count_sub_pka1($key),
            'total_tjnPKA' => $this->pka_m->count_sub_pka1tjnPKA($key),
            'total_tjn' => $this->pka_m->count_sub_pka2tjn($key),
            'total_lkh' => $this->pka_m->count_sub_pka2lkh($key),
            'total_plk' => $this->pka_m->count_sub_pka3($key),
            'ins' => $this->pka_m->get_sub_pka1_instansi($key),
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'pegawai' => $this->login_model->get_pegawai($this->session->userdata('username')),
            'anggota' => $this->tim_m->get_sub_tim($key3),
            'sasaran' => $this->tim_m->get_sub_sasaran($key3),
            'tgl_rev_dn' => $tgl_rev_dn,
            'tgl_rev_dt' => $tgl_rev_dt,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );

        $this->load->view('ketua_tim/pka/form_rev_pka', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {
            $id = base64_encode($this->input->post('id_pka'));
            $this->pka_m->reviu_pka();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Program Kerja Audit Diubah!
								</strong>
								Data PKA telah diubah, cek data tersebut di bawah ini.
							</p>
						</div>"
            );

            redirect('ketua_tim/pka/detail_pka/' . $id);
        }
    }

    //--> cetak pka
    public function cetak_pka($id_pka) {
        $pdf = $this->pdf->load_surat();

        $key = base64_decode($id_pka);

        $data_pka = $this->pka_m->get_row_pka($key);

        //--> tgl pemeriksaan
        $tgl_awal = date('d', strtotime($data_pka->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) . " " .
                date('Y', strtotime($data_pka->tgl_awal));
        $tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) . " " .
                date('Y', strtotime($data_pka->tgl_akhir));

        $tgl_pka = date('d', strtotime($data_pka->tgl_pka)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_pka))) . " " .
                date('Y', strtotime($data_pka->tgl_pka));

        $tgl_dn = date('d', strtotime($data_pka->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_dalnis))) . " " .
                date('Y', strtotime($data_pka->tgl_dalnis));

        $tgl_dt = date('d', strtotime($data_pka->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_daltu))) . " " .
                date('Y', strtotime($data_pka->tgl_daltu));

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->ketua_tim))->row();

        $data = array(
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'data' => $data_pka,
            'sub1' => $this->pka_m->get_sub_pka1($key),
            'sub2' => $this->pka_m->get_sub_pka2($key),
            'sub3' => $this->pka_m->get_sub_pka3($key),
            'ins' => $this->pka_m->get_sub_pka1_instansi($key),
            'sasaran' => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
            'tgl_pka' => $tgl_pka,
            'tgl_dn' => $tgl_dn,
            'tgl_dt' => $tgl_dt,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'addPage' => $pdf->AddPage()
        );

        $html = $this->load->view('ketua_tim/pka/cetak_pka', $data, TRUE);
        //--> render the view into HTML
        $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
        $output = 'Program_Kerja_Audit_' . $key . '_.pdf';
        $pdf->Output($output, 'I');
    }

    function kka($id_pka) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_pka);

        $data_pka = $this->pka_m->get_row_pka($key);

        //--> tgl pemeriksaan
        $tgl_awal = date('d', strtotime($data_pka->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) . " " .
                date('Y', strtotime($data_pka->tgl_awal));
        $tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) . " " .
                date('Y', strtotime($data_pka->tgl_akhir));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Program Kerja Audit [KETUA TIM] | Inspektorat Cianjur',
            'data' => $data_pka,
            'kka' => $this->pka_m->get_kka($key),
            'kka_ikhtisar' => $this->pka_m->get_kka_ikhtisar($key),
            'sub1' => $this->pka_m->get_sub_pka1($key),
            'sub2' => $this->pka_m->get_sub_pka2($key),
            'sub3' => $this->pka_m->get_sub_pka3($key),
            'ins' => $this->pka_m->get_sub_pka1_instansi($key),
            'sasaran' => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );
//        print_r($data['kka']);exit;
        $this->load->view('ketua_tim/pka/kka', $data);
    }

    public function detail_kka() {
        $id_pka = $this->input->post('id1');
        $no_kka = $this->input->post('id2');
        $pelaksana = $this->input->post('id3');

        $data['kka'] = $this->pka_m->get_row_kka($no_kka, $pelaksana, $id_pka);
        $data['cek_rev'] = $this->pka_m->cek_reviu_kka($id_pka, $no_kka, $pelaksana);
        $data['data_rev'] = $this->pka_m->get_rev_kka($id_pka, $no_kka, $pelaksana);
        $this->load->view('ketua_tim/pka/detail_kka', $data);
    }

    public function detail_kka_ikhtisar() {
        $id_pka = $this->input->post('id1');
        $no_kka = $this->input->post('id2');

        $data['kka'] = $this->pka_m->get_row_sub_pka2($id_pka, $no_kka);
        $data['cek_rev'] = $this->pka_m->cek_reviu_kka_ikhtisar($id_pka, $no_kka);
        $data['data_rev'] = $this->pka_m->get_rev_kka_ikhtisar($id_pka, $no_kka);
        $this->load->view('ketua_tim/pka/detail_kka_ikhtisar', $data);
    }

    function download_kka($file) {
        $nmfile = base64_decode($file);
        force_download('assets/kka/' . $nmfile, NULL);
    }

    function download_bukti_kka($file) {
        $nmfile = base64_decode($file);
        force_download('assets/kka_bukti/' . $nmfile, NULL);
    }

    function download_rev_kka($file) {
        $nmfile = base64_decode($file);
        force_download('assets/kka/reviu/' . $nmfile, NULL);
    }

    function download_kka_ikhtisar($file) {
        $nmfile = base64_decode($file);
        force_download('assets/kka_ikhtisar/' . $nmfile, NULL);
    }

    function download_rev_kka_ikhtisar($file) {
        $nmfile = base64_decode($file);
        force_download('assets/kka_ikhtisar/reviu/' . $nmfile, NULL);
    }

    public function persetujuan_kka($id_pka, $no_kka, $anggota) {
        $key = base64_decode($id_pka);
        $key2 = base64_decode($no_kka);
        $key3 = base64_decode($anggota);

        $this->pka_m->persetujuan_kka_ketua($key, $key2, $key3);

        //--> Tampilkan notifikasi berhasil ubah
        echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA telah di reviu!
							</strong>
							Kertas Kerja Audit telah di reviu oleh Ketua Tim, cek data tersebut di detail KKA.
						</p>
					</div>"
        );

        redirect('ketua_tim/pka/kka/' . $id_pka);
    }

    public function persetujuan_kka_ikhtisar($id_pka, $no_kka) {
        /* $key  = base64_decode($id_pka);
          $key2 = base64_decode($no_kka);
          $this->pka_m->cek_p2hp($key, $key2); */

        $key = base64_decode($id_pka);
        $key2 = base64_decode($no_kka);

        $this->pka_m->persetujuan_kka_ikhtisar_ketua($key, $key2);

        //--> Tampilkan notifikasi berhasil ubah
        echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA Ikhtisar telah di reviu!
							</strong>
							Kertas Kerja Audit Ikhtisar telah di reviu oleh Ketua Tim, cek data tersebut di detail KKA Ikhtisar.
						</p>
					</div>"
        );

        redirect('ketua_tim/pka/kka/' . $id_pka);
    }
    
    public function reset_pka() {
        $tugas = $_POST['tugas'];        
        $id_pka =$_POST['id_pka'];  
        $this->db->delete('sub_pka1',array('sub_pka1'=>$id_pka));
        $this->db->delete('sub_pka2',array('sub_pka2'=>$id_pka));
        $this->db->delete('sub_pka3',array('sub_pka3'=>$id_pka));
        $this->db->delete('tb_pka', array('id_tgs' => $tugas));    
         $this->db->update('tb_penugasan', array('fk_pka' => NULL,), array('id_tugas' => $tugas));
        echo json_encode(array('status' => TRUE));
    }

}

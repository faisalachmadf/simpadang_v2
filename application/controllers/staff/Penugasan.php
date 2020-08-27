<?php

error_reporting(E_ALL);

class Penugasan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->auth->cek_auth(); //--> ambil auth dari library
        //--> load model
        $this->load->model('notifikasi_m');
        $this->load->model('staff/penugasan_m');
        $this->load->model('staff/tim_m');
        $this->load->model('staff/surat_m');
        $this->load->model('staff/instansi_m');

        //--> hak akses
        $hak_akses = $this->session->userdata('lvl');
        if ($hak_akses != 'staff') {
            echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
            redirect('log_in', 'refresh');
            exit();
        }
        // ./hak akses
    }

    //--> list penugasan
    public function index() {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Penugasan [STAFF ADMINISTRASI]pkpt',
            'tugas' => $this->penugasan_m->get_all_tugas()
        );

        $this->load->view('staff/penugasan/list_penugasan', $data);
    }

    public function get_desa() {
        $id = $this->input->post('id');
        echo $this->instansi_m->get_desa($id);
    }

    //--> detail penugasan
    public function detail_penugasan($id_tugas, $id_tim) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);

        //-> update notif penugasan
        $this->notifikasi_m->update_notif_staff($key);

        $cek = $this->db->get_where('tb_penugasan', array('id_tugas' => $key))->row();
        $tgl_tugas = date('d', strtotime($cek->tgl_penugasan)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_penugasan))) . " " .
                date('Y', strtotime($cek->tgl_penugasan));

        $cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
        $tgl_surat = date('d', strtotime($cek2->tgl_surat)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) . " " .
                date('Y', strtotime($cek2->tgl_surat));

        $tgl_awal = date('d', strtotime($cek2->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) . " " .
                date('Y', strtotime($cek2->tgl_awal));

        $tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) . " " .
                date('Y', strtotime($cek2->tgl_akhir));

        $penugasan = $this->penugasan_m->get_row_penugasan($key);

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Penugasan [STAFF ADMINISTRASI]pkpt',
            'data' => $penugasan,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'tgl_tugas' => $tgl_tugas,
            'tim' => $this->tim_m->get_sub_tim($key2),
            'sasaran' => $this->tim_m->get_sub_sasaran($key2),
            'tembusan' => $this->surat_m->get_sub_surat($penugasan->no_st),
            'tgl_surat' => $tgl_surat,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'cek_rev' => $this->penugasan_m->cek_reviu($key),
            'data_rev' => $this->penugasan_m->get_rev_penugasan($key)
        );

        $this->load->view('staff/penugasan/detail_penugasan', $data);
    }

    //--> detail penugasan
    public function detail_reviu($id_tugas, $no_rev) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($no_rev);

        $cek = $this->db->get_where('rev_penugasan1', array('rev_tugas1' => $key, 'rev_ke' => $key2))->row();
        $tgl_tugas = date('d', strtotime($cek->rev_tgl_penugasan)) . " " .
                get_nama_bulan(date('m', strtotime($cek->rev_tgl_penugasan))) . " " .
                date('Y', strtotime($cek->rev_tgl_penugasan));

        $tgl_awal = date('d', strtotime($cek->rev_tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($cek->rev_tgl_awal))) . " " .
                date('Y', strtotime($cek->rev_tgl_awal));

        $tgl_akhir = date('d', strtotime($cek->rev_tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($cek->rev_tgl_akhir))) . " " .
                date('Y', strtotime($cek->rev_tgl_akhir));

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_ketua_tim))->row();

        $get_tim = $this->db->select('*')
                        ->from('rev_penugasan2')
                        ->join('tb_pegawai', 'tb_pegawai.id_pegawai = rev_penugasan2.rev_anggota')
                        ->where('rev_tugas2', $cek->rev_id_tim)
                        ->where('rev_ke', $key2)
                        ->where('rev_anggota !=', NULL)
                        ->get()->result();

        $get_sas = $this->db->select('*')
                        ->from('rev_penugasan2')
                        ->where('rev_tugas2', $cek->rev_id_tim)
                        ->where('rev_ke', $key2)
                        ->where('rev_sasaran !=', NULL)
                        ->get()->result();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Penugasan [STAFF ADMINISTRASI]pkpt',
            'data' => $cek,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'tgl_tugas' => $tgl_tugas,
            'tim' => $get_tim,
            'sasaran' => $get_sas,
            'tgl_surat' => $tgl_tugas,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'cek_rev' => $this->penugasan_m->cek_reviu($key),
            'data_rev' => $this->penugasan_m->get_rev_penugasan($key)
        );

        $this->load->view('staff/penugasan/detail_reviu', $data);
    }

    public function get_no_surat_baru() {
        $no_surat = $_POST['no_surat'];
        $cek = $this->db->get_where('tb_surat', array('no_surat' => $no_surat))->result_array();
        if (count($cek) > 0) {
            $no_urut = 0;
            $nu = $this->surat_m->get_no_urut();
            $no_urut = $nu->no_urut + 1;
            //--> nomor urut surat tugas
            if ($no_urut == 1) {
                $no = "01";
            } elseif ($no_urut == 2) {
                $no = "02";
            } elseif ($no_urut == 3) {
                $no = "03";
            } elseif ($no_urut == 4) {
                $no = "04";
            } elseif ($no_urut == 5) {
                $no = "05";
            } elseif ($no_urut == 6) {
                $no = "06";
            } elseif ($no_urut == 7) {
                $no = "07";
            } elseif ($no_urut == 8) {
                $no = "08";
            } elseif ($no_urut == 9) {
                $no = "09";
            } else {
                $no = $no_urut;
            }
//            echo json_encode(FALSE);
            echo json_encode(array('status'=>FALSE,'no'=>'705/ST-'.$no . "-INSPT/" . date('Y')));
        } else {
            echo json_encode(TRUE);
        }
    }
    public function get_no_surat() {
        $no_surat = $_POST['no_surat'];
        $cek = $this->db->get_where('tb_surat', array('no_surat' => $no_surat))->result_array();
        if (count($cek) > 0) {

            echo json_encode(FALSE);
//            echo json_encode(array('status'=>FALSE,'no'=>'705/ST-'.$no . "-INSPT/" . date('Y')));
        } else {
            echo json_encode(TRUE);
        }
    }

    //--> tambah penugasan
    public function tambah_penugasan() {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $no_urut = 0;
        $nu = $this->surat_m->get_no_urut();
        $no_urut = $nu->no_urut + 1;
        //--> nomor urut surat tugas
        if ($no_urut == 1) {
            $no = "01";
        } elseif ($no_urut == 2) {
            $no = "02";
        } elseif ($no_urut == 3) {
            $no = "03";
        } elseif ($no_urut == 4) {
            $no = "04";
        } elseif ($no_urut == 5) {
            $no = "05";
        } elseif ($no_urut == 6) {
            $no = "06";
        } elseif ($no_urut == 7) {
            $no = "07";
        } elseif ($no_urut == 8) {
            $no = "08";
        } elseif ($no_urut == 9) {
            $no = "09";
        } else {
            $no = $no_urut;
        }


        $tgl = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'title' => 'Penugasan [STAFF ADMINISTRASI]pkpt',
            'id_tgs' => $this->penugasan_m->get_id_max_tugas(),
            'id_tim' => $this->tim_m->get_id_max_tim(),
            'no_id' => $no . "/INSPT/" . date('Y'),
            'irban' => $this->tim_m->get_irban(),
            'dalnis' => $this->tim_m->get_periksa_dalnis(),
            'pegawai' => $this->tim_m->get_pegawai(),
            'tgl' => $tgl,
            'kecamatan' => $this->instansi_m->get_all_instansi(),
            'no_urut' => $no_urut,
            'no_surat' => $no . "-INSPT/" . date('Y'),
            'dasar' => $this->surat_m->get_dasar(),
            'max_tbs' => $this->surat_m->get_max_tbs(),
            'tembusan' => $this->surat_m->get_tembusan()
        );

        $this->load->view('staff/penugasan/form_tambah_penugasan', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {
            $key = base64_encode($this->input->post('id_penugasan'));
            $key2 = base64_encode($this->input->post('id_tim'));
            // print "<pre>"; print_r($_POST); die;
            $this->penugasan_m->insert_penugasan();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
                <button type='button' class='close' data-dismiss='alert'>
                <i class='ace-icon fa fa-times'></i>
            	</button>

				<p>
				<strong>
				<i class='ace-icon fa fa-check'></i>
				Berhasil Tambah Penugasan!
				</strong>
				Data penugasan telah ditambahkan, cek data tersebut di bawah ini.
				</p>
				</div>"
            );

            redirect('staff/penugasan/detail_penugasan/' . $key . '/' . $key2);
        }
    }

    //--> tambah penugasan
    public function reviu_penugasan($id_tugas, $id_tim) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);

        $cek = $this->db->get_where('tb_penugasan', array('id_tugas' => $key))->row();
        $tgl_tugas = date('d', strtotime($cek->tgl_penugasan)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_penugasan))) . " " .
                date('Y', strtotime($cek->tgl_penugasan));

        $tgl_kep = date('d', strtotime($cek->tgl_persetujuan)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_persetujuan))) . " " .
                date('Y', strtotime($cek->tgl_persetujuan));

        $cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
        $tgl_surat = date('d', strtotime($cek2->tgl_surat)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) . " " .
                date('Y', strtotime($cek2->tgl_surat));

        $tgl_awal = date('d', strtotime($cek2->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) . " " .
                date('Y', strtotime($cek2->tgl_awal));

        $tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) . " " .
                date('Y', strtotime($cek2->tgl_akhir));

        $penugasan = $this->penugasan_m->get_row_penugasan($key);

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Penugasan [STAFF ADMINISTRASI]pkpt',
            'irban' => $this->tim_m->get_irban(),
            'pegawai' => $this->tim_m->get_all_pegawai(),
            'kecamatan' => $this->instansi_m->get_all_instansi(),
            'data' => $penugasan,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'tgl_tugas' => $tgl_tugas,
            'tgl_kep' => $tgl_kep,
            'tim' => $this->tim_m->get_sub_tim($key2),
            'jml_agt' => $this->tim_m->count_agt($key2),
            'sasaran' => $this->tim_m->get_sub_sasaran($key2),
            'jml_sas' => $this->tim_m->get_jum_sasaran($key2),
            'tembusan' => $this->surat_m->get_sub_surat($cek2->no_surat),
            'jml_tbs' => $this->surat_m->count_tbs($cek2->no_surat),
            'rev_ke' => $this->penugasan_m->cek_rev_tgs($key),
            'tgl_surat' => $tgl_surat,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir
        );

        $this->load->view('staff/penugasan/form_reviu_penugasan', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {
            $key = base64_encode($this->input->post('id_penugasan'));
            $key2 = base64_encode($this->input->post('id_tim'));

            $this->penugasan_m->reviu_penugasan();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
				<button type='button' class='close' data-dismiss='alert'>
				<i class='ace-icon fa fa-times'></i>
				</button>

				<p>
				<strong>
				<i class='ace-icon fa fa-check'></i>
				Berhasil Reviu Penugasan!
				</strong>
				Data reviu penugasan telah ditambahkan, cek data tersebut di bawah ini.
				</p>
				</div>"
            );

            redirect('staff/penugasan/detail_penugasan/' . $key . '/' . $key2);
        }
    }

}

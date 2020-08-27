<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_waktu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->auth->cek_auth(); //--> ambil auth dari library
        //--> load model
        $this->load->model('notifikasi_m');
        $this->load->model('ketua_tim/anggaran_waktu_m');
        $this->load->model('staff/penugasan_m');
        $this->load->model('staff/tim_m');
        $this->load->model('staff/pegawai_m');
        $this->load->model('staff/surat_m');

        //--> hak akses
        $hak_akses = $this->session->userdata('lvl');
        if ($hak_akses != 'ketua_tim') {
            echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
            redirect('log_in', 'refresh');
            exit();
        }
        // ./hak akses
    }

    //--> list anggaran waktu
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
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'anggaran' => $this->anggaran_waktu_m->get_anggaran_waktu($kt->id_pegawai)
        );

        $this->load->view('ketua_tim/anggaran_waktu/list_anggaran_waktu', $data);
    }

    //--> detail anggaran waktu
    public function detail_anggaran_waktu($id_agr) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_agr);

        //-> update notif penugasan
        $this->notifikasi_m->update_notif_ketua($key);

        $data_agr = $this->anggaran_waktu_m->get_row_anggaran_waktu($key);

        //--> tgl persiapan, pelaksanaan, dan penyelesaian
        $tgl1_persiapan = date('d', strtotime($data_agr->tgl1_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_persiapan))) . " " .
                date('Y', strtotime($data_agr->tgl1_persiapan));
        $tgl2_persiapan = date('d', strtotime($data_agr->tgl2_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_persiapan))) . " " .
                date('Y', strtotime($data_agr->tgl2_persiapan));

        $tgl1_pelaksanaan = date('d', strtotime($data_agr->tgl1_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->tgl1_pelaksanaan));
        $tgl2_pelaksanaan = date('d', strtotime($data_agr->tgl2_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->tgl2_pelaksanaan));

        $tgl1_penyelesaian = date('d', strtotime($data_agr->tgl1_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->tgl1_penyelesaian));
        $tgl2_penyelesaian = date('d', strtotime($data_agr->tgl2_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->tgl2_penyelesaian));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'data' => $data_agr,
            'anggaran' => $this->anggaran_waktu_m->get_sub_anggaran_waktu($key),
            'tgl1_1' => $tgl1_persiapan,
            'tgl2_1' => $tgl2_persiapan,
            'tgl1_2' => $tgl1_pelaksanaan,
            'tgl2_2' => $tgl2_pelaksanaan,
            'tgl1_3' => $tgl1_penyelesaian,
            'tgl2_3' => $tgl2_penyelesaian,
            'cek_rev' => $this->anggaran_waktu_m->cek_reviu($key),
            'data_rev' => $this->anggaran_waktu_m->get_rev_anggaran_waktu($key)
        );

        $this->load->view('ketua_tim/anggaran_waktu/detail_anggaran_waktu', $data);
    }

    //--> detail reviu
    public function detail_reviu($id_agr, $no_rev) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_agr);
        $key2 = base64_decode($no_rev);

        $data_agr = $this->anggaran_waktu_m->get_row_rev_anggaran_waktu($key, $key2);

        $tgl_rev = date('d', strtotime($data_agr->tgl_reviu)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_reviu))) . " " .
                date('Y', strtotime($data_agr->tgl_reviu)) . " | " .
                date('H:i:s', strtotime($data_agr->tgl_reviu));

        $tgl_rev_dn = date('d', strtotime($data_agr->tgl_rev_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_rev_dalnis))) . " " .
                date('Y', strtotime($data_agr->tgl_rev_dalnis)) . " | " .
                date('H:i:s', strtotime($data_agr->tgl_rev_dalnis));

        $tgl_rev_dt = date('d', strtotime($data_agr->tgl_rev_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_rev_daltu))) . " " .
                date('Y', strtotime($data_agr->tgl_rev_daltu)) . " | " .
                date('H:i:s', strtotime($data_agr->tgl_rev_daltu));

        //--> tgl persiapan, pelaksanaan, dan penyelesaian
        $tgl1_persiapan = date('d', strtotime($data_agr->rev_tgl1_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_persiapan))) . " " .
                date('Y', strtotime($data_agr->rev_tgl1_persiapan));
        $tgl2_persiapan = date('d', strtotime($data_agr->rev_tgl2_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_persiapan))) . " " .
                date('Y', strtotime($data_agr->rev_tgl2_persiapan));

        $tgl1_pelaksanaan = date('d', strtotime($data_agr->rev_tgl1_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->rev_tgl1_pelaksanaan));
        $tgl2_pelaksanaan = date('d', strtotime($data_agr->rev_tgl2_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->rev_tgl2_pelaksanaan));

        $tgl1_penyelesaian = date('d', strtotime($data_agr->rev_tgl1_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->rev_tgl1_penyelesaian));
        $tgl2_penyelesaian = date('d', strtotime($data_agr->rev_tgl2_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->rev_tgl2_penyelesaian));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'data' => $data_agr,
            'anggaran' => $this->anggaran_waktu_m->get_rev_anggaran_waktu2($key, $key2),
            'tgl_rev' => $tgl_rev,
            'tgl_rev_dn' => $tgl_rev_dn,
            'tgl_rev_dt' => $tgl_rev_dt,
            'tgl1_1' => $tgl1_persiapan,
            'tgl2_1' => $tgl2_persiapan,
            'tgl1_2' => $tgl1_pelaksanaan,
            'tgl2_2' => $tgl2_pelaksanaan,
            'tgl1_3' => $tgl1_penyelesaian,
            'tgl2_3' => $tgl2_penyelesaian
        );

        $this->load->view('ketua_tim/anggaran_waktu/detail_rev_anggaran_waktu', $data);
    }

    //--> temporary anggaran waktu
    public function tambah_anggaran_waktu($id_tugas, $id_tim) {
//      
        

        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);

        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $penugasan = $this->penugasan_m->get_row_penugasan($key);

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
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'tanggal' => $tanggal,
            'id_agr' => $this->anggaran_waktu_m->get_id_max_agr(),
            'jp' => $this->anggaran_waktu_m->get_set_anggaran(),
            'total' => $this->anggaran_waktu_m->count_set_anggaran(),
            'data' => $penugasan,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'pegawai' => $this->login_model->get_pegawai($this->session->userdata('username')),
            'anggota' => $this->tim_m->get_sub_tim($key2)
        );
        $this->load->view('ketua_tim/anggaran_waktu/form_tambah_anggaran_waktu1', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {

            //print "<pre>"; print_r($_POST); die;

            $id = base64_encode($this->input->post('id_agr'));
            $id2 = $this->input->post('id_agr');
            $this->anggaran_waktu_m->insert_anggaran_waktu();
            $cek = $this->db->query("SELECT * FROM temp_aw1 WHERE id_anggaran_wkt = '$id2'")->num_rows();
            if ($cek > 0) {
                $this->db->delete('temp_aw1', array('id_anggaran_wkt' => $id2));
                $this->db->delete('temp_aw2', array('sub_anggaran_wkt' => $id2));
            }

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Membuat Anggaran Waktu!
								</strong>
								Data alokasi anggaran waktu telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
            );

            redirect('ketua_tim/anggaran_waktu/detail_anggaran_waktu/' . $id);
        } elseif ($this->input->post('temp')) {
            //echo "SIMPAN TEMPORARY";
            $id = $this->input->post('id_agr');
            $id1 = base64_encode($this->input->post('id_tgs'));
            $id2 = base64_encode($this->input->post('id_tim'));
            $this->anggaran_waktu_m->insert_temp_aw();
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>
							<p>
                                                        <strong>
                                                                <i class='ace-icon fa fa-check'></i>
                                                                Berhasil Simpan Temp Anggaran Waktu!
                                                        </strong>
						        Data anggaran waktu berhasil di simpan secara temporary, cek data dengan klik <i><strong>Buat Alokasi Anggaran Waktu</strong></i>.
							</p>
						</div>"
            );

            redirect('ketua_tim/penugasan/detail_penugasan/' . $id1 . '/' . $id2);
        }
    }

    //--> hasil temporary anggaran waktu
    public function temp_anggaran_waktu($id_tugas, $id_tim, $id_agr) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));
//        print_r($_POST);exit;
        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);
        $key3 = base64_decode($id_agr);

        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

        $penugasan = $this->penugasan_m->get_row_penugasan($key);
        $data_agr = $this->anggaran_waktu_m->get_row_aw_temp($key3);
        $sub_agr = $this->anggaran_waktu_m->get_sub_aw_temp($key3);

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
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'tanggal' => $tanggal,
            'id_agr' => $this->anggaran_waktu_m->get_id_max_agr(),
            //'jp'           => $this->anggaran_waktu_m->get_set_anggaran(),
            'total' => $this->anggaran_waktu_m->count_agr_temp($key3),
            'data' => $penugasan,
            'data_agr' => $data_agr,
            'sub_agr' => $sub_agr,
            'daltu' => $daltu,
            'dalnis' => $dalnis,
            'pegawai' => $this->login_model->get_pegawai($this->session->userdata('username')),
            'anggota' => $this->tim_m->get_sub_tim($key2)
        );

        $this->load->view('ketua_tim/anggaran_waktu/form_temp_anggaran_waktu1', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {
            
        }
    }

    //--> reviu anggaran waktu
    public function reviu_anggaran_waktu($id_agr, $id_tugas, $id_tim) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $key = base64_decode($id_tugas);
        $key2 = base64_decode($id_tim);
        $key3 = base64_decode($id_agr);

        $penugasan = $this->penugasan_m->get_row_penugasan($key);
        $data_agr = $this->anggaran_waktu_m->get_row_anggaran_waktu($key3);
        $tanggal = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');
        $sub_agr = $this->anggaran_waktu_m->get_sub_anggaran_waktu($key3);

        $tgl_rev_dn = date('d', strtotime($data_agr->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_dalnis))) . " " .
                date('Y', strtotime($data_agr->tgl_dalnis)) . " | " .
                date('H:i:s', strtotime($data_agr->tgl_dalnis));

        $tgl_rev_dt = date('d', strtotime($data_agr->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_daltu))) . " " .
                date('Y', strtotime($data_agr->tgl_daltu)) . " | " .
                date('H:i:s', strtotime($data_agr->tgl_daltu));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif' => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr' => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka' => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title' => 'Anggaran Waktu [KETUA TIM]',
            'tanggal' => $tanggal,
            'rev_ke' => $this->anggaran_waktu_m->cek_rev_agr($key3),
            'total' => $this->anggaran_waktu_m->count_agr($key3),
            'data' => $penugasan,
            'data_agr' => $data_agr,
            'sub_agr' => $sub_agr,
            'tgl_rev_dn' => $tgl_rev_dn,
            'tgl_rev_dt' => $tgl_rev_dt
        );

        $this->load->view('ketua_tim/anggaran_waktu/form_rev_anggaran_waktu', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {
            $id = base64_encode($this->input->post('id_agr'));
            $this->anggaran_waktu_m->reviu_anggaran_waktu();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Anggaran Waktu Berhasil Diubah!
								</strong>
								Data alokasi anggaran waktu telah diubah, cek data tersebut di bawah ini.
							</p>
						</div>"
            );

            redirect('ketua_tim/anggaran_waktu/detail_anggaran_waktu/' . $id);
        }
    }

    //--> cetak anggaran waktu
    public function cetak_anggaran_waktu($id_agr) {
        $pdf = $this->pdf->load_surat();

        $key = base64_decode($id_agr);

        $data_agr = $this->anggaran_waktu_m->get_row_anggaran_waktu($key);

        //--> tgl pembuatan anggaran waktu
        $tgl_agr = date('d', strtotime($data_agr->tgl_agr)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_agr))) . " " .
                date('Y', strtotime($data_agr->tgl_agr));

        $tgl_dn = date('d', strtotime($data_agr->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_dalnis))) . " " .
                date('Y', strtotime($data_agr->tgl_dalnis));

        $tgl_dt = date('d', strtotime($data_agr->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_daltu))) . " " .
                date('Y', strtotime($data_agr->tgl_daltu));

        //--> tgl persiapan, pelaksanaan, dan penyelesaian
        $tgl1_persiapan = date('d', strtotime($data_agr->tgl1_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_persiapan))) . " " .
                date('Y', strtotime($data_agr->tgl1_persiapan));
        $tgl2_persiapan = date('d', strtotime($data_agr->tgl2_persiapan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_persiapan))) . " " .
                date('Y', strtotime($data_agr->tgl2_persiapan));

        $tgl1_pelaksanaan = date('d', strtotime($data_agr->tgl1_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->tgl1_pelaksanaan));
        $tgl2_pelaksanaan = date('d', strtotime($data_agr->tgl2_pelaksanaan)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_pelaksanaan))) . " " .
                date('Y', strtotime($data_agr->tgl2_pelaksanaan));

        $tgl1_penyelesaian = date('d', strtotime($data_agr->tgl1_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl1_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->tgl1_penyelesaian));
        $tgl2_penyelesaian = date('d', strtotime($data_agr->tgl2_penyelesaian)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl2_penyelesaian))) . " " .
                date('Y', strtotime($data_agr->tgl2_penyelesaian));

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->ketua_tim))->row();

        $data = array(
            'data' => $data_agr,
            'anggaran' => $this->anggaran_waktu_m->get_sub_anggaran_waktu($key),
            'tgl_agr' => $tgl_agr,
            'tgl_dn' => $tgl_dn,
            'tgl_dt' => $tgl_dt,
            'tgl1_1' => $tgl1_persiapan,
            'tgl2_1' => $tgl2_persiapan,
            'tgl1_2' => $tgl1_pelaksanaan,
            'tgl2_2' => $tgl2_pelaksanaan,
            'tgl1_3' => $tgl1_penyelesaian,
            'tgl2_3' => $tgl2_penyelesaian,
            'daltu_tim' => $daltu,
            'dalnis_tim' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'addPage' => $pdf->AddPage()
        );
        //$this->load->view('ketua_tim/anggaran_waktu/cetak_anggaran_waktu', $data);

        $html = $this->load->view('ketua_tim/anggaran_waktu/cetak_anggaran_waktu', $data, TRUE);
        //--> render the view into HTML
        $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
        $output = 'Anggaran_Waktu_' . $key . '_.pdf';
        $pdf->Output($output, 'I');
    }

    //--> cetak kartu penugasan
    public function cetak_kartu_penugasan($id_agr) {
        $pdf = $this->pdf->load_surat();

        $key = base64_decode($id_agr);

        $data_agr = $this->anggaran_waktu_m->get_row_anggaran_waktu($key);

        //--> tgl pembuatan anggaran waktu
        $tgl_agr = date('d', strtotime($data_agr->tgl_agr)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_agr))) . " " .
                date('Y', strtotime($data_agr->tgl_agr));

        $tgl_dn = date('d', strtotime($data_agr->tgl_dalnis)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_dalnis))) . " " .
                date('Y', strtotime($data_agr->tgl_dalnis));

        $tgl_dt = date('d', strtotime($data_agr->tgl_daltu)) . " " .
                get_nama_bulan(date('m', strtotime($data_agr->tgl_daltu))) . " " .
                date('Y', strtotime($data_agr->tgl_daltu));

        $cek = $this->db->get_where('tb_surat', array('fk_tim' => $data_agr->id_tim))->row();
        $tgl_surat = date('d', strtotime($cek->tgl_surat)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_surat))) . " " .
                date('Y', strtotime($cek->tgl_surat));

        $tgl_awal = date('d', strtotime($cek->tgl_awal)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_awal))) . " " .
                date('Y', strtotime($cek->tgl_awal));

        $tgl_akhir = date('d', strtotime($cek->tgl_akhir)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) . " " .
                date('Y', strtotime($cek->tgl_akhir));

        $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->daltu))->row();
        $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->dalnis))->row();
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_agr->ketua_tim))->row();

        $data = array(
            'data' => $data_agr,
            'anggaran' => $this->anggaran_waktu_m->get_sub_anggaran_waktu($key),
            'tgl_agr' => $tgl_agr,
            'tgl_dn' => $tgl_dn,
            'tgl_dt' => $tgl_dt,
            'daltu_tim' => $daltu,
            'dalnis_tim' => $dalnis,
            'ketua_tim' => $ketua_tim,
            'anggota_tim' => $this->tim_m->get_sub_tim($data_agr->id_tim),
            'tgl_surat' => $tgl_surat,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'addPage' => $pdf->AddPage()
        );
        //$this->load->view('ketua_tim/anggaran_waktu/cetak_kartu_penugasan', $data);

        $html = $this->load->view('ketua_tim/anggaran_waktu/cetak_kartu_penugasan', $data, TRUE);
        //--> render the view into HTML
        $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
        $output = 'Kartu_Penugasan_' . $key . '_.pdf';
        $pdf->Output($output, 'I');
    }

    public function reset_anggaran_waktu() {
        $kode = $_POST['waktu'];
        $tugas = $_POST['tugas'];

//        $data1 = array(
//            'tugas_daltu' => 'nonaktif',
//            'hari_daltu' => NULL,
//            'jam_daltu' => NULL,
//            'tugas_dalnis' => 'nonaktif',
//            'hari_dalnis' => NULL,
//            'jam_dalnis' => NULL,
//            'tugas_ketua' => 'nonaktif',
//            'hari_ketua' => NULL,
//            'jam_ketua' => NULL,
//            'tugas_anggota' => 'nonaktif',
//            'hari_anggota' => NULL,
//            'jam_anggota' => NULL,
//            'jml_hari' => NULL,
//            'jml_jam' => NULL
//        );
//        $this->db->update('sub_anggaran_waktu', $data1, array('sub_anggaran_wkt' => $kode));
//        $data2 = array(
//            'tgl1_persiapan' => NULL,
//            'tgl2_persiapan' => NULL,
//            'tgl1_pelaksanaan' => NULL,
//            'tgl2_pelaksanaan' => NULL,
//            'tgl1_penyelesaian' => NULL,
//            'tgl2_penyelesaian' => NULL,
//            'tgl_dalnis' => NULL,
//            'tgl_daltu' => NULL,
//            'reviu_dalnis' => NULL,
//            'reviu_daltu' => NULL,
//            'keputusan_agr' => 'belum'
//        );
//        $this->db->update('tb_anggaran_waktu', $data2, array('id_anggaran_wkt' => $kode));

        $this->db->delete('sub_anggaran_waktu', array('sub_anggaran_wkt' => $kode));
        $this->db->delete('rev_anggaran_waktu1', array('rev_agr1' => $kode));
        $this->db->delete('rev_anggaran_waktu2', array('rev_agr2' => $kode));
        $this->db->delete('tb_anggaran_waktu', array('id_anggaran_wkt' => $kode));
        $this->db->update('notifikasi', array('notif_ketua_tim' => 'baru'), array('id_terkait' => $tugas));
        $this->db->update('tb_penugasan', array('fk_agr' => NULL,'fk_pka' => NULL,), array('id_tugas' => $tugas));
        $id_pka = $this->anggaran_waktu_m->get_id_pka($tugas);
        $this->db->delete('sub_pka1',array('sub_pka1'=>$id_pka));
        $this->db->delete('sub_pka2',array('sub_pka2'=>$id_pka));
        $this->db->delete('sub_pka3',array('sub_pka3'=>$id_pka));
        $this->db->delete('tb_pka', array('id_tgs' => $tugas));        
        echo json_encode(array('status' => TRUE));
    }

}

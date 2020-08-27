<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tindak_lanjut extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model');
        $this->auth->cek_auth(); //--> ambil auth dari library
        //--> load model
        $this->load->model('notifikasi_m');
        $this->load->model('staff/tindak_lanjut_m');
        $this->load->model('staff/penugasan_m');
        $this->load->model('staff/tim_m');
        $this->load->model('staff/surat_m');
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

    //--> list penugasan
    public function index() {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Tindak Lanjut [KETUA TIM TL]',
            'tl' => $this->tindak_lanjut_m->get_tugas_kt($kt->id_pegawai)
        );

        $this->load->view('ketua_tim/tindak_lanjut/list_tl', $data);
    }

    //--> detail penugasan
    public function detail_tl($id_tl, $id_tim) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $key = base64_decode($id_tl);
        $key2 = base64_decode($id_tim);

        //-> update notif penugasan
        //$this->notifikasi_m->update_notif_staff($key);

        $cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

        $tgl_tl = date('d', strtotime($cek->tgl_tl)) . " " .
                get_nama_bulan(date('m', strtotime($cek->tgl_tl))) . " " .
                date('Y', strtotime($cek->tgl_tl));

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

        $penugasan = $this->tindak_lanjut_m->get_row_tl($key);
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();
        $jml_sas = $this->tim_m->get_jum_sasaran($key2);

        if ($jml_sas->jml != 0) {
            $get_lhp = $this->tindak_lanjut_m->get_lhp($cek->fk_tgs);
        } else {
            $get_lhp = $this->tindak_lanjut_m->get_row_lhp($cek->fk_tgs);
        }

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Tindak Lanjut [KETUA TIM TL]',
            'data' => $penugasan,
            'ketua_tim' => $ketua_tim,
            'tgl_tl' => $tgl_tl,
            'tgl_surat' => $tgl_surat,
            'tgl_awal' => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'tim' => $this->tim_m->get_sub_tim($key2),
            'jml_sas' => $jml_sas,
            'lhp' => $get_lhp,
            'cek_tl1' => $this->tindak_lanjut_m->cek_sub_tl1($key)
        );

        $this->load->view('ketua_tim/tindak_lanjut/detail_tl', $data);
    }

    //--> detail penugasan
    public function detail_tugas_tl($id_tl, $no_lhp) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $key = base64_decode($id_tl);
        $key2 = base64_decode($no_lhp);

        $data_tl = $this->tindak_lanjut_m->get_sub_row_tl1($key, $key2);

        $tgl_tl = date('d', strtotime($data_tl->tgl_tl1)) . " " .
                get_nama_bulan(date('m', strtotime($data_tl->tgl_tl1))) . " " .
                date('Y', strtotime($data_tl->tgl_tl1));

        $tgl_lhp = date('d', strtotime($data_tl->tgl_lhp)) . " " .
                get_nama_bulan(date('m', strtotime($data_tl->tgl_lhp))) . " " .
                date('Y', strtotime($data_tl->tgl_lhp));

        $data = array(
            'user' => $get_akun,
            'level' => $get_akun,
            'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
            'notif' => $this->notifikasi_m->notif_staff(),
            'title' => 'Tindak Lanjut [KETUA TIM TL]',
            'data' => $data_tl,
            'tgl_tl' => $tgl_tl,
            'tgl_lhp' => $tgl_lhp,
            'sub_tl2' => $this->tindak_lanjut_m->get_sub_tl2($key, $key2),
            'kat_fix' => $this->tindak_lanjut_m->get_sub_tl2_kat_fix($key, $key2)
        );

        $this->load->view('ketua_tim/tindak_lanjut/detail_tugas_tl', $data);
    }

    function download_lhp($file) {
        $nmfile = base64_decode($file);
        force_download('assets/lhp/' . $nmfile, NULL);
    }

    //--> tambah tindak lanjut
    public function tambah_tl($no_lhp) {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));
        $key2 = base64_decode($no_lhp);

        $data = $this->tindak_lanjut_m->get_row_lhp3($key2);

        $data = array(
            'user'          => $get_akun,
            'level'         => $get_akun,
            'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr'  => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr'      => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka'  => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka'      => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title'         => 'TAMBAH TEMUAN [KETUA TIM]',
            'data'          => $data,
        );

        $this->load->view('ketua_tim/tindak_lanjut/form_tambah_tl1', $data);

        //--> jika form submit
        if ($this->input->post('submit')) {

            //print "<pre>"; print_r($_POST); die;

            /*$key2 = base64_encode($this->input->post('no_lhp'));*/

            $this->tindak_lanjut_m->insert_temuan_ketua_tim();

            //--> Tampilkan notifikasi berhasil ubah
            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
    				<button type='button' class='close' data-dismiss='alert'>
						<i class='ace-icon fa fa-times'></i>
					</button>

					<p>
						<strong>
							<i class='ace-icon fa fa-check'></i>
							Berhasil Tambah Tindak Lanjut!
						</strong>
						Data tindak lanjut telah ditambahkan, cek data tersebut di bawah ini.
					</p>
				</div>"
            );

            /*redirect('ketua_tim/tindak_lanjut/detail_tugas_tl/' . $key . '/' . $key2);*/

            redirect('ketua_tim/p2hp_lhp');
        }
    }


    public function detail_temuan($id_temuan)
    {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user'          => $get_akun,
            'level'         => $get_akun,
            'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'jml_notifAgr'  => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
            'notifAgr'      => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
            'jml_notifPka'  => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
            'notifPka'      => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
            'title'         => 'DETAIL TEMUAN [KETUA TIM]',

            'kt101'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '101'),
            'kt102'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '102'),
            'kt103'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '103'),
            'kt104'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '104'),
            'kt105'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '105'),
            'kt201'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '201'),
            'kt202'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '202'),
            'kt203'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '203'),
            'kt301'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '301'),
            'kt302'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '302'),
            'kt303'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '303'),

            'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($id_temuan),
            'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'spi'),
            'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'e3'),
            'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'kepatuhan'),

            'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '1'),
            'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '2'),
            'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '3'),
            'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '0'),

            'temuan'        => $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
            'aspek'         => $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
        );

        //print "<pre>"; print_r($data); die;

        //print "<pre>"; print_r($this->tindak_lanjut_m->get_lhp($kt->id_pegawai)); die;

        $this->load->view('ketua_tim/tindak_lanjut/detail_temuan', $data);
    }

    public function get_status()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
        );

        $this->load->view('ketua_tim/tindak_lanjut/get_status', $data);
    }


    public function get_upload()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
            'data_upload' => $this->tindak_lanjut_m->get_rekomendasi_upload($id_temuan_rekomendasi),
        );

        $this->load->view('ketua_tim/tindak_lanjut/get_upload', $data);
    }
    
    public function cetak_temuan($id_temuan)
    {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user'          => $get_akun,
            'level'         => $get_akun,
            'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'title'         => 'Detail Temuan [Staff Evaluasi dan Pelaporan]',

            'kt101'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '101'),
            'kt102'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '102'),
            'kt103'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '103'),
            'kt104'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '104'),
            'kt105'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '105'),
            'kt201'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '201'),
            'kt202'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '202'),
            'kt203'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '203'),
            'kt301'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '301'),
            'kt302'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '302'),
            'kt303'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '303'),

            'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($id_temuan),
            'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'spi'),
            'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'e3'),
            'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'kepatuhan'),

            'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '1'),
            'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '2'),
            'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '3'),
            'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '0'),

            'temuan'        => $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
            'aspek'         => $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
        );


        $pdf = $this->pdf->load_landscape();
        
        $html = $this->load->view('evlap/temuan/cetak_temuan', $data, TRUE);
        //--> render the view into HTML
        $pdf->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            8, // margin_left
            8, // margin right
            5, // margin top
            5, // margin bottom
            9, // margin header
            9); // margin footer
        $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
        $output = 'Temuan_'. $id_temuan .'_.pdf';
        $pdf->Output("$output", 'I');
    }
    
    
}

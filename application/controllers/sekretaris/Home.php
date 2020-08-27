<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		$this->load->model('notifikasi_m');
		$this->load->model('pegawai_m');
		$this->load->model('staff/tindak_lanjut_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='sekretaris')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
			'user'   		=> $get_akun,
	        'level'	 		=> $get_akun,
	        'jml_notif' => $this->notifikasi_m->jml_notif_sekretaris(),
	        'notif'		 	=> $this->notifikasi_m->notif_sekretaris(),
	        'title'			=> 'Home [SEKRETARIS]',

			'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml_2(),
			'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek_2('spi'),
			'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek_2('e3'),
			'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek_2('kepatuhan'),

			'lhp_bpk'    => $this->tindak_lanjut_m->get_count_kategori_lhp('LHP BPK'),
			'lhp_bpkp' => $this->tindak_lanjut_m->get_count_kategori_lhp('LHP BPKP'),
			'lhp_apip_kementerian'  => $this->tindak_lanjut_m->get_count_kategori_lhp('LHP APIP Kementerian'),
			'lhp_apip_provinsi' => $this->tindak_lanjut_m->get_count_kategori_lhp('LHP APIP Provinsi'),
			'lhp_apip_kota_pariaman' => $this->tindak_lanjut_m->get_count_kategori_lhp('LHP APIP Kota Pariaman'),

			'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl_2('1'),
			'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl_2('2'),
			'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl_2('3'),
			'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl_2('0'),
			);

		$this->load->view('sekretaris/home', $data);
	}

	public function profil($user)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($user);
		$get_row_pegawai = $this->pegawai_m->get_profil_pegawai($key);

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_sekretaris(),
				'notif'     => $this->notifikasi_m->notif_sekretaris(),
				'title'     => 'Setting [SEKRETARIS]',
				'pegawai'   => $get_row_pegawai
			);

		$this->load->view('sekretaris/profil', $data);
	}

	public function setting_ubah($id_pegawai)
	{
		//-> ambil username yang sedang login
    $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

    $key = base64_decode($id_pegawai);
		$this->pegawai_m->update_pegawai_login($key);

		redirect('log_in/logout');
	}
}

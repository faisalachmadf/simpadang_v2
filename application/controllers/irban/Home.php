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

		//--> hak akses
		$hak_akses = $this->session->userdata('jbtn');
		if($hak_akses!='irban')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'), $this->session->userdata('jenis_jabatan'));
		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));
		$data = array(
			'user'   		=> $get_akun,
			'level'	 		=> $get_akun,
			'jenis_jabatan'	 => $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
			'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
			'notifAgr'     => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
			'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
			'notifPka'     => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
			'notif'		 	=> $this->notifikasi_m->notif_adum(),
			'title'			=> 'Home [IRBAN]pkpt'
		);

		$this->load->view('irban/home', $data);
	}
	
	public function profil($user)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'), $this->session->userdata('jenis_jabatan'));

		$key = base64_decode($user);
		$get_row_pegawai = $this->pegawai_m->get_profil_pegawai($key);

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jenis_jabatan'	 => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
				'notif'     => $this->notifikasi_m->notif_adum(),
				'title'     => 'Setting [ADUM]pkpt',
				'pegawai'   => $get_row_pegawai
			);

		$this->load->view('adum/profil', $data);
	}

	public function setting_ubah($id_pegawai)
	{
		//-> ambil username yang sedang login
    $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'), $this->session->userdata('jenis_jabatan'));

    $key = base64_decode($id_pegawai);
		$this->pegawai_m->update_pegawai_login($key);

		redirect('log_in/logout');
	}
}

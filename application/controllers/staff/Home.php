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
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='staff')
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
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'			=> 'Home [STAFF ADMINISTRASI]'
			);

		$this->load->view('staff/home', $data);
	}

   

	public function profil($user)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($user);
		$get_row_pegawai = $this->pegawai_m->get_profil_pegawai($key);

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
				'notif'     => $this->notifikasi_m->notif_staff(),
				'title'     => 'Setting [STAFF ADMINISTRASI]',
				'pegawai'   => $get_row_pegawai
			);

		$this->load->view('staff/profil', $data);
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

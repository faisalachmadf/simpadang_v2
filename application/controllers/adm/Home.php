<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->load->model('pegawai_m');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='adm')
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
		$data = array(
				'user'   	=> $get_akun,
        'level'	 	=> $get_akun,
        'jenis_jabatan'	=> $get_akun,
        'title'		=> 'Home [ADMIN]'
		);

		$this->load->view('adm/home', $data);
	}

	public function profil($user)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'), $this->session->userdata('jenis_jabatan'));

		$key = base64_decode($user);
		$get_row_pegawai = $this->pegawai_m->get_profil_admin($key);

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jenis_jabatan'	=> $get_akun,
				'title'     => 'Setting [ADMIN]',
				'pegawai'   => $get_row_pegawai
			);

		$this->load->view('adm/profil', $data);
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

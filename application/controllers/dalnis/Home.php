<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('pegawai_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='dalnis')
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
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Home [DALNIS]'
		);

		$this->load->view('dalnis/home', $data);
	}

	public function profil($user)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));
		
		$key = base64_decode($user);
		$get_row_pegawai = $this->pegawai_m->get_profil_pegawai($key);

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Setting [DALNIS]',
				'pegawai'      => $get_row_pegawai
			);

		$this->load->view('dalnis/profil', $data);
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

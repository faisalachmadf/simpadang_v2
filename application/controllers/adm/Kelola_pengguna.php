<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelola_pengguna extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library
		//$this->load->library('smsGateway');

		//--> load model
		$this->load->model('adm/pengguna_m');
		$this->load->model('adm/pengaturan_m');

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

	//--> data pengguna
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
			'user'     => $get_akun,
			'level'	   => $get_akun,
			'title'		 => 'Kelola Pengguna [ADMIN]',
			'pengguna' => $this->pengguna_m->get_all_pengguna()
		);

		$this->load->view('adm/pengguna/list_pengguna', $data);
	}

	//--> data pengguna NON-AKTIF
	public function list_nonaktif()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
			'user'     => $get_akun,
			'level'	   => $get_akun,
			'title'		 => 'Kelola Pengguna [ADMIN]',
			'pengguna' => $this->pengguna_m->get_all_pengguna_nonaktif()
		);

		$this->load->view('adm/pengguna/list_pengguna_nonaktif', $data);
	}

	//--> cek username
	public function cek_username()
	{
		$modul = $this->input->post('modul');
		$user  = $this->input->post('id');

		if($modul == "user")
		{
			echo $this->pengguna_m->cek_username($user);
		}
	}

	//--> pengguna pengguna
	public function detail_pengguna($id_pengguna)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'), $this->session->userdata('jenis_jabatan'));

		$key = base64_decode($id_pengguna);

		$data = array(
			'user'  => $get_akun,
			'level'	=> $get_akun,
			'jenis_jabatan'	=> $get_akun,
			'title'	=> 'Kelola Pengguna [ADMIN]',
			'data' 	=> $this->pengguna_m->get_row_pengguna($key)
		);

		$this->load->view('adm/pengguna/detail_pengguna', $data);
	}

	//--> tambah pengguna
	public function tambah_pengguna()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$get_id_max 	= $this->pengguna_m->get_id_max_pgn();
		$get_gol 			= $this->pengaturan_m->get_gol();
		$data = array(
			'user'    	 => $get_akun,
			'level'	  	 => $get_akun,
			'title'			 => 'Kelola Pengguna [ADMIN]',
			'id_max_pgn' => $get_id_max,
			'gol'				 => $get_gol
		);

		$this->load->view('adm/pengguna/form_tambah_pengguna', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$id = base64_encode($this->input->post('id_pegawai'));
			$this->pengguna_m->insert_pengguna();
			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
				"<div class='alert alert-block alert-success'>
				<button type='button' class='close' data-dismiss='alert'>
				<i class='ace-icon fa fa-times'></i>
				</button>

				<p>
				<strong>
				<i class='ace-icon fa fa-check'></i>
				Berhasil Tambah Pengguna!
				</strong>
				Data pengguna telah ditambahkan, cek data tersebut di bawah ini.
				</p>
				</div>"
			);

			redirect('adm/kelola_pengguna/detail_pengguna/'.$id);
		}
	}

	//--> ubah pengguna
	public function ubah_pengguna($id_pengguna)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$id = base64_decode($id_pengguna);
		$get_pengguna = $this->pengguna_m->get_row_pengguna($id);
		$get_gol 			= $this->pengaturan_m->get_gol();
		$get_jbtn_tim	= $this->pengaturan_m->get_jbtn_tim();

		$data = array(
			'user'     => $get_akun,
			'level'	   => $get_akun,
			'title'		 => 'Kelola Pengguna [ADMIN]',
			'data' 		 => $get_pengguna,
			'gol'			 => $get_gol,
			'jbtn_tim' => $get_jbtn_tim
		);

		$this->load->view('adm/pengguna/form_ubah_pengguna', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->pengguna_m->update_pengguna($id);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
				"<div class='alert alert-block alert-success'>
				<button type='button' class='close' data-dismiss='alert'>
				<i class='ace-icon fa fa-times'></i>
				</button>

				<p>
				<strong>
				<i class='ace-icon fa fa-check'></i>
				Berhasil Ubah!
				</strong>
				Data pengguna telah di ubah, cek data di bawah ini.
				</p>
				</div>"
			);

			redirect('adm/kelola_pengguna/detail_pengguna/'.$id_pengguna);
		}
	}

	//--> non-aktifkan pengguna
	public function nonaktif_pengguna($id_pengguna)
	{
		$id = base64_decode($id_pengguna);
		$this->pengguna_m->nonaktif_pengguna($id);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
			"<div class='alert alert-block alert-success'>
			<button type='button' class='close' data-dismiss='alert'>
			<i class='ace-icon fa fa-times'></i>
			</button>

			<p>
			<strong>
			<i class='ace-icon fa fa-check'></i>
			Berhasil Menon-aktifkan Akun!
			</strong>
			Data pengguna telah di non-aktifkan dari sistem
			</p>
			</div>"
		);

		redirect('adm/kelola_pengguna/list_nonaktif');
	}

	//--> aktifkan pengguna
	public function aktif_pengguna($id_pengguna)
	{
		$id = base64_decode($id_pengguna);
		$this->pengguna_m->aktif_pengguna($id);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
			"<div class='alert alert-block alert-success'>
			<button type='button' class='close' data-dismiss='alert'>
			<i class='ace-icon fa fa-times'></i>
			</button>

			<p>
			<strong>
			<i class='ace-icon fa fa-check'></i>
			Berhasil Mengktifkan Akun!
			</strong>
			Data pengguna telah di aktifkan dari sistem
			</p>
			</div>"
		);

		redirect('adm/kelola_pengguna');
	}

}
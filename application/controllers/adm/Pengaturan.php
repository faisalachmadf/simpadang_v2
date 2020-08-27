<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
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

	##############################################################
	//****************** SET GOLONGAN PEGAWAI ******************\\
	##############################################################

	//--> list golongan
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'  => $get_akun,
        'level'	=> $get_akun,
        'title'	=> 'Pengaturan [ADMIN]',
				'gol'		=> $this->pengaturan_m->get_gol(),
				'jbtn'	=> $this->pengaturan_m->get_jbtn()
			);

		$this->load->view('adm/pengaturan/list_gol_jbtn', $data);
	}

	//--> tambah golongan
	public function tambah_gol()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'     	=> $get_akun,
        'level'	   	=> $get_akun,
        'title'	=> 'Pengaturan [ADMIN]'
			);

		$this->load->view('adm/pengaturan/form_tambah_gol', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->pengaturan_m->insert_gol();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Golongan!
								</strong>
								Golongan telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adm/pengaturan');
		}
	}

	//--> ubah golongan
	public function ubah_gol($id)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$key = base64_decode($id);

		$data = array(
				'user'  => $get_akun,
        'level'	=> $get_akun,
        'title'	=> 'Pengaturan [ADMIN]',
				'data'	=> $this->pengaturan_m->get_row_gol($key)
			);

		$this->load->view('adm/pengaturan/form_ubah_gol', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->pengaturan_m->update_gol($key);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah Golongan!
								</strong>
								Golongan telah diubah, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adm/pengaturan');
		}
	}

	//--> hapus golongan
	public function hapus_gol($id)
	{
		$key = base64_decode($id);
		$this->pengaturan_m->delete_set($key);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Hapus!
							</strong>
							Golongan telah di hapus dari sistem secara permanen
						</p>
					</div>"
			);

		redirect('adm/pengaturan');
	}


	#############################################################
	//****************** SET JABATAN PEGAWAI ******************\\
	#############################################################

	//--> tambah jabatan
	public function tambah_jbt()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'     	=> $get_akun,
        'level'	   	=> $get_akun,
        'title'	    => 'Pengaturan [ADMIN]'
			);

		$this->load->view('adm/pengaturan/form_tambah_jbt', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->pengaturan_m->insert_jbt();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Jabatan!
								</strong>
								Jabatan telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adm/pengaturan');
		}
	}

	//--> ubah jabatan
	public function ubah_jbt($id)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$key = base64_decode($id);

		$data = array(
				'user'  => $get_akun,
        'level'	=> $get_akun,
        'title'	=> 'Pengaturan [ADMIN]',
				'data'	=> $this->pengaturan_m->get_row_jbt($key)
			);

		$this->load->view('adm/pengaturan/form_ubah_jbt', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->pengaturan_m->update_jbt($key);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah Jabatan!
								</strong>
								Jabatan telah diubah, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adm/pengaturan');
		}
	}

	//--> hapus jabatan
	public function hapus_jbt($id)
	{
		$key = base64_decode($id);
		$this->pengaturan_m->delete_set($key);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Hapus!
							</strong>
							Jabatan telah di hapus dari sistem secara permanen
						</p>
					</div>"
			);

		redirect('adm/pengaturan');
	}

	######################################################
	//*************** BATAS SET JABATAN ***************\\
	######################################################

}
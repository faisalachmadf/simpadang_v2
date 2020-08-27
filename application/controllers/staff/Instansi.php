<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/instansi_m');

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

	//--> data instansi
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'     	=> $get_akun,
				'level'    	=> $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		 	=> $this->notifikasi_m->notif_staff(),
				'title'    	=> 'Instansi [STAFF ADMINISTRASI]',
				'instansi' 	=> $this->instansi_m->get_all_instansi()
			);

		$this->load->view('staff/instansi/list_instansi', $data);
	}

	public function detail_instansi()
	{
		$id_instansi = $this->input->post('id');

		$data['kecamatan'] = $this->instansi_m->get_row_kecamatan($id_instansi);
		$data['desa']      = $this->instansi_m->get_detail_desa($id_instansi);
		$this->load->view('staff/instansi/detail_instansi', $data);
	}

	//--> tambah kecamatan
	public function tambah_kecamatan()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'    	=> $get_akun,
        'level'	  	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'   	=> 'Instansi [STAFF ADMINISTRASI]',
				'id_ins'  	=> $this->instansi_m->get_id_max_ins()
			);

		$this->load->view('staff/instansi/form_tambah_kecamatan', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->instansi_m->insert_kecamatan();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Kecamatan!
								</strong>
								Data instansi telah di tambahkan, cek data di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/instansi');
		}
	}

	//--> tambah desa
	public function tambah_desa()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'    	=> $get_akun,
        'level'	  	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'   	=> 'Instansi [STAFF ADMINISTRASI]',
				'kecamatan' => $this->instansi_m->get_all_instansi()
			);

		$this->load->view('staff/instansi/form_tambah_desa', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->instansi_m->insert_desa();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Instansi!
								</strong>
								Data instansi telah di tambahkan, cek data di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/instansi');
		}
	}

	//--> ubah instansi kecamatan
	public function ubah_kecamatan($id)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($id);

		$get_desa = $this->instansi_m->get_row_kecamatan($key);
		$data = array(
				'user'    	=> $get_akun,
        'level'	  	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'   	=> 'Instansi [STAFF ADMINISTRASI]',
				'data' 			=> $get_desa
			);

		$this->load->view('staff/instansi/form_ubah_kecamatan', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->instansi_m->update_kecamatan($key);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah Nama Kecamatan!
								</strong>
								Data kecamatan telah di ubah, cek data di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/instansi');
		}
	}

	//--> ubah instansi desa
	public function ubah_desa($id, $id2)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key1 = base64_decode($id);
		$key2 = base64_decode($id2);

		$get_desa = $this->instansi_m->get_row_desa($key1, $key2);
		$data = array(
				'user'    	=> $get_akun,
        'level'	  	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
        'title'   	=> 'Instansi [STAFF ADMINISTRASI]',
				'data' 			=> $get_desa
			);

		$this->load->view('staff/instansi/form_ubah_desa', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->instansi_m->update_desa($key1, $key2);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah Nama Instansi!
								</strong>
								Data instansi telah di ubah, cek data di bawah ini.
							</p>
						</div>"
				);

			redirect('staff/instansi');
		}
	}

	//--> hapus instansi kecamatan
	public function hapus_kecamatan($id)
	{
		$key = base64_decode($id);

		$this->instansi_m->delete_kecamatan($key);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Hapus Kecamatan!
							</strong>
							Data kecamatan telah di hapus beserta instansi-instansi yang terkait dengan kecamatan tersebut dari sistem secara permanen.
						</p>
					</div>"
			);

		redirect('staff/instansi');
	}

	//--> hapus instansi desa
	public function hapus_desa($id)
	{
		$key = base64_decode($id);

		$this->instansi_m->delete_desa($key);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Hapus Instansi!
							</strong>
							Data instansi telah di hapus dari sistem secara permanen.
						</p>
					</div>"
			);

		redirect('staff/instansi');
	}

}
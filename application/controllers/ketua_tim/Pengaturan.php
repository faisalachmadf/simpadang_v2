<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('ketua_tim/anggaran_waktu_m');
		/*$this->load->model('irban/penugasan_m');
		$this->load->model('adum/tim_m');
		$this->load->model('adum/pegawai_m');*/

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='ketua_tim')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	##############################################################
	//*************** SET ALOKASI ANGGARAN WAKTU ***************\\
	##############################################################

	//--> list anggaran waktu
	public function list_anggaran_waktu()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
				'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
				'notifAgr'     => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
				'title'        => 'Pengaturan [KETUA TIM]',
				'anggaran'     => $this->anggaran_waktu_m->get_set_anggaran()
			);

		$this->load->view('ketua_tim/pengaturan/anggaran_waktu/list_anggaran_waktu', $data);
	}

	//--> tambah anggaran waktu
	public function tambah_anggaran_waktu()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
				'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
				'notifAgr'     => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
				'title'        => 'Pengaturan [KETUA TIM]',
				//'anggaran'   => $this->anggaran_waktu_m->get_anggaran()
			);

		$this->load->view('ketua_tim/pengaturan/anggaran_waktu/form_tambah_agr_wkt', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->anggaran_waktu_m->insert_set_anggaran();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah Jenis Pekerjaan!
								</strong>
								Jenis Pekerjaan telah ditambahkan, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('ketua_tim/pengaturan/list_anggaran_waktu');
		}
	}

	//--> ubah anggaran waktu
	public function ubah_anggaran_waktu($id_agr)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));
		
		$key = base64_decode($id_agr);

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
				'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
				'notifAgr'     => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
				'title'        => 'Pengaturan [KETUA TIM]',
				'data'         => $this->anggaran_waktu_m->get_row_set_anggaran($key)
			);

		$this->load->view('ketua_tim/pengaturan/anggaran_waktu/form_ubah_agr_wkt', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->anggaran_waktu_m->update_set_anggaran($key);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah Jenis Pekerjaan!
								</strong>
								Jenis Pekerjaan telah diubah, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('ketua_tim/pengaturan/list_anggaran_waktu');
		}
	}

	//--> hapus anggaran waktu
	public function hapus_anggaran_waktu($id_agr)
	{
		$key = base64_decode($id_agr);
		$this->anggaran_waktu_m->delete_set_anggaran($key);

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
							Jenis pekerjaan telah di hapus dari sistem secara permanen
						</p>
					</div>"
			);

		redirect('ketua_tim/pengaturan/list_anggaran_waktu');
	}

	####################################################################
	//*************** BATAS SET ALOKASI ANGGARAN WAKTU ***************\\
	####################################################################
}
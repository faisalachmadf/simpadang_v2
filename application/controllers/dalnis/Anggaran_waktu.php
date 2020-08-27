<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_waktu extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('ketua_tim/anggaran_waktu_m');

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

	//--> list pengawasan
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
				'title'        => 'Anggaran Waktu [DALNIS]',
				'agr'          => $this->anggaran_waktu_m->get_anggaran_waktu_dn($dn->id_pegawai)
			);

		$this->load->view('dalnis/anggaran_waktu/list_anggaran_waktu', $data);
	}

	//--> detail penugasan
	public function detail_anggaran_waktu($id_agr)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));

		$key = base64_decode($id_agr);

		//-> update notif penugasan
		$this->notifikasi_m->update_notif_dalnis($key);

		$data_agr  = $this->anggaran_waktu_m->get_row_anggaran_waktu($key);
		
		//--> tgl persiapan, pelaksanaan, dan penyelesaian
		$tgl1_persiapan = date('d', strtotime($data_agr->tgl1_persiapan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl1_persiapan))) ." ".
							 date('Y', strtotime($data_agr->tgl1_persiapan));
		$tgl2_persiapan = date('d', strtotime($data_agr->tgl2_persiapan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl2_persiapan))) ." ".
							 date('Y', strtotime($data_agr->tgl2_persiapan));

		$tgl1_pelaksanaan = date('d', strtotime($data_agr->tgl1_pelaksanaan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl1_pelaksanaan))) ." ".
							 date('Y', strtotime($data_agr->tgl1_pelaksanaan));
		$tgl2_pelaksanaan = date('d', strtotime($data_agr->tgl2_pelaksanaan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl2_pelaksanaan))) ." ".
							 date('Y', strtotime($data_agr->tgl2_pelaksanaan));

		$tgl1_penyelesaian = date('d', strtotime($data_agr->tgl1_penyelesaian)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl1_penyelesaian))) ." ".
							 date('Y', strtotime($data_agr->tgl1_penyelesaian));
		$tgl2_penyelesaian = date('d', strtotime($data_agr->tgl2_penyelesaian)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl2_penyelesaian))) ." ".
							 date('Y', strtotime($data_agr->tgl2_penyelesaian));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Anggaran Waktu [DALNIS]',
				'data'         => $data_agr,
				'anggaran'     => $this->anggaran_waktu_m->get_sub_anggaran_waktu($key),
				'tgl1_1'       => $tgl1_persiapan,
				'tgl2_1'       => $tgl2_persiapan,
				'tgl1_2'       => $tgl1_pelaksanaan,
				'tgl2_2'       => $tgl2_pelaksanaan,
				'tgl1_3'       => $tgl1_penyelesaian,
				'tgl2_3'       => $tgl2_penyelesaian,
				'cek_rev'      => $this->anggaran_waktu_m->cek_reviu($key),
				'data_rev'     => $this->anggaran_waktu_m->get_rev_anggaran_waktu($key)
			);

		$this->load->view('dalnis/anggaran_waktu/detail_anggaran_waktu', $data);
	}

	//--> detail reviu
	public function detail_reviu($id_agr, $no_rev)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$key  = base64_decode($id_agr);
		$key2 = base64_decode($no_rev);

		$data_agr = $this->anggaran_waktu_m->get_row_rev_anggaran_waktu($key, $key2);

		$tgl_rev  = date('d', strtotime($data_agr->tgl_reviu)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl_reviu))) ." ".
							 date('Y', strtotime($data_agr->tgl_reviu)) ." | ". 
							 date('H:i:s', strtotime($data_agr->tgl_reviu));

		$tgl_rev_dn  = date('d', strtotime($data_agr->tgl_rev_dalnis)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl_rev_dalnis))) ." ".
							 date('Y', strtotime($data_agr->tgl_rev_dalnis)) ." | ". 
							 date('H:i:s', strtotime($data_agr->tgl_rev_dalnis));

		$tgl_rev_dt  = date('d', strtotime($data_agr->tgl_rev_daltu)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->tgl_rev_daltu))) ." ".
							 date('Y', strtotime($data_agr->tgl_rev_daltu)) ." | ". 
							 date('H:i:s', strtotime($data_agr->tgl_rev_daltu));
		
		//--> tgl persiapan, pelaksanaan, dan penyelesaian
		$tgl1_persiapan = date('d', strtotime($data_agr->rev_tgl1_persiapan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_persiapan))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl1_persiapan));
		$tgl2_persiapan = date('d', strtotime($data_agr->rev_tgl2_persiapan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_persiapan))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl2_persiapan));

		$tgl1_pelaksanaan = date('d', strtotime($data_agr->rev_tgl1_pelaksanaan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_pelaksanaan))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl1_pelaksanaan));
		$tgl2_pelaksanaan = date('d', strtotime($data_agr->rev_tgl2_pelaksanaan)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_pelaksanaan))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl2_pelaksanaan));

		$tgl1_penyelesaian = date('d', strtotime($data_agr->rev_tgl1_penyelesaian)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl1_penyelesaian))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl1_penyelesaian));
		$tgl2_penyelesaian = date('d', strtotime($data_agr->rev_tgl2_penyelesaian)) ." ".
							 get_nama_bulan(date('m', strtotime($data_agr->rev_tgl2_penyelesaian))) ." ".
							 date('Y', strtotime($data_agr->rev_tgl2_penyelesaian));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Anggaran Waktu [DALNIS]',
				'data'         => $data_agr,
				'anggaran'     => $this->anggaran_waktu_m->get_rev_anggaran_waktu2($key, $key2),
				'tgl_rev'      => $tgl_rev,
				'tgl_rev_dn'   => $tgl_rev_dn,
				'tgl_rev_dt'   => $tgl_rev_dt,
				'tgl1_1'       => $tgl1_persiapan,
				'tgl2_1'       => $tgl2_persiapan,
				'tgl1_2'       => $tgl1_pelaksanaan,
				'tgl2_2'       => $tgl2_pelaksanaan,
				'tgl1_3'       => $tgl1_penyelesaian,
				'tgl2_3'       => $tgl2_penyelesaian
			);

		$this->load->view('dalnis/anggaran_waktu/detail_rev_anggaran_waktu', $data);
	}

	public function persetujuan($id_agr)
	{
		$key  = base64_decode($id_agr);

		$this->anggaran_waktu_m->persetujuan_dalnis($key);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Anggaran waktu telah di reviu!
							</strong>
							Rencana anggaran waktu telah di reviu oleh Pengendali Teknis, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('dalnis/anggaran_waktu/detail_anggaran_waktu/'.$id_agr);
	}

}
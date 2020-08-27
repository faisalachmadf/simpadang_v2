<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penugasan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');
		$this->load->model('staff/surat_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='daltu')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	//--> list penugasan
	public function index()
	{
		$get_akun  = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_daltu($dt->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_daltu($dt->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_daltuPka($dt->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_daltuPka($dt->id_pegawai),
				'title'        => 'Penugasan [DALTU]',
				'tugas'        => $this->penugasan_m->get_tugas_dt($dt->id_pegawai)
			);

		$this->load->view('daltu/penugasan/list_penugasan', $data);
	}

	//--> detail penugasan
	public function detail_penugasan($id_tugas, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dt = $this->login_model->get_pegawai($this->session->userdata('username'));
		
		$key  = base64_decode($id_tugas);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		$this->notifikasi_m->update_notif_ketua($key);

		$cek = $this->db->get_where('tb_penugasan', array('id_tugas' => $key))->row();
		$tgl_tugas = date('d', strtotime($cek->tgl_penugasan)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_penugasan))) ." ".
							 date('Y', strtotime($cek->tgl_penugasan));

		$tgl_kep 	 = date('d', strtotime($cek->tgl_persetujuan)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_persetujuan))) ." ".
							 date('Y', strtotime($cek->tgl_persetujuan));

		$cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
		$tgl_surat = date('d', strtotime($cek2->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) ." ".
							 date('Y', strtotime($cek2->tgl_surat));

		$tgl_awal	 = date('d', strtotime($cek2->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) ." ".
							 date('Y', strtotime($cek2->tgl_awal));

		$tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) ." ".
							 date('Y', strtotime($cek2->tgl_akhir));


		$penugasan = $this->penugasan_m->get_row_penugasan($key);

		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu))->row();
		$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis))->row();
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_daltu($dt->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_daltu($dt->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_daltuPka($dt->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_daltuPka($dt->id_pegawai),
				'title'        => 'Penugasan [DALTU]',
				'data'         => $penugasan,
				'daltu'        => $daltu,
				'dalnis'       => $dalnis,
				'ketua_tim'    => $ketua_tim,	
				'sasaran'      => $this->tim_m->get_sub_sasaran($key2),
				'tembusan'     => $this->surat_m->get_sub_surat($penugasan->no_st),			
				'tgl_tugas'    => $tgl_tugas,
				'tgl_kep'      => $tgl_kep,
				'tim'          => $this->tim_m->get_sub_tim($key2),
				'tgl_surat'    => $tgl_surat,
				'tgl_awal'     => $tgl_awal,
				'tgl_akhir'    => $tgl_akhir
			);

		$this->load->view('daltu/penugasan/detail_penugasan', $data);
	}

}
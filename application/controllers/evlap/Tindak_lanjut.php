<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindak_lanjut extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth();

		$this->load->model('notifikasi_m');
		$this->load->model('staff/tindak_lanjut_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');

		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='evlap')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
	}

	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'        	=> $get_akun,
			'level'       	=> $get_akun,
			'jml_notif'    => $this->notifikasi_m->jml_notif_evlap(),
			'notif'        => $this->notifikasi_m->notif_evlap(),
			'title'        	=> 'TINDAK LANJUT [Kasubag Evaluasi dan Pelaporan]',
			'tl'			=> $this->tindak_lanjut_m->get_tl()
		);

		//print "<pre>"; print_r($this->tindak_lanjut_m->get_tl($kt->id_pegawai)); die;

		$this->load->view('evlap/tindak_lanjut/list_tl', $data);
	}

	public function detail_tl($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));
		
		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		//s$this->notifikasi_m->update_notif_adum($key);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();
		$tgl_tl    = date('d', strtotime($cek->tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_tl))) ." ".
							 date('Y', strtotime($cek->tgl_tl));

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


		$penugasan = $this->tindak_lanjut_m->get_row_tl($key);	
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_evlap(),
				'notif'        => $this->notifikasi_m->notif_evlap(),
				'title'     => 'Tindak Lanjut [Staff Evaluasi dan Pelaporan]',
				'data'      => $penugasan,
				'ketua_tim'	=> $ketua_tim,				
				'tgl_tl'    => $tgl_tl,
				'tgl_kep'	=> $tgl_kep,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev' 	=> $this->tindak_lanjut_m->cek_reviu($key),
				'data_rev'  => $this->tindak_lanjut_m->get_rev_tl($key)
			);

		$this->load->view('evlap/tindak_lanjut/detail_tl', $data);
	}

}
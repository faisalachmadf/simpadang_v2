<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindak_lanjut extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth();

		$this->load->model('notifikasi_m');
		$this->load->model('evlap/tindak_lanjut_m');

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
			'jml_notif'    	=> $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'        	=> $this->notifikasi_m->notif_ketua($kt->id_pegawai),
			'jml_notifAgr' 	=> $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
			'notifAgr'     	=> $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
			'jml_notifPka' 	=> $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
			'notifPka'     	=> $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
			'title'        	=> 'TINDAK LANJUT [Kasubag Evaluasi dan Pelaporan]',
			'tl'			=> $this->tindak_lanjut_m->get_tl()
		);

		//print "<pre>"; print_r($this->tindak_lanjut_m->get_tl($kt->id_pegawai)); die;

		$this->load->view('evlap/tindak_lanjut/list_tl', $data);
	}

	public function detail_temuan($id_temuan)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'          => $get_akun,
			'level'         => $get_akun,
			'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
			'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
			'jml_notifAgr'  => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
			'notifAgr'      => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
			'jml_notifPka'	=> $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
			'notifPka'     	=> $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
			'title'			=> 'Detail Temuan [Kasubag Evaluasi dan Pelaporan]',
			'temuan'		=> $this->tindak_lanjut_m->get_temuan($id_temuan),
			'aspek'			=> $this->tindak_lanjut_m->get_aspek($id_temuan),
			'temuan_rekomendasi' => $this->tindak_lanjut_m->get_temuan_rekomendasi($id_temuan),

		);

		if($this->input->post('submit'))
		{
			$this->tindak_lanjut_m->update_usulan($id_temuan);
		}

		//print "<pre>"; print_r($data); die;

		//print "<pre>"; print_r($this->tindak_lanjut_m->get_lhp($kt->id_pegawai)); die;

		$this->load->view('evlap/tindak_lanjut/form_rekomendasi', $data);
	}




}
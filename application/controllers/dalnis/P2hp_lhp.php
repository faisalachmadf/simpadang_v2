<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class P2hp_lhp extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('ketua_tim/anggaran_waktu_m');
		$this->load->model('ketua_tim/pka_m');
		$this->load->model('ketua_tim/p2hp_lhp_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');

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

	//--> list p2hp & lhp
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
				'title'        => 'P2HP & LHP [DALNIS]',
				'p2hp_lhp'     => $this->p2hp_lhp_m->get_p2hp_dn($dn->id_pegawai)
			);

		$this->load->view('dalnis/p2hp_lhp/list_p2hp_lhp', $data);
	}

	//--> detail penugasan
	public function detail_p2hp_lhp($id_p2hp, $id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));
		
		$key  = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);

		$data_pka  = $this->pka_m->get_row_pka($key2); 

		//--> tgl pemeriksaan
		$tgl_awal = date('d', strtotime($data_pka->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) ." ".
							 date('Y', strtotime($data_pka->tgl_awal));
		$tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) ." ".
							 date('Y', strtotime($data_pka->tgl_akhir));
		
		$p2hp = $this->p2hp_lhp_m->get_row_p2hp($key);

		if($p2hp->keputusan_p2hp == "selesai")
		{ 
			$lhp      = $this->p2hp_lhp_m->get_row_lhp($key);
			$rev      = $this->p2hp_lhp_m->cek_rev_lhp($key);
			$cek_rev  = $this->p2hp_lhp_m->cek_reviu_lhp($key);
			$data_rev = $this->p2hp_lhp_m->get_rev_lhp($key);
		}
		else
		{ 
			$lhp      = ""; 
			$rev      = "";
			$cek_rev  = "";
			$data_rev = "";
		}					 

		$data = array(
				'user'          => $get_akun,
				'level'         => $get_akun,
				'jml_notif'     => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'         => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka'  => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'      => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'         => 'P2HP & LHP [DALNIS]',
				'data'          => $data_pka,
				'tgl_awal'      => $tgl_awal,
				'tgl_akhir'     => $tgl_akhir,
				'p2hp'          => $p2hp,
				'rev_p2hp'      => $this->p2hp_lhp_m->cek_rev_p2hp($key),
				'cek_rev_p2hp'  => $this->p2hp_lhp_m->cek_reviu_p2hp($key),
				'data_rev_p2hp' => $this->p2hp_lhp_m->get_rev_p2hp($key),
				'lhp'           => $lhp,
				'rev_lhp'       => $rev,
				'cek_rev_lhp'   => $cek_rev,
				'data_rev_lhp'  => $data_rev
			);

		$this->load->view('dalnis/p2hp_lhp/detail_p2hp_lhp', $data);
	}

	function download_p2hp($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/p2hp/'.$nmfile, NULL);
	}
	
	function download_rev_p2hp($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/p2hp/reviu/'.$nmfile, NULL);
	}
	
	function download_lhp($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/lhp/'.$nmfile, NULL);
	}
	
	function download_rev_lhp($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/lhp/reviu/'.$nmfile, NULL);
	}
	
	public function persetujuan_p2hp($id_p2hp, $id_pka, $id_tgs)
	{
		$key1 = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($id_tgs);

		$this->p2hp_lhp_m->persetujuan_p2hp_dalnis($key1, $key2, $key3);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								P2HP telah di reviu!
							</strong>
							P2HP telah di reviu oleh DALNIS, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('dalnis/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
	}

	public function persetujuan_lhp($no_lhp, $id_p2hp, $id_pka)
	{
		$key  = base64_decode($no_lhp);
		$key2 = base64_decode($id_pka);

		$this->p2hp_lhp_m->persetujuan_lhp_dalnis($key, $key2);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								LHP telah di reviu!
							</strong>
							LHP telah di reviu oleh DALNIS, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('dalnis/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
	}

}
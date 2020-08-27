<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pka extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');
		$this->load->model('staff/instansi_m');
		$this->load->model('ketua_tim/pka_m');
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
				'title'        => 'Program Kerja Audit [DALNIS]',
				'pka'          => $this->pka_m->get_pka_dn($dn->id_pegawai)
			);

		$this->load->view('dalnis/pka/list_pka', $data);
	}

	//--> detail penugasan
	public function detail_pka($id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));

		$key = base64_decode($id_pka);

		//-> update notif penugasan
		$this->notifikasi_m->update_notif_dalnis($key);

		$data_pka  = $this->pka_m->get_row_pka($key);
		
		//--> tgl pemeriksaan
		$tgl_awal = date('d', strtotime($data_pka->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) ." ".
							 date('Y', strtotime($data_pka->tgl_awal));
		$tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) ." ".
							 date('Y', strtotime($data_pka->tgl_akhir));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Program Kerja Audit [DALNIS]',
				'data'         => $data_pka,
				'sub1'         => $this->pka_m->get_sub_pka1($key),
				'sub2'         => $this->pka_m->get_sub_pka2($key),
				'sub3'         => $this->pka_m->get_sub_pka3($key),
				'ins'          => $this->pka_m->get_sub_pka1_instansi($key),
				'tgl_awal'     => $tgl_awal,
				'tgl_akhir'    => $tgl_akhir,
				'sasaran'      => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'cek_rev'      => $this->pka_m->cek_reviu($key),
				'data_rev'     => $this->pka_m->get_rev_pka($key)
			);

		$this->load->view('dalnis/pka/detail_pka', $data);
	}

	//--> detail reviu pka
	public function detail_reviu($id_pka, $no_rev)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));

		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_rev);

		$data_rev_pka = $this->pka_m->get_rev_pka1($key, $key2);
		$data_pka     = $this->pka_m->get_row_pka($key);

		$tgl_rev  = date('d', strtotime($data_rev_pka->tgl_reviu)) ." ".
							 get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_reviu))) ." ".
							 date('Y', strtotime($data_rev_pka->tgl_reviu)) ." | ".
							 date('H:i:s', strtotime($data_rev_pka->tgl_reviu));

		$tgl_rev_dn  = date('d', strtotime($data_rev_pka->tgl_rev_dalnis)) ." ".
							 get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_rev_dalnis))) ." ".
							 date('Y', strtotime($data_rev_pka->tgl_rev_dalnis)) ." | ".
							 date('H:i:s', strtotime($data_rev_pka->tgl_rev_dalnis));

		$tgl_rev_dt  = date('d', strtotime($data_rev_pka->tgl_rev_daltu)) ." ".
							 get_nama_bulan(date('m', strtotime($data_rev_pka->tgl_rev_daltu))) ." ".
							 date('Y', strtotime($data_rev_pka->tgl_rev_daltu)) ." | ".
							 date('H:i:s', strtotime($data_rev_pka->tgl_rev_daltu));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Program Kerja Audit [DALNIS]',
				'data'         => $data_rev_pka,
				'rev_pka2'     => $this->pka_m->get_rev_pka2($key, $key2),
				'rev_pka3'     => $this->pka_m->get_rev_pka3($key, $key2),
				'rev_pka4'     => $this->pka_m->get_rev_pka4($key, $key2),
				'ins'          => $this->pka_m->get_rev_pka2_instansi($key, $key2),
				'sasaran'      => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'tgl_rev'      => $tgl_rev,
				'tgl_rev_dn'   => $tgl_rev_dn,
				'tgl_rev_dt'   => $tgl_rev_dt,
			);

		$this->load->view('dalnis/pka/detail_rev_pka', $data);
	}

	public function persetujuan($id_pka)
	{
		$key  = base64_decode($id_pka);

		$this->pka_m->persetujuan_dalnis($key);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Program Kerja Audit telah di reviu!
							</strong>
							Rencana PKA telah di reviu oleh Pengendali Teknis, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('dalnis/pka/detail_pka/'.$id_pka);
	}

	function kka($id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$dn = $this->login_model->get_pegawai($this->session->userdata('username'));

		$key = base64_decode($id_pka);

		$data_pka  = $this->pka_m->get_row_pka($key);

		//--> tgl pemeriksaan
		$tgl_awal = date('d', strtotime($data_pka->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) ." ".
							 date('Y', strtotime($data_pka->tgl_awal));
		$tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) ." ".
							 date('Y', strtotime($data_pka->tgl_akhir));

		$data = array(
				'user'         => $get_akun,
				'level'        => $get_akun,
				'jml_notif'    => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),
				'jml_notifPka' => $this->notifikasi_m->jml_notif_dalnisPka($dn->id_pegawai),
				'notifPka'     => $this->notifikasi_m->notif_dalnisPka($dn->id_pegawai),
				'title'        => 'Program Kerja Audit [DALNIS]',
				'data'         => $data_pka,
				'kka'          => $this->pka_m->get_kka($key),
				'kka_ikhtisar' => $this->pka_m->get_kka_ikhtisar($key),
				'sub1'         => $this->pka_m->get_sub_pka1($key),
				'sub2'         => $this->pka_m->get_sub_pka2($key),
				'sub3'         => $this->pka_m->get_sub_pka3($key),
				'ins'          => $this->pka_m->get_sub_pka1_instansi($key),
				'sasaran'      => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'tgl_awal'     => $tgl_awal,
				'tgl_akhir'    => $tgl_akhir
			);

		$this->load->view('dalnis/pka/kka', $data);
	}
	
	public function detail_kka()
	{
		$id_pka    = $this->input->post('id1');
		$no_kka    = $this->input->post('id2');
		$pelaksana = $this->input->post('id3');

		$data['kka']      = $this->pka_m->get_row_kka($no_kka, $pelaksana, $id_pka);
		$data['cek_rev']  = $this->pka_m->cek_reviu_kka($id_pka, $no_kka, $pelaksana);
		$data['data_rev'] = $this->pka_m->get_rev_kka($id_pka, $no_kka, $pelaksana);
		$this->load->view('dalnis/pka/detail_kka', $data);
	}

	public function detail_kka_ikhtisar()
	{
		$id_pka = $this->input->post('id1');
		$no_kka = $this->input->post('id2');

		$data['kka']      = $this->pka_m->get_row_sub_pka2($id_pka, $no_kka);
		$data['cek_rev']  = $this->pka_m->cek_reviu_kka_ikhtisar($id_pka, $no_kka);
		$data['data_rev'] = $this->pka_m->get_rev_kka_ikhtisar($id_pka, $no_kka);
		$this->load->view('dalnis/pka/detail_kka_ikhtisar', $data);
	}
	
	function download_kka($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/kka/'.$nmfile, NULL);
	}

	function download_bukti_kka($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/kka_bukti/'.$nmfile, NULL);
	}

	function download_rev_kka($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/kka/reviu/'.$nmfile, NULL);
	}

	function download_kka_ikhtisar($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/kka_ikhtisar/'.$nmfile, NULL);
	}

	function download_rev_kka_ikhtisar($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/kka_ikhtisar/reviu/'.$nmfile, NULL);
	}
	
	public function persetujuan_kka($id_pka, $no_kka, $anggota)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);
		$key3 = base64_decode($anggota);

		$this->pka_m->persetujuan_kka_dalnis($key, $key2, $key3);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA telah di reviu!
							</strong>
							Kertas Kerja Audit telah di reviu oleh Pengendali Teknis, cek data tersebut di detail KKA.
						</p>
					</div>"
			);

		redirect('dalnis/pka/kka/'.$id_pka);
	}

	public function persetujuan_kka_ikhtisar($id_pka, $no_kka)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);

		$this->pka_m->persetujuan_kka_ikhtisar_dalnis($key, $key2);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA Ikhtisar telah di reviu!
							</strong>
							Kertas Kerja Audit Ikhtisar telah di reviu oleh Pengendali Teknis, cek data tersebut di detail KKA Ikhtisar.
						</p>
					</div>"
			);

		redirect('dalnis/pka/kka/'.$id_pka);
	}

}
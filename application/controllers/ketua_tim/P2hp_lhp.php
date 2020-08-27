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
		if($hak_akses!='ketua_tim')
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
				'title'        => 'P2HP & LHP [KETUA TIM]',
				'p2hp_lhp'     => $this->p2hp_lhp_m->get_p2hp_lhp($kt->id_pegawai)
			);
		$this->load->view('ketua_tim/p2hp_lhp/list_p2hp_lhp', $data);
	}

	//--> detail penugasan
	public function detail_p2hp_lhp($id_p2hp, $id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

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


		if($lhp)
		{ 
			$temuan = $this->p2hp_lhp_m->cek_temuan($lhp->no_lhp);
		}
		else
		{ 
			$temuan = "";
		}
		
		//print_r($temuan);exit;

		$data = array(
				'user'          => $get_akun,
				'level'         => $get_akun,
				'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
				'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
				'jml_notifAgr'  => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
				'notifAgr'      => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
				'jml_notifPka'	=> $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
				'notifPka'     	=> $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
				'title'         => 'P2HP & LHP [KETUA TIM]',
				'data'          => $data_pka,				
				'tgl_awal'      => $tgl_awal,
				'tgl_akhir'     => $tgl_akhir,
				'p2hp'          => $p2hp,
				'rev_p2hp'      => $this->p2hp_lhp_m->cek_rev_p2hp($key),
				'cek_rev_p2hp'  => $this->p2hp_lhp_m->cek_reviu_p2hp($key),
				'data_rev_p2hp' => $this->p2hp_lhp_m->get_rev_p2hp($key),
				'lhp'           => $lhp,
				'cek_temuan'	=> $temuan,
				'rev_lhp'       => $rev,
				'cek_rev_lhp'   => $cek_rev,
				'data_rev_lhp'  => $data_rev
			);

		$this->load->view('ketua_tim/p2hp_lhp/detail_p2hp_lhp', $data);
	}

	public function download_format_p2hp($id_p2hp, $id_pka)
	{
		$key  = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);

		$get = $this->db->get_where('tb_p2hp', array('id_p2hp' => $key))->row();

		$data_pka  = $this->pka_m->get_row_pka($get->fk_pka);
		$penugasan = $this->penugasan_m->get_row_penugasan($get->fk_tgs);

		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();
		$instansi  = $this->db->get_where('tb_instansi', array('id_instansi' => $penugasan->instansi_kec))->row();

		$tgl_surat = date('d', strtotime($penugasan->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($penugasan->tgl_surat))) ." ".
							 date('Y', strtotime($penugasan->tgl_surat));

		$tgl_awal  = date('d', strtotime($penugasan->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($penugasan->tgl_awal))) ." ".
							 date('Y', strtotime($penugasan->tgl_awal));
		$tgl_akhir = date('d', strtotime($penugasan->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($penugasan->tgl_akhir))) ." ".
							 date('Y', strtotime($penugasan->tgl_akhir));

		$data = array(
				'p2hp'			=> $get,
				'pka'       => $data_pka,
				'tgs'       => $penugasan,
				'ketua_tim' => $ketua_tim,
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'instansi'	=> $instansi
			);

		$this->load->view('ketua_tim/p2hp_lhp/format_p2hp', $data);
	}

	public function upload_p2hp($id_p2hp, $id_pka, $id_tgs)
	{
		$key1 = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($id_tgs);

		//--> jika file tidak ada
		if(empty($_FILES['file_p2hp']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								P2HP gagal di upload!
							</strong>
							File P2HP tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_p2hp']['name']))
		{
			$this->p2hp_lhp_m->upload_p2hp($key1, $key2, $key3);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								P2HP berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('ketua_tim/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
	}

	public function upload_reviu_p2hp($id_p2hp, $id_pka, $id_tgs)
	{
		$key1 = base64_decode($id_p2hp);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($id_tgs);

		//--> jika file tidak ada
		if(empty($_FILES['file_rev_p2hp']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								Reviu P2HP gagal di upload!
							</strong>
							File Reviu P2HP tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_rev_p2hp']['name']))
		{
			$this->p2hp_lhp_m->upload_reviu_p2hp($key1, $key2, $key3);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Reviu P2HP berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('ketua_tim/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
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

	###################################################
	#################    LHP    #######################
	###################################################

	public function download_format_lhp($no_lhp)
	{
		$key = base64_decode($no_lhp);
		$get = $this->db->get_where('tb_lhp', array('no_lhp' => $key))->row();		

		$tgl = date('d') ."-". date('m') ."-". date('Y');

		$data = array(
				'lhp' => $get,
				'tgl' => $tgl
			);

		$this->load->view('ketua_tim/p2hp_lhp/format_lhp', $data);
	}

	public function upload_lhp($no_lhp, $id_p2hp, $id_pka)
	{
		$key = base64_decode($no_lhp);

		//--> jika file tidak ada
		if(empty($_FILES['file_lhp']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								LHP gagal di upload!
							</strong>
							File LHP tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_lhp']['name']))
		{
			$this->p2hp_lhp_m->upload_lhp($key);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								LHP berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('ketua_tim/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
	}

	public function upload_reviu_lhp($no_lhp, $id_pka, $id_tgs)
	{
		$key = base64_decode($no_lhp);

		//--> jika file tidak ada
		if(empty($_FILES['file_rev_lhp']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								Reviu LHP gagal di upload!
							</strong>
							File Reviu LHP tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_rev_lhp']['name']))
		{
			$this->p2hp_lhp_m->upload_reviu_lhp($key);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Reviu LHP berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('ketua_tim/p2hp_lhp/detail_p2hp_lhp/'.$id_p2hp .'/'. $id_pka);
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

}
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
		if($hak_akses!='adum')
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

		$data = array(
			'user'     	=> $get_akun,
	        'level'	   	=> $get_akun,
	        'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
	        'notif'		 	=> $this->notifikasi_m->notif_adum(),
	        'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
			'notif_temuan'	   => $this->notifikasi_m->notif_adum_temuan(),
	        'title'		 	=> 'Penugasan [ADUM]',
			'tugas' 	 	=> $this->penugasan_m->get_all_tugas()
		);

		$this->load->view('adum/penugasan/list_penugasan', $data);
	}

	//--> detail penugasan
	public function detail_penugasan($id_tugas, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		
		$key  = base64_decode($id_tugas);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		$this->notifikasi_m->update_notif_adum($key);

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
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_adum(),
        		'notif'		 => $this->notifikasi_m->notif_adum(),
        		'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
				'notif_temuan'	   => $this->notifikasi_m->notif_adum_temuan(),
				'title'     => 'Penugasan [ADUM]',
				'data'      => $penugasan,
				'daltu'			=> $daltu,
				'dalnis'		=> $dalnis,
				'ketua_tim'	=> $ketua_tim,				
				'tgl_tugas' => $tgl_tugas,
				'tgl_kep'		=> $tgl_kep,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
				'tembusan'  => $this->surat_m->get_sub_surat($penugasan->no_st),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev' 	=> $this->penugasan_m->cek_reviu($key),
				'data_rev'  => $this->penugasan_m->get_rev_penugasan($key)
			);

		$this->load->view('adum/penugasan/detail_penugasan', $data);
	}

	//--> detail penugasan
	public function detail_reviu($id_tugas, $no_rev)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tugas);
		$key2 = base64_decode($no_rev);

		$cek = $this->db->get_where('rev_penugasan1', array('rev_tugas1' => $key, 'rev_ke' => $key2))->row();
		$tgl_tugas = date('d', strtotime($cek->rev_tgl_penugasan)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_penugasan))) ." ".
							 date('Y', strtotime($cek->rev_tgl_penugasan));

		$tgl_awal	 = date('d', strtotime($cek->rev_tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_awal))) ." ".
							 date('Y', strtotime($cek->rev_tgl_awal));

		$tgl_akhir = date('d', strtotime($cek->rev_tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_akhir))) ." ".
							 date('Y', strtotime($cek->rev_tgl_akhir));

		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_daltu))->row();
		$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_dalnis))->row();
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_ketua_tim))->row();

		$get_tim = $this->db->select('*')
		                    ->from('rev_penugasan2')
		                    ->join('tb_pegawai', 'tb_pegawai.id_pegawai = rev_penugasan2.rev_anggota')
		                    ->where('rev_tugas2', $cek->rev_id_tim)
		                    ->where('rev_ke', $key2)
		                    ->get()->result();

		$get_sas = $this->db->select('*')
		                    ->from('rev_penugasan2')
		                    ->where('rev_tugas2', $cek->rev_id_tim)
		                    ->where('rev_ke', $key2)
		                    ->where('rev_sasaran !=', NULL)
		                    ->get()->result();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		=> $this->notifikasi_m->notif_staff(),
        		'jml_notif_temuan' => $this->notifikasi_m->jml_notif_adum_temuan(),
				'notif_temuan'	   => $this->notifikasi_m->notif_adum_temuan(),
				'title'     => 'Penugasan [STAFF ADMINISTRASI]',
				'data'      => $cek,
				'daltu'		=> $daltu,
				'dalnis'	=> $dalnis,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tugas' => $tgl_tugas,
				'tim'      	=> $get_tim,
				'sasaran'   => $get_sas,
				'tgl_surat' => $tgl_tugas,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev' 	=> $this->penugasan_m->cek_reviu($key),
				'data_rev'  => $this->penugasan_m->get_rev_penugasan($key)
			);

		$this->load->view('adum/penugasan/detail_reviu', $data);
	}

	public function persetujuan($id_tugas)
	{
		$key  = base64_decode($id_tugas);
		$key2 = base64_encode($this->input->post('id_tim'));

		//$kep 	= $this->input->post('persetujuan');

		$this->penugasan_m->persetujuan_adum($key);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Penugasan telah di reviu!
							</strong>
							Rencana penugasan telah di reviu oleh ADUM, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('adum/penugasan/detail_penugasan/'.$id_tugas.'/'.$key2);
	}

}
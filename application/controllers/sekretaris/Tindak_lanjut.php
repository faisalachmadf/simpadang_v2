<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindak_lanjut extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/tindak_lanjut_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='sekretaris')
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
	        'jml_notif' => $this->notifikasi_m->jml_notif_sekretaris(),
			'notif'		 	=> $this->notifikasi_m->notif_sekretaris(),
    		'title'		 	=> 'Tindak Lanjut [SEKRETARIS]',
			'tl' 	 			=> $this->tindak_lanjut_m->get_tl()
		);

		$this->load->view('sekretaris/tindak_lanjut/list_tl', $data);
	}

	//--> detail tindak_lanjut
	public function detail_tl($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		
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
			'jml_notif' => $this->notifikasi_m->jml_notif_sekretaris(),
			'notif'		 	=> $this->notifikasi_m->notif_sekretaris(),
			'title'     => 'Tindak Lanjut [SEKRETARIS]',
			'data'      => $penugasan,
			'ketua_tim'	=> $ketua_tim,				
			'tgl_tl'    => $tgl_tl,
			'tgl_kep'		=> $tgl_kep,
			'tim'      	=> $this->tim_m->get_sub_tim($key2),
			'tgl_surat' => $tgl_surat,
			'tgl_awal'	=> $tgl_awal,
			'tgl_akhir'	=> $tgl_akhir,
			'cek_rev' 	=> $this->tindak_lanjut_m->cek_reviu($key),
			'data_rev'  => $this->tindak_lanjut_m->get_rev_tl($key)
		);

		$this->load->view('sekretaris/tindak_lanjut/detail_tl', $data);
	}

	//--> detail penugasan
	public function detail_reviu($id_tl, $no_rev)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($no_rev);

		$cek = $this->db->get_where('rev_tindak_lanjut', array('rev_tl' => $key, 'rev_ke' => $key2))->row();
		$tgl_tugas = date('d', strtotime($cek->rev_tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_tl))) ." ".
							 date('Y', strtotime($cek->rev_tgl_tl));

		$tgl_awal	 = date('d', strtotime($cek->rev_tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_awal))) ." ".
							 date('Y', strtotime($cek->rev_tgl_awal));

		$tgl_akhir = date('d', strtotime($cek->rev_tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->rev_tgl_akhir))) ." ".
							 date('Y', strtotime($cek->rev_tgl_akhir));

		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $cek->rev_ketua_tim))->row();

		$get_tim = $this->db->select('*')
		                    ->from('rev_penugasan2')
		                    ->join('tb_pegawai', 'tb_pegawai.id_pegawai = rev_penugasan2.rev_anggota')
		                    ->where('rev_tugas2', $cek->rev_id_tim)
		                    ->where('rev_ke', $key2)
		                    ->get()->result();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        'notif'		 	=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [SEKRETARIS]',
				'data'      => $cek,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tugas' => $tgl_tugas,
				//'tgl_kep'		=> $tgl_kep,
				'tim'      	=> $get_tim,
				'tgl_surat' => $tgl_tugas,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir
			);

		$this->load->view('sekretaris/tindak_lanjut/detail_reviu', $data);
	}

	public function persetujuan($id_tl)
	{
		$key  = base64_decode($id_tl);
		$key2 = base64_encode($this->input->post('id_tim'));

		//$kep 	= $this->input->post('persetujuan');

		$this->tindak_lanjut_m->persetujuan_sekretaris($key);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Tindak Lanjut telah di reviu!
							</strong>
							Rencana tindak lanjut telah di reviu oleh ADUM, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

		redirect('sekretaris/tindak_lanjut/detail_tl/'.$id_tl.'/'.$key2);
	}

}
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
		if($hak_akses!='inspektur')
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
		$ketua_tim = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
				'user'     	=> $get_akun,
        'level'	   	=> $get_akun,
        'jml_notif' => $this->notifikasi_m->jml_notif_inspektur(),
        'notif'		 	=> $this->notifikasi_m->notif_inspektur(),		    
        'title'		 	=> 'Penugasan [INSPEKTUR]',
				'tugas' 	 	=> $this->penugasan_m->get_tugas_inspektorat()
			);

		$this->load->view('inspektur/penugasan/list_penugasan', $data);
	}

	//--> detail penugasan
	public function detail_penugasan($id_tugas, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tugas);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		$this->notifikasi_m->update_notif_inspektur($key);

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
				'jml_notif' => $this->notifikasi_m->jml_notif_inspektur(),
        'notif'		 	=> $this->notifikasi_m->notif_inspektur(),
				'title'     => 'Penugasan [INSPEKTUR]',
				'data'      => $penugasan,
				'daltu'		=> $daltu,
				'dalnis'	=> $dalnis,
				'ketua_tim'	=> $ketua_tim,				
				'tgl_tugas' => $tgl_tugas,
				'tgl_kep'	=> $tgl_kep,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
				'tembusan'  => $this->surat_m->get_sub_surat($penugasan->no_st),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev'		=> $this->penugasan_m->cek_reviu($key),
			);

		$this->load->view('inspektur/penugasan/detail_penugasan', $data);
	}

	public function verifikasi_digital($id_tugas)
	{
		$key        = $_POST['id_tgs'];
		$result     = array();
		$imagedata  = base64_decode($_POST['img_data']);
		$filename   = md5(date("dmYhisA"));

		$file_name = './assets/verifikasi/'.$filename.'.png';
		$this->penugasan_m->verifikasi_digital($filename, $key);
		
		file_put_contents($file_name,$imagedata);

		echo $this->session->set_flashdata('sukses',
		 "<div class='alert alert-block alert-success'>
				<button type='button' class='close' data-dismiss='alert'>
					<i class='ace-icon fa fa-times'></i>
				</button>

				<p>
					<strong>
						<i class='ace-icon fa fa-check'></i>
						Berhasil Verifikasi!
					</strong>
					Surat tugas telah di verifikasi secara digital.
				</p>
			</div>"
		);

		//echo json_encode($result);
	}

	public function verifikasi_manual($id_tugas, $id_tim)
	{
		$key  = base64_decode($id_tugas);

		$this->penugasan_m->verifikasi_manual($key);

		//--> Tampilkan notifikasi berhasil ubah
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Verifikasi!
							</strong>
							Surat tugas telah di verifikasi secara manual.
						</p>
					</div>"
			);

		redirect('inspektur/penugasan/detail_penugasan/'.$id_tugas.'/'.$id_tim);
	}

}
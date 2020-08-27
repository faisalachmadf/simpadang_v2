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
		        'title'		 	=> 'Tindak Lanjut [INSPEKTUR]',
				'tl' 	 		  => $this->tindak_lanjut_m->get_tugas_inspektorat()
			);

		$this->load->view('inspektur/tindak_lanjut/list_tl', $data);
	}

	//--> detail penugasan
	public function detail_tl($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);

		//-> update notif penugasan
		//$this->notifikasi_m->update_notif_staff($key);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

		$tgl_tl    = date('d', strtotime($cek->tgl_tl)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_tl))) ." ".
							 date('Y', strtotime($cek->tgl_tl));

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
				'jml_notif' => $this->notifikasi_m->jml_notif_inspektur(),
        		'notif'		 	=> $this->notifikasi_m->notif_inspektur(),
				'title'     => 'Tindak Lanjut [INSPEKTUR]',
				'data'      => $penugasan,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tl'    => $tgl_tl,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'cek_rev' 	=> $this->tindak_lanjut_m->cek_reviu($key),
				'data_rev'  => $this->tindak_lanjut_m->get_rev_tl($key)
			);

		$this->load->view('inspektur/tindak_lanjut/detail_tl', $data);
	}

	public function verifikasi_digital($id_tl)
	{
		$key        = $_POST['id_tl'];
		$result     = array();
		$imagedata  = base64_decode($_POST['img_data']);
		$filename   = md5(date("dmYhisA"));

		$file_name = './assets/verifikasi/'.$filename.'.png';
		$this->tindak_lanjut_m->verifikasi_digital($filename, $key);
		
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

	public function verifikasi_manual($id_tl, $id_tim)
	{
		$key  = base64_decode($id_tl);

		$this->tindak_lanjut_m->verifikasi_manual($key);

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

		redirect('inspektur/tindak_lanjut/detail_tl/'.$id_tl.'/'.$id_tim);
	}

}
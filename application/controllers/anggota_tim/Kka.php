<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kka extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/penugasan_m');
		$this->load->model('staff/tim_m');
		$this->load->model('ketua_tim/pka_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='anggota_tim')
		{
			echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
			redirect('log_in','refresh');
			exit();
		}
		// ./hak akses
	}

	//--> list kka anggota
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$ag = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'     	=> $get_akun,
	        'level'	   	=> $get_akun,
	        /*'jml_notif' => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
	        'notif'		 	=> $this->notifikasi_m->notif_dalnis($dn->id_pegawai),*/
	        'title'		 	=> 'Kertas Kerja Audit [ANGGOTA TIM]',
			'pka' 			=> $this->pka_m->get_pka_ag($ag->id_pegawai)
		);

		$this->load->view('anggota_tim/kka/list_pka', $data);
	}

	//--> detail kka
	public function detail_kka($id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$ag = $this->login_model->get_pegawai($this->session->userdata('username'));

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
				/*'jml_notif'  => $this->notifikasi_m->jml_notif_dalnis($dn->id_pegawai),
				'notif'        => $this->notifikasi_m->notif_dalnis($dn->id_pegawai),*/
				'title'        => 'Kertas Kerja Audit [ANGGOTA TIM]',
				'data'         => $data_pka,
				'kka'          => $this->pka_m->get_kka_agt($key, $ag->id_pegawai), 
				'kka_ikhtisar' => $this->pka_m->get_kka_ikhtisar_agt($key, $ag->id_pegawai),
				'ins' 				 => $this->pka_m->get_sub_pka1_instansi($key),
				'sasaran'			 => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'sub1'       	 => $this->pka_m->get_sub_pka1($key),
				/*'sub2'         => $this->pka_m->get_sub_pka2($key),
				'sub3'         => $this->pka_m->get_sub_pka3($key),*/
				'tgl_awal'     => $tgl_awal,
				'tgl_akhir'    => $tgl_akhir
			);

		$this->load->view('anggota_tim/kka/detail_kka', $data);
	}

	//--> detail kka
	public function detail_kka_ihktisar($id_pka)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
		$ag = $this->login_model->get_pegawai($this->session->userdata('username'));

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
				'title'        => 'Kertas Kerja Audit [ANGGOTA TIM]',
				'data'         => $data_pka,
				'kka'          => $this->pka_m->get_kka_agt($key, $ag->id_pegawai), 
				'kka_ikhtisar' => $this->pka_m->get_kka_ikhtisar_agt($key, $ag->id_pegawai),
				'ins' 				 => $this->pka_m->get_sub_pka1_instansi($key),
				'sasaran'			 => $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'sub1'       	 => $this->pka_m->get_sub_pka1($key),
				'tgl_awal'     => $tgl_awal,
				'tgl_akhir'    => $tgl_akhir
			);

		$this->load->view('anggota_tim/kka/detail_kka_ikhtisar', $data);
	}

	public function download_format_kka($id_tgs, $id_pka, $no_kka, $anggota)
	{
		$key  = base64_decode($id_tgs);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($no_kka);
		$key4 = base64_decode($anggota);

		$data_pka  = $this->pka_m->get_row_pka($key2);
		//--> tgl pemeriksaan
		$tgl_awal = date('d', strtotime($data_pka->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) ." ".
							 date('Y', strtotime($data_pka->tgl_awal));
		$tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) ." ".
							 date('Y', strtotime($data_pka->tgl_akhir));

		$penugasan = $this->penugasan_m->get_row_penugasan($key);
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
				'pka'				=> $data_pka,
				'tgs'       => $penugasan,
				'kka'       => $this->pka_m->get_row_kka($key3, $key4),
				'ketua_tim' => $ketua_tim,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir
			);

		$this->load->view('anggota_tim/kka/format_kka', $data);
	}

	public function download_format_kka_ikhtisar($id_tgs, $id_pka, $no_kka)
	{
		$key  = base64_decode($id_tgs);
		$key2 = base64_decode($id_pka);
		$key3 = base64_decode($no_kka);

		$data_pka  = $this->pka_m->get_row_pka($key2);
		//--> tgl pemeriksaan
		$tgl_awal = date('d', strtotime($data_pka->tgl_awal)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_awal))) ." ".
							 date('Y', strtotime($data_pka->tgl_awal));
		$tgl_akhir = date('d', strtotime($data_pka->tgl_akhir)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_akhir))) ." ".
							 date('Y', strtotime($data_pka->tgl_akhir));

		$penugasan = $this->penugasan_m->get_row_penugasan($key);
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();

		$data = array(
				'pka'				=> $data_pka,
				'tgs'       => $penugasan,
				//'sub_pka1'  => $this->pka_m->get_row_sub_pka1($key2, $key3),
				'sub_pka2'  => $this->pka_m->get_row_sub_pka2($key2, $key3),
				'penyusun'  => $this->pka_m->get_penyusun_ikhtisar($key2, $key3),
				'ketua_tim' => $ketua_tim,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir
			);

		$this->load->view('anggota_tim/kka/format_kka_ikhtisar', $data);
	}

	public function form_upload_kka()
	{
		$id_pka      = $this->input->post('id1');
		$no_kka      = $this->input->post('id2');
		$pelaksana   = $this->input->post('id3');
		//$jml_kka     = $this->input->post('id4');
		//$jml_kka_fix = $this->input->post('id5');
		$id_tgs 		 = $this->input->post('id6');

		$data['kka'] = $this->pka_m->get_row_kka($no_kka, $pelaksana, $id_pka);
		//$data['jml_kka']     = $jml_kka;
		//$data['jml_kka_fix'] = $jml_kka_fix;
		$data['id_tgs'] 		 = $id_tgs;
		$this->load->view('anggota_tim/kka/form_upload_kka', $data);
	}

	public function form_upload_kka_ikhtisar()
	{
		$id_pka = $this->input->post('id1');
		$no_kka = $this->input->post('id2');
		//$pelaksana   = $this->input->post('id3');
		//$jml_kka     = $this->input->post('id4');
		//$jml_kka_fix = $this->input->post('id5');
		//$id_tgs 		 = $this->input->post('id6');

		$data['kka'] = $this->pka_m->get_row_sub_pka2($id_pka, $no_kka);
		//$data['jml_kka']     = $jml_kka;
		//$data['jml_kka_fix'] = $jml_kka_fix;
		//$data['id_tgs'] 		 = $id_tgs;
		$this->load->view('anggota_tim/kka/form_upload_kka_ikhtisar', $data);
	}

	public function upload_kka($id_pka, $no_kka, $anggota)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);
		$key3 = base64_decode($anggota);

		//--> jika file tidak ada
		if(empty($_FILES['file_kka']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								KKA gagal di upload!
							</strong>
							File KKA tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_kka']['name']))
		{
			$this->pka_m->upload_kka($key, $key2, $key3);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('anggota_tim/kka/detail_kka/'.$id_pka);
	}

	public function upload_kka_ikhtisar($id_pka, $no_kka)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);

		//--> jika file tidak ada
		if(empty($_FILES['file_kka_ikhtisar']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								KKA Ikhtisar gagal di upload!
							</strong>
							File KKA Iktisar tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_kka_ikhtisar']['name']))
		{
			$this->pka_m->upload_kka_ikhtisar($key, $key2);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								KKA Ikhtisar berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('anggota_tim/kka/detail_kka_ihktisar/'.$id_pka);
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

	public function detail_sub_kka()
	{
		$id_pka      = $this->input->post('id1');
		$no_kka      = $this->input->post('id2');
		$pelaksana   = $this->input->post('id3');

		$data['kka']      = $this->pka_m->get_row_kka($no_kka, $pelaksana, $id_pka);
		$data['cek_rev']  = $this->pka_m->cek_reviu_kka($id_pka, $no_kka, $pelaksana);
		$data['data_rev'] = $this->pka_m->get_rev_kka($id_pka, $no_kka, $pelaksana);
		$this->load->view('anggota_tim/kka/detail_sub_kka', $data);
	}

	public function detail_sub_kka_ikhtisar()
	{
		$id_pka = $this->input->post('id1');
		$no_kka = $this->input->post('id2');

		$data['kka']      = $this->pka_m->get_row_sub_pka2($id_pka, $no_kka);
		$data['cek_rev']  = $this->pka_m->cek_reviu_kka_ikhtisar($id_pka, $no_kka);
		$data['data_rev'] = $this->pka_m->get_rev_kka_ikhtisar($id_pka, $no_kka);
		$this->load->view('anggota_tim/kka/detail_sub_kka_ikhtisar', $data);
	}

	public function detail_reviu()
	{
		$id_pka    = $this->input->post('id1');
		$no_kka    = $this->input->post('id2');
		$pelaksana = $this->input->post('id3');

		$data['kka'] = $this->pka_m->get_row_kka($no_kka, $pelaksana, $id_pka);
		$data['rev'] = $this->pka_m->cek_rev_kka($id_pka, $no_kka, $pelaksana);
		$this->load->view('anggota_tim/kka/detail_reviu', $data);
	}
	
	public function detail_reviu_ikhtisar()
	{
		$id_pka = $this->input->post('id1');
		$no_kka = $this->input->post('id2');

		$data['kka'] = $this->pka_m->get_row_sub_pka2($id_pka, $no_kka);
		$data['rev'] = $this->pka_m->cek_rev_kka_ikhtisar($id_pka, $no_kka);
		$this->load->view('anggota_tim/kka/detail_reviu_ikhtisar', $data);
	}

	public function upload_reviu_kka($id_pka, $no_kka, $anggota)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);
		$key3 = base64_decode($anggota);

		//--> jika file tidak ada
		if(empty($_FILES['file_rev_kka']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								KKA gagal di upload!
							</strong>
							File KKA tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_rev_kka']['name']))
		{
			$this->pka_m->upload_reviu_kka($key, $key2, $key3);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Reviu KKA berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('anggota_tim/kka/detail_kka/'.$id_pka);
	}
	
	public function upload_reviu_kka_ikhtisar($id_pka, $no_kka)
	{
		$key  = base64_decode($id_pka);
		$key2 = base64_decode($no_kka);

		//--> jika file tidak ada
		if(empty($_FILES['file_rev_kka_ikhtisar']['name']))
		{
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-danger'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-times'></i>
								KKA Ikhtisar gagal di upload!
							</strong>
							File KKA Ikhtisar tidak boleh kosong.
						</p>
					</div>"
			);
		}
		//--> jika file ada
		elseif(!empty($_FILES['file_rev_kka_ikhtisar']['name']))
		{
			$this->pka_m->upload_reviu_kka_ikhtisar($key, $key2);

			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Reviu KKA Ikhtisar berhasil di upload!
							</strong>
							Harap tunggu konfirmasi keputusan.
						</p>
					</div>"
			);
		}

		redirect('anggota_tim/kka/detail_kka_ihktisar/'.$id_pka);
	}

	//--> cetak pka
	public function cetak_reviu_kka($id_pka, $no_kka, $pelaksana)
	{
		$pdf = $this->pdf->load_surat2();

   	$key  = base64_decode($id_pka);
   	$key2 = base64_decode($no_kka);
   	$key3 = base64_decode($pelaksana);

		$data_pka  = $this->pka_m->get_row_pka($key);

		$tgl_pka = date('d', strtotime($data_pka->tgl_pka)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_pka))) ." ".
							 date('Y', strtotime($data_pka->tgl_pka));

		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->daltu))->row();
		$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->dalnis))->row();
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->ketua_tim))->row();
		$pelaksana = $this->db->get_where('tb_pegawai', array('id_pegawai' => $key3))->row();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Kertas Kerja Audit [ANGGOTA TIM]',
				'data'      => $data_pka,
				'sub1' 			=> $this->pka_m->get_sub_pka1($key),
				'sub2' 			=> $this->pka_m->get_sub_pka2($key),
				'sub3' 			=> $this->pka_m->get_sub_pka3($key),
				'ins' 			=> $this->pka_m->get_sub_pka1_instansi($key),
				'sasaran'		=> $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'cek_rev' 	=> $this->pka_m->cek_reviu_kka($key, $key2, $key3),
				'data_rev' 	=> $this->pka_m->get_rev_kka($key, $key2, $key3),
				'kka'				=> $this->pka_m->get_row_kka($key2, $key3),
				'tgl_pka'		=> $tgl_pka,
				'tgl_dn'		=> $tgl_dn,
				'tgl_dt'		=> $tgl_dt,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'daltu'			=> $daltu,
				'dalnis'		=> $dalnis,
				'ketua_tim' => $ketua_tim,
				'pelaksana' => $pelaksana,
				'addPage'		=> $pdf->AddPage()
			);

    $html = $this->load->view('anggota_tim/kka/cetak_reviu_kka', $data, TRUE);
    //--> render the view into HTML
    $pdf->WriteHTML($html);
    //--> write the HTML into the PDF
    $output = 'Reviu_KKA_'. $key .'_.pdf';
    $pdf->Output("$output", 'I');
	}
	
	//--> cetak pka
	public function cetak_reviu_kka_ikhtisar($id_pka, $no_kka)
	{
		$pdf = $this->pdf->load_surat2();

   	$key  = base64_decode($id_pka);
   	$key2 = base64_decode($no_kka);

		$data_pka  = $this->pka_m->get_row_pka($key);

		$tgl_pka = date('d', strtotime($data_pka->tgl_pka)) ." ".
							 get_nama_bulan(date('m', strtotime($data_pka->tgl_pka))) ." ".
							 date('Y', strtotime($data_pka->tgl_pka));

		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->daltu))->row();
		$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->dalnis))->row();
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $data_pka->ketua_tim))->row();

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Kertas Kerja Audit [ANGGOTA TIM]',
				'data'      => $data_pka,
				'sub1' 			=> $this->pka_m->get_sub_pka1($key),
				'sub2' 			=> $this->pka_m->get_sub_pka2($key),
				'sub3' 			=> $this->pka_m->get_sub_pka3($key),
				'ins' 			=> $this->pka_m->get_sub_pka1_instansi($key),
				'sasaran'		=> $this->tim_m->get_sub_sasaran($data_pka->id_tim),
				'cek_rev' 	=> $this->pka_m->cek_reviu_kka_ikhtisar($key, $key2),
				'data_rev' 	=> $this->pka_m->get_rev_kka_ikhtisar($key, $key2),
				'kka'				=> $this->pka_m->get_row_sub_pka2($key, $key2),
				'penyusun'  => $this->pka_m->get_penyusun_ikhtisar($key, $key2),
				'tgl_pka'		=> $tgl_pka,
				'daltu'			=> $daltu,
				'dalnis'		=> $dalnis,
				'ketua_tim' => $ketua_tim,
				'addPage'		=> $pdf->AddPage()
			);

    $html = $this->load->view('anggota_tim/kka/cetak_reviu_kka_ikhtisar', $data, TRUE);
    //--> render the view into HTML
    $pdf->WriteHTML($html);
    //--> write the HTML into the PDF
    $output = 'Reviu_KKA_'. $key .'_.pdf';
    $pdf->Output("$output", 'I');
	}

}
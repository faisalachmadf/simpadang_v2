<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_tim extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('adum/tim_m');
		$this->load->model('adum/penugasan_m');
		$this->load->model('adum/instansi_m');
		$this->load->model('adum/surat_m');

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

	//--> data tim
	public function index()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$data = array(
				'user'  => $get_akun,
				'level' => $get_akun,
				'title' => 'Data Tim [ADUM]',
				'tim'   => $this->tim_m->get_all_tim()
			);

		$this->load->view('adum/data_tim/list_tim', $data);
	}

	//--> detail tim pemeriksa
	public function detail_tim_pemeriksa($id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($id_tim);

		$cek = $this->db->get_where('tb_surat', array('fk_tim' => $key))->row();
		$tgl_surat = date('d', strtotime($cek->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_surat))) ." ".
							 date('Y', strtotime($cek->tgl_surat));

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($cek->tgl_awal));
		$bln2 = date('m', strtotime($cek->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($cek->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) ." ". date('Y', strtotime($cek->tgl_akhir));

		//--> lama waktu pelaksanaan
		$awal  = date_create($cek->tgl_awal);
		$akhir = date_create($cek->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;		

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Data Tim [ADUM]',
				'data'      => $this->tim_m->get_row_tim_pemeriksa($key),
				'tim'      	=> $this->tim_m->get_sub_tim_pemeriksa($key),
				'surat'     => $this->tim_m->get_sub_surat_pemeriksa($key),
				'jml_sas'   => $this->tim_m->get_jum_sasaran_tim_pemeriksa($key),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'lama_wkt'  => $lama_waktu
			);

		$this->load->view('adum/data_tim/detail_tim_pemeriksa', $data);
	}

	//--> detail tim tindak lanjut
	public function detail_tim_tindak_lanjut($id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($id_tim);

		$cek = $this->db->get_where('tb_surat', array('fk_tim' => $key))->row();
		$tgl_surat = date('d', strtotime($cek->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_surat))) ." ".
							 date('Y', strtotime($cek->tgl_surat));

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($cek->tgl_awal));
		$bln2 = date('m', strtotime($cek->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($cek->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) ." ". date('Y', strtotime($cek->tgl_akhir));

		//--> lama waktu pelaksanaan
		$awal  = date_create($cek->tgl_awal);
		$akhir = date_create($cek->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;		

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Data Tim [ADUM]',
				'data'      => $this->tim_m->get_row_tim_pemeriksa($key),
				'tim'      	=> $this->tim_m->get_sub_tim_pemeriksa($key),
				'surat'     => $this->tim_m->get_sub_surat_pemeriksa($key),
				'jml_sas'   => $this->tim_m->get_jum_sasaran_tim_pemeriksa($key),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'lama_wkt'  => $lama_waktu
			);

		$this->load->view('adum/data_tim/detail_tim_tindak_lanjut', $data);
	}

	//--> tambah tim pemeriksa
	public function tambah_tim_pemeriksa()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$nu = $this->surat_m->get_no_urut();
		$no_urut = $nu->no_urut + 1;

		if ($no_urut == 1)
		{	$no = "01";	}
		elseif ($no_urut == 2) 
		{ $no = "02"; }
		elseif ($no_urut == 3) 
		{ $no = "03"; }
		elseif ($no_urut == 4) 
		{ $no = "04"; }
		elseif ($no_urut == 5) 
		{ $no = "05"; }
		elseif ($no_urut == 6) 
		{ $no = "06"; }
		elseif ($no_urut == 7) 
		{ $no = "07"; }
		elseif ($no_urut == 8) 
		{ $no = "08"; }
		elseif ($no_urut == 9) 
		{ $no = "09"; }
		else { $no = $no_urut; }

		$tgl_surat = date('d') ." ". get_nama_bulan(date('m')) ." ". date('Y');

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Tim [ADUM]',
				'id_tim'    => $this->tim_m->get_id_max_tim(),
				'irban'    	=> $this->tim_m->get_irban(),
				'pegawai'		=> $this->tim_m->get_all_pegawai(),

				'ketua_tim' => $this->tim_m->get_ketua_tim(),
				'dalnis'    => $this->tim_m->get_dalnis(),
				'anggota'   => $this->tim_m->get_anggota(),
				'instansi'  => $this->instansi_m->get_instansi(),
				'no_urut'		=> $no_urut,
				'no_surat'	=> $no ."-INSPT/". date('Y'),
				'tgl_surat' => $tgl_surat
			);

		$this->load->view('adum/data_tim/form_tambah_tim_pemeriksa', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->tim_m->insert_tim_pemeriksa();
			$this->surat_m->insert_surat_tim_pemeriksa();

			$key = base64_encode($this->input->post('id_tim'));

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah!
								</strong>
								Data Tim Pemeriksa telah dibuat, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adum/data_tim/detail_tim_pemeriksa/'.$key);
		}
	}

	//--> ubah tim pemeriksa
	public function ubah_tim_pemeriksa($id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key = base64_decode($id_tim);

		$cek = $this->db->get_where('tb_surat', array('fk_tim' => $key))->row();
		$tgl_surat = date('d', strtotime($cek->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_surat))) ." ".
							 date('Y', strtotime($cek->tgl_surat));

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($cek->tgl_awal));
		$bln2 = date('m', strtotime($cek->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($cek->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) ." ". date('Y', strtotime($cek->tgl_akhir));

		//--> lama waktu pelaksanaan
		$awal  = date_create($cek->tgl_awal);
		$akhir = date_create($cek->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'ketua_tim' => $this->tim_m->get_ketua_tim(),
				'dalnis'    => $this->tim_m->get_dalnis(),
				'anggota'   => $this->tim_m->get_anggota(),
				'instansi'  => $this->instansi_m->get_instansi(),
				'title'     => 'Data Tim [ADUM]',
				'data'      => $this->tim_m->get_row_tim_pemeriksa($key),
				'tim'      	=> $this->tim_m->get_sub_tim_pemeriksa($key),
				'surat'     => $this->tim_m->get_sub_surat_pemeriksa($key),
				'jml_agt'   => $this->tim_m->get_jum_agt_tim_pemeriksa($key),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'lama_wkt'  => $lama_waktu
			);

		$this->load->view('adum/data_tim/form_ubah_tim_pemeriksa', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->instansi_m->update_instansi($key);

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Ubah!
								</strong>
								Data pegawai telah di ubah, cek data di bawah ini.
							</p>
						</div>"
				);

			redirect('adum/instansi');
		}
	}

	//--> tambah tim tindak lanjut
	public function tambah_tim_tindak_lanjut()
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$nu = $this->surat_m->get_no_urut();
		$no_urut = $nu->no_urut + 1;

		if ($no_urut == 1)
		{	$no = "01";	}
		elseif ($no_urut == 2) 
		{ $no = "02"; }
		elseif ($no_urut == 3) 
		{ $no = "03"; }
		elseif ($no_urut == 4) 
		{ $no = "04"; }
		elseif ($no_urut == 5) 
		{ $no = "05"; }
		elseif ($no_urut == 6) 
		{ $no = "06"; }
		elseif ($no_urut == 7) 
		{ $no = "07"; }
		elseif ($no_urut == 8) 
		{ $no = "08"; }
		elseif ($no_urut == 9) 
		{ $no = "09"; }
		else { $no = $no_urut; }

		$tgl_surat = date('d') ." ". get_nama_bulan(date('m')) ." ". date('Y');

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'title'     => 'Tim [ADUM]',
				'id_tim'    => $this->tim_m->get_id_max_tim(),
				'ketua_tim' => $this->tim_m->get_ketua_tim(),
				'dalnis'    => $this->tim_m->get_dalnis(),
				'anggota'   => $this->tim_m->get_anggota(),
				'instansi'  => $this->instansi_m->get_instansi(),
				'no_urut'		=> $no_urut,
				'no_surat'	=> $no ."-INSPT/". date('Y'),
				'tgl_surat' => $tgl_surat
			);

		$this->load->view('adum/data_tim/form_tambah_tim_tindak_lanjut', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$this->tim_m->insert_tim_pemeriksa();
			$this->surat_m->insert_surat_tim_pemeriksa();

			$key = base64_encode($this->input->post('id_tim'));

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
					 "<div class='alert alert-block alert-success'>
							<button type='button' class='close' data-dismiss='alert'>
								<i class='ace-icon fa fa-times'></i>
							</button>

							<p>
								<strong>
									<i class='ace-icon fa fa-check'></i>
									Berhasil Tambah!
								</strong>
								Data Tim Pemeriksa telah dibuat, cek data tersebut di bawah ini.
							</p>
						</div>"
				);

			redirect('adum/data_tim/detail_tim_tindak_lanjut/'.$key);
		}
	}

	//--> hapus tim
	public function hapus_tim($id_tim)
	{
		$key = base64_decode($id_tim);
		$this->tim_m->delete_tim($key);

		//--> Tampilkan notifikasi berhasil hapus
		echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil Hapus!
							</strong>
							Data tim telah di hapus dari sistem secara permanen.
						</p>
					</div>"
			);

		redirect('adum/data_tim');
	}

	//--> cetak surat tim pemeriksa
	public function cetak_surat_pemeriksa($id_tim)
	{
		$key = base64_decode($id_tim);
		$pdf = $this->pdf->load_surat();

    $cek = $this->db->get_where('tb_surat', array('fk_tim' => $key))->row();
		$tgl_surat = date('d', strtotime($cek->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_surat))) ." ".
							 date('Y', strtotime($cek->tgl_surat));

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($cek->tgl_awal));
		$bln2 = date('m', strtotime($cek->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($cek->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) ." ". date('Y', strtotime($cek->tgl_akhir));

		//--> lama waktu pelaksanaan
		$awal  = date_create($cek->tgl_awal);
		$akhir = date_create($cek->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;

		$data = array(
				'data'      => $this->tim_m->get_row_tim_pemeriksa($key),
				'tim'      	=> $this->tim_m->get_sub_tim_pemeriksa($key),
				'surat'     => $this->tim_m->get_sub_surat_pemeriksa($key),
				'jml_sas'   => $this->tim_m->get_jum_sasaran_tim_pemeriksa($key),
				'jml_agt'   => $this->tim_m->get_jum_agt_tim_pemeriksa($key),
				'inspektur' => $this->tim_m->get_inspektur(),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'lama_wkt'  => $lama_waktu
			);

    $html = $this->load->view('adum/surat/cetak_surat_pemeriksa', $data, TRUE);
    //--> render the view into HTML
    $pdf->WriteHTML($html);
    //--> write the HTML into the PDF
    $output = 'Surat_Tim_Pemeriksa'. $key .'_.pdf';
    $pdf->Output("$output", 'I');
	}

	//--> cetak surat tim tindak
	public function cetak_surat_tindak($id_tim)
	{
		$key = base64_decode($id_tim);
		$pdf = $this->pdf->load_surat();

    $cek = $this->db->get_where('tb_surat', array('fk_tim' => $key))->row();
		$tgl_surat = date('d', strtotime($cek->tgl_surat)) ." ".
							 get_nama_bulan(date('m', strtotime($cek->tgl_surat))) ." ".
							 date('Y', strtotime($cek->tgl_surat));

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($cek->tgl_awal));
		$bln2 = date('m', strtotime($cek->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($cek->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($cek->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($cek->tgl_akhir))) ." ". date('Y', strtotime($cek->tgl_akhir));

		//--> lama waktu pelaksanaan
		$awal  = date_create($cek->tgl_awal);
		$akhir = date_create($cek->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;

		$data = array(
				'data'      => $this->tim_m->get_row_tim_pemeriksa($key),
				'tim'      	=> $this->tim_m->get_sub_tim_pemeriksa($key),
				'surat'     => $this->tim_m->get_sub_surat_pemeriksa($key),
				'jml_sas'   => $this->tim_m->get_jum_sasaran_tim_pemeriksa($key),
				'jml_agt'   => $this->tim_m->get_jum_agt_tim_pemeriksa($key),
				'inspektur' => $this->tim_m->get_inspektur(),
				'tgl_surat' => $tgl_surat,
				'tgl_awal'  => $tgl_awal,
				'tgl_akhir' => $tgl_akhir,
				'lama_wkt'  => $lama_waktu
			);

    $html = $this->load->view('adum/surat/cetak_surat_tindak', $data, TRUE);
    //--> render the view into HTML
    $pdf->WriteHTML($html);
    //--> write the HTML into the PDF
    $output = 'Surat_Tim_Tindak'. $key .'_.pdf';
    $pdf->Output("$output", 'I');
	}

}
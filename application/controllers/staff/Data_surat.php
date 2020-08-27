<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_surat extends CI_Controller {

    public function __construct()
    {
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library

		//--> load model
		$this->load->model('notifikasi_m');
		$this->load->model('staff/tim_m');
		$this->load->model('staff/instansi_m');
		$this->load->model('staff/surat_m');
		$this->load->model('staff/penugasan_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='staff')
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
			'user'  		=> $get_akun,
			'level' 		=> $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
			'notif'		 	=> $this->notifikasi_m->notif_staff(),
			'title' 		=> 'Surat Tugas [STAFF ADMINISTRASI]pkpt',
			'surat' 		=> $this->surat_m->get_all_surat()
		);

		$this->load->view('staff/surat/list_surat', $data);
	}

	//--> detail surat tugas
	public function detail_surat_tugas($no_surat, $id_tim, $kategori_surat)
	{

		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($no_surat);
		$key2 = base64_decode($id_tim);
		$key3 = base64_decode($kategori_surat);

		if($key3 == "Tim Pemeriksa")
			{ $surat = $this->surat_m->get_surat($key); }
		else
			{ $surat = $this->surat_m->get_surat2($key); }


		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($surat->tgl_awal));
		$bln2 = date('m', strtotime($surat->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($surat->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_akhir))) ." ". date('Y', strtotime($surat->tgl_akhir));

		//--> tgl surat tugas
		$tgl_surat = date('d', strtotime($surat->tgl_surat)) ." ".
		get_nama_bulan(date('m', strtotime($surat->tgl_surat))) ." ".
		date('Y', strtotime($surat->tgl_surat));

		//--> lama waktu pelaksanaan
		$awal  = date_create($surat->tgl_awal);
		$akhir = date_create($surat->tgl_akhir);
		$diff  = date_diff($awal, $akhir);
		$lama_waktu = $diff->d +1;

		$tembusan  = $this->db->get_where('sub_surat', array('sub_no_surat' => $key))->result();
        
		//--> get ketua tim & dalnis
		$tim = $this->tim_m->get_row_tim($key2);
		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->daltu))->row();
		$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->dalnis))->row();
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->ketua_tim))->row();

		$data = array(
			'user'    	=> $get_akun,
			'level'	  	=> $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
			'notif'		 	=> $this->notifikasi_m->notif_staff(),
			'title'			=> 'Surat Tugas [STAFF ADMINISTRASI]pkpt',
			'data'      => $surat,
			'cek_tim'		=> $tim,
			'daltu'			=> $daltu,
			'dalnis'		=> $dalnis,
			'ketua_tim'	=> $ketua_tim,
			'tgl_surat' => $tgl_surat,
			'tembusan'	=> $tembusan,
			'tim'      	=> $this->tim_m->get_sub_tim($key2),
			'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
			'tgl_awal'	=> $tgl_awal,
			'tgl_akhir'	=> $tgl_akhir,
			'lama_wkt'  => $lama_waktu,
			'kategori'  => $key3
		);

		$this->load->view('staff/surat/detail_surat_tugas', $data);
	}

	//--> cetak surat tugas
	public function cetak_surat_tugas($no_surat, $id_tim)
	{
		//ob_start();
		$pdf = $this->pdf->load_surat();
		ini_set('max_execution_time', 300); //300 seconds = 5 minutes
		$key  = base64_decode($no_surat);
		$key2 = base64_decode($id_tim);

		$surat = $this->surat_m->get_surat($key);

        //--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($surat->tgl_awal));
		$bln2 = date('m', strtotime($surat->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($surat->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_akhir))) ." ". date('Y', strtotime($surat->tgl_akhir));

        //--> tgl surat tugas
		$tgl_surat = date('d', strtotime($surat->tgl_surat)) ." ".
		get_nama_bulan(date('m', strtotime($surat->tgl_surat))) ." ".
		date('Y', strtotime($surat->tgl_surat));

        //--> lama waktu pelaksanaan
		$tgl1 = new Datetime($surat->tgl_awal);
		$tgl2 = new Datetime($surat->tgl_akhir);
		$daterange = new DatePeriod($tgl1, new DateInterval('P1D'), $tgl2);
		$i=0; $x=0; $tgl2=1;
		foreach($daterange as $date)
		{
			$daterange = $date->format("Y-m-d");
			$datetime  = DateTime::createFromFormat("Y-m-d", $daterange);
			$day = $datetime->format("D");
			if($day != "Sun" && $day != "Sat"){ $x += $tgl2-$i; }
			$tgl2++;
			$i++;
		}
		$lama_waktu = $x+1;

        /*$awal  = date_create($surat->tgl_awal);
        $akhir = date_create($surat->tgl_akhir);
        $diff  = date_diff($awal, $akhir);
        $lama_waktu = $diff->d +1;*/

        $tembusan  = $this->db->order_by('tes','asc')->get_where('sub_surat', array('sub_no_surat' => $key))->result();

        //--> get ketua tim & dalnis
        $tim = $this->tim_m->get_row_tim($key2);
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->ketua_tim))->row();
        $dalnis      = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->dalnis))->row();
        $daltu     = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->daltu))->row();

        $data = array(
        	'title' 		=> 'TES',
        	'data'      => $surat,
        	'cek_tim'       => $tim,
        	'daltu'     => $daltu,
        	'dalnis'        => $dalnis,
        	'ketua_tim' => $ketua_tim,
        	'tgl_surat' => $tgl_surat,
        	'tembusan'  => $tembusan,
        	'tim'       => $this->tim_m->get_sub_tim($key2),
        	'jml_sas'   => $this->tim_m->get_jum_sasaran($key2),
        	'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
        	'tgl_awal'  => $tgl_awal,
        	'tgl_akhir' => $tgl_akhir,
        	'lama_wkt'  => $lama_waktu,
				//'tes'       => "GILAAA"
        	'addPage'       => $pdf->AddPage()
        );


		/*$this->load->view('staff/surat/cetak_surat_pemeriksa', $data);
	    //$this->load->view('welcome_message', $data);
	    $html = ob_get_contents();
	        ob_end_clean();

	        require_once('./assets/html2pdf/html2pdf.class.php');
	    $pdf = new HTML2PDF('P','A4','en');
	    $pdf->WriteHTML($html);
		//$output = 'Surat_Tugas_Pemeriksaan'. $key .'_.pdf';
	    $pdf->Output('Surat_Tugas_Pemeriksaan.pdf', 'I');*/

	    $html = $this->load->view('staff/surat/cetak_surat_pemeriksa', $data, true);
    	//--> render the view into HTML
	    $pdf->WriteHTML($html);
    	//--> write the HTML into the PDF
	    $output = 'Surat_Tugas_Pemeriksaan'. $key .'_.pdf';
	    $pdf->Output($output, 'I');
	}

	//--> cetak surat tugas
	public function cetak_surat_tugas_tl($no_surat, $id_tim)
	{
		$pdf = $this->pdf->load_surat();

		$key  = base64_decode($no_surat);
		$key2 = base64_decode($id_tim);

		$surat = $this->surat_m->get_surat2($key);

		//--> dari tanggal s/d tanggal
		$bln1 = date('m', strtotime($surat->tgl_awal));
		$bln2 = date('m', strtotime($surat->tgl_akhir));
		if($bln1 == $bln2)
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal));
		}
		else
		{
			$tgl_awal = date('d', strtotime($surat->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_awal)));
		}
		$tgl_akhir = date('d', strtotime($surat->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($surat->tgl_akhir))) ." ". date('Y', strtotime($surat->tgl_akhir));

		//--> tgl surat tugas
		$tgl_surat = date('d', strtotime($surat->tgl_surat)) ." ".
		get_nama_bulan(date('m', strtotime($surat->tgl_surat))) ." ".
		date('Y', strtotime($surat->tgl_surat));

		//--> lama waktu pelaksanaan
		$tgl1 = new Datetime($surat->tgl_awal);
		$tgl2 = new Datetime($surat->tgl_akhir);
		$daterange = new DatePeriod($tgl1, new DateInterval('P1D'), $tgl2);
		$i=0; $x=0; $tgl2=1;
		foreach($daterange as $date)
		{
			$daterange = $date->format("Y-m-d");
			$datetime  = DateTime::createFromFormat("Y-m-d", $daterange);
			$day = $datetime->format("D");
			if($day != "Sun" && $day != "Sat"){ $x += $tgl2-$i; }
			$tgl2++;
			$i++;
		}
		$lama_waktu = $x+1;

    /*$awal  = date_create($surat->tgl_awal);
    $akhir = date_create($surat->tgl_akhir);
    $diff  = date_diff($awal, $akhir);
    $lama_waktu = $diff->d +1;*/

    $tembusan  = $this->db->order_by('tes','asc')->get_where('sub_surat', array('sub_no_surat' => $key))->result();

		//--> get ketua tim & dalnis
    $tim = $this->tim_m->get_row_tim($key2);
    $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->ketua_tim))->row();
		/*$dalnis 	 = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->dalnis))->row();
		$daltu 	   = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->daltu))->row();*/

		$data = array(
			'data'      => $surat,
			'cek_tim'		=> $tim,
				/*'daltu'		  => $daltu,
				'dalnis'		=> $dalnis,*/
				'ketua_tim'	=> $ketua_tim,
				'tgl_surat' => $tgl_surat,
				'tembusan'	=> $tembusan,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'jml_sas'   => $this->tim_m->get_jum_sasaran($key2),
				'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'lama_wkt'  => $lama_waktu,
				'addPage'		=> $pdf->AddPage()
			);

		$html = $this->load->view('staff/surat/cetak_surat_tl', $data, TRUE);
    //--> render the view into HTML
		$pdf->WriteHTML($html);
    //--> write the HTML into the PDF
		$output = 'Surat_Tugas_Tim_Tindak_Lanjut'. $key .'_.pdf';
		$pdf->Output($output, 'I');
	}

} ?>

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
		$this->load->model('staff/instansi_m');

		//--> hak akses
		$hak_akses = $this->session->userdata('lvl');
		if($hak_akses!='ketua_tl')
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
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$kt = $this->login_model->get_pegawai($this->session->userdata('username'));

		$data = array(
			'user'     	=> $get_akun,
			'level'	   	=> $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
			'notif'		=> $this->notifikasi_m->notif_staff(),
			'title'		=> 'Tindak Lanjut [KETUA TIM TL]',
			'tl' 	 	=> $this->tindak_lanjut_m->get_tugas_kt($kt->id_pegawai)
		);

		$this->load->view('ketua_tl/tindak_lanjut/list_tl', $data);
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
		$jml_sas   = $this->tim_m->get_jum_sasaran($key2);

		$tbl_tl = $this->tindak_lanjut_m->get_tbl_tl($key);

		$tbl_temuan = $this->tindak_lanjut_m->get_detail_temuan($tbl_tl->id_temuan);

		if($tbl_temuan->kat_file_lhp == '1') {
			// ambil file di table temuan
			$get_lhp = $this->tindak_lanjut_m->get_detail_temuan($tbl_tl->id_temuan);
		}
		else {
			// ambil file di tabel lhp
			$get_lhp = $this->tindak_lanjut_m->get_file_lhp_in_lhp($tbl_temuan->no_lhp);
		}

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [KETUA TIM TL]',
				'data'      => $penugasan,
				'ketua_tim'	=> $ketua_tim,
				'tgl_tl'    => $tgl_tl,
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'jml_sas' 	=> $jml_sas,
				'lhp'		=> $get_lhp,
				'cek_tl1'   => $this->tindak_lanjut_m->get_tbl_tl($key),
				'temuan'    => $this->tindak_lanjut_m->get_detail_temuan($penugasan->id_temuan),
			);

		$this->load->view('ketua_tl/tindak_lanjut/detail_tl', $data);
	}

	//--> detail penugasan
	public function detail_tugas_tl($id_tl, $no_lhp)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($no_lhp);

		$data_tl = $this->tindak_lanjut_m->get_sub_row_tl1($key, $key2);

		$tgl_tl  = date('d', strtotime($data_tl->tgl_tl1)) ." ".
							 get_nama_bulan(date('m', strtotime($data_tl->tgl_tl1))) ." ".
							 date('Y', strtotime($data_tl->tgl_tl1));

		$tgl_lhp = date('d', strtotime($data_tl->tgl_lhp)) ." ".
							 get_nama_bulan(date('m', strtotime($data_tl->tgl_lhp))) ." ".
							 date('Y', strtotime($data_tl->tgl_lhp));

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		 	=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [KETUA TIM TL]',
				'data'      => $data_tl,
				'tgl_tl'    => $tgl_tl,
				'tgl_lhp'   => $tgl_lhp,
				'sub_tl2'   => $this->tindak_lanjut_m->get_sub_tl2($key, $key2),
				'kat_fix'   => $this->tindak_lanjut_m->get_sub_tl2_kat_fix($key, $key2)
			);

		$this->load->view('ketua_tl/tindak_lanjut/detail_tugas_tl', $data);
	}

	function download_lhp($file)
	{
		$nmfile = base64_decode($file);
		force_download('assets/lhp/'.$nmfile, NULL);
	}

	public function tambah_tl($id_temuan)
    {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user'      => $get_akun,
			'level'     => $get_akun,
			'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
    		'notif'		=> $this->notifikasi_m->notif_staff(),
			'title'     => 'Tindak Lanjut [KETUA TIM TL]',
            'temuan'    => $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
            'aspeks'    => $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
        );

        //print "<pre>"; print_r($data); die;

        //print "<pre>"; print_r($this->tindak_lanjut_m->get_lhp($kt->id_pegawai)); die;

        $this->load->view('ketua_tl/tindak_lanjut/form_tambah_tl2', $data);
    }

    public function submit_tl()
    {
       	$this->tindak_lanjut_m->update_input_ketua_tl($this->input->post('id_temuan'));

        // print_r();exit;

        if(count($_POST['uraian_tindak_lanjut'])>0){
        	$i=0;
	        $where=[];
	        $data=[];
			foreach($_POST['uraian_tindak_lanjut'] as $utl)
			{
				echo $_POST['id_temuan_rekomendasi'][$i].'<br>';
				$data['uraian_tindak_lanjut']=$_POST['uraian_tindak_lanjut'][$i];
				$where['id_temuan_rekomendasi'] = $_POST['id_temuan_rekomendasi'][$i];
				$this->db->update('tb_temuan_rekomendasi',$data,$where);
				$i++;
			}
	      }

    	echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
					<button type='button' class='close' data-dismiss='alert'>
						<i class='ace-icon fa fa-times'></i>
					</button>
					<p>
						<strong>
							<i class='ace-icon fa fa-check'></i>
							Berhasil Tambah Tindak Lanjut Entitas yang Diperiksa!
						</strong>
						Data Tindak Lanjut Entitas yang Diperiksa telah ditambahkan!
					</p>
				</div>"
            );

    	redirect('ketua_tl/tindak_lanjut');
   	}
	//--> tambah tindak lanjut
	public function tambah_tl2($id_tl, $no_lhp)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($no_lhp);

		$data = $this->tindak_lanjut_m->get_row_lhp2($key, $key2);

		$data = array(
			'user'    	=> $get_akun,
	        'level'	  	=> $get_akun,
	        'title'		=> 'Tindak Lanjut [KETUA TIM TL]',
	        'data'      => $data,
		);

		$this->load->view('ketua_tl/tindak_lanjut/form_tambah_tl', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$key  = base64_encode($this->input->post('id_tl'));
			$key2 = base64_encode($this->input->post('no_lhp'));

			$this->tindak_lanjut_m->insert_tl2();
			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
				"<div class='alert alert-block alert-success'>
				<button type='button' class='close' data-dismiss='alert'>
				<i class='ace-icon fa fa-times'></i>
				</button>

				<p>
				<strong>
				<i class='ace-icon fa fa-check'></i>
				Berhasil Tambah Tindak Lanjut!
				</strong>
				Data tindak lanjut telah ditambahkan, cek data tersebut di bawah ini.
				</p>
				</div>"
			);

			redirect('ketua_tl/tindak_lanjut/detail_tugas_tl/'.$key.'/'.$key2);

			/*$id_tl  = $this->input->post('id_tl');
			$id_tgs = $this->input->post('id_tgs');
			$id_tim = $this->input->post('id_tim');
			$no_lhp = $this->input->post('no_lhp');

			$jml1 = str_replace(".", "", $this->input->post('jml_kas_negara'));
			$set1 = str_replace(".", "", $this->input->post('setor_kas_negara'));
			$jml2 = str_replace(".", "", $this->input->post('jml_kas_daerah'));
			$set2 = str_replace(".", "", $this->input->post('setor_kas_daerah'));
			$jml3 = str_replace(".", "", $this->input->post('jml_kas_desa'));
			$set3 = str_replace(".", "", $this->input->post('setor_kas_desa'));
			$nm   = $this->input->post('nama_pejabat');
			$nip  = $this->input->post('nip_pejabat');

			$jmlUri = $this->input->post('jml_uri')-1;
			$uriTm  = $this->input->post('uraian_temuan');
			$kdTm   = $this->input->post('kode_temuan');
			$uriRk  = $this->input->post('uraian_rekomendasi');
			$kdRk   = $this->input->post('kode_rekomendasi');
			$uriTl  = $this->input->post('uraian_tl');
			//$kdTl   = $this->input->post('kategori');
			$ket    = $this->input->post('keterangan');

			######################################
			# TB SUB TL 2
			######################################
			echo " <br/>
			<p> TABEL SUB TL 2 </p>
			<table border='1'>
				<tr>
					<th align='center'> SUB TL 2 </th>
					<th align='center'> NO </th>
					<th align='center'> URAIAN TEMUAN </th>
					<th align='center'> KODE TEMUAN </th>
					<th align='center'> URAIAN REKOMENDASI </th>
					<th align='center'> KODE REKOMENDASI </th>
					<th align='center'> URAIAN TL </th>
					<th align='center'> KATEGORI </th>
					<th align='center'> KET </th>
				</tr>

				<tr><td colspan='6'>&nbsp;</td></tr>
			";

			$i = 0;

			//--> kode temuan
			$kod101 = 0;
			$kod102 = 0;
			$kod103 = 0;
			$kod104 = 0;
			$kod105 = 0;
			$kod201 = 0;
			$kod202 = 0;
			$kod203 = 0;
			$kod301 = 0;
			$kod302 = 0;
			$kod303 = 0;

			//--> kode rekomendasi
			$kod00 = 0;
			$kod01 = 0;
			$kod02 = 0;
			$kod03 = 0;
			$kod04 = 0;
			$kod05 = 0;
			$kod06 = 0;
			$kod07 = 0;
			$kod08 = 0;
			$kod09 = 0;
			$kod10 = 0;
			$kod11 = 0;
			$kod12 = 0;
			$kod13 = 0;
			$kod14 = 0;
			while($i < $jmlUri)
			{
				$no = $i+1;

				// kode temuan
				if($kdTm[$i] == "101")
				{ $kod101 += 1; }
				if($kdTm[$i] == "102")
				{ $kod102 += 1; }
				if($kdTm[$i] == "103")
				{ $kod103 += 1; }
				if($kdTm[$i] == "104")
				{ $kod104 += 1; }
				if($kdTm[$i] == "105")
				{ $kod105 += 1; }
				if($kdTm[$i] == "201")
				{ $kod201 += 1; }
				if($kdTm[$i] == "202")
				{ $kod202 += 1; }
				if($kdTm[$i] == "203")
				{ $kod203 += 1; }
				if($kdTm[$i] == "301")
				{ $kod301 += 1; }
				if($kdTm[$i] == "302")
				{ $kod302 += 1; }
				if($kdTm[$i] == "303")
				{ $kod303 += 1; }

				// kode rekomendasi
				if($kdRk[$i] == "00")
				{ $kod00 += 1; }
				if($kdRk[$i] == "01")
				{ $kod01 += 1; }
				if($kdRk[$i] == "02")
				{ $kod02 += 1; }
				if($kdRk[$i] == "03")
				{ $kod03 += 1; }
				if($kdRk[$i] == "04")
				{ $kod04 += 1; }
				if($kdRk[$i] == "05")
				{ $kod05 += 1; }
				if($kdRk[$i] == "06")
				{ $kod06 += 1; }
				if($kdRk[$i] == "07")
				{ $kod07 += 1; }
				if($kdRk[$i] == "08")
				{ $kod08 += 1; }
				if($kdRk[$i] == "09")
				{ $kod09 += 1; }
				if($kdRk[$i] == "10")
				{ $kod10 += 1; }
				if($kdRk[$i] == "11")
				{ $kod11 += 1; }
				if($kdRk[$i] == "12")
				{ $kod12 += 1; }
				if($kdRk[$i] == "13")
				{ $kod13 += 1; }
				if($kdRk[$i] == "14")
				{ $kod14 += 1; }

				echo "
					<tr>
						<td> $id_tl </td>
						<td> $no </td>
						<td> $uriTm[$i] </td>
						<td> $kdTm[$i] </td>
						<td> $uriRk[$i] </td>
						<td> $kdRk[$i] </td>
						<td> $uriTl[$i] </td>
						<td> $ket[$i] </td>
					</tr>
				";
				$i++;
			}
			echo "</table> <br/>";

			######################################
			# TB SUB TL 1
			######################################

			$sisa1 = $jml1 - $set1;
			$sisa2 = $jml2 - $set2;
			$sisa3 = $jml3 - $set3;

			echo "
				<p> TABEL SUB TL 1 </p> <hr/>
				<p> ID TL : $id_tl </p>
				<p> ID TGS : $id_tgs </p>
				<p> ID TIM : $id_tim </p>
				<p> NOMOR LHP : $no_lhp </p>
				<p> Tanggal TL : ". date("Y-m-d H:i:s") ."</p> <br/>

				<p> Jumlah Temuan : $jmlUri </p>
				<p> Jumlah Rekomendasi : $jmlUri </p> <br/>

				<p> Jumlah S : $katS </p>
				<p> Jumlah DP : $katDP </p>
				<p> Jumlah B : $katB </p>
				<p> Jumlah CR : $katCR </p> <br/>

				<p> Jumlah 101 : $kod101 </p>
				<p> Jumlah 102 : $kod102 </p>
				<p> Jumlah 103 : $kod103 </p>
				<p> Jumlah 104 : $kod104 </p>
				<p> Jumlah 105 : $kod105 </p>
				<p> Jumlah 201 : $kod201 </p>
				<p> Jumlah 202 : $kod202 </p>
				<p> Jumlah 203 : $kod203 </p>
				<p> Jumlah 301 : $kod301 </p>
				<p> Jumlah 302 : $kod302 </p>
				<p> Jumlah 303 : $kod303 </p>  <br/>

				<p> Jumlah 00 : $kod00 </p>
				<p> Jumlah 01 : $kod01 </p>
				<p> Jumlah 02 : $kod02 </p>
				<p> Jumlah 03 : $kod03 </p>
				<p> Jumlah 04 : $kod04 </p>
				<p> Jumlah 05 : $kod05 </p>
				<p> Jumlah 06 : $kod06 </p>
				<p> Jumlah 07 : $kod07 </p>
				<p> Jumlah 08 : $kod08 </p>
				<p> Jumlah 09 : $kod09 </p>
				<p> Jumlah 10 : $kod10 </p>
				<p> Jumlah 11 : $kod11 </p>
				<p> Jumlah 12 : $kod12 </p>
				<p> Jumlah 13 : $kod13 </p>
				<p> Jumlah 14 : $kod14 </p> <br/>

				<p> Jumlah Kas Negara : $jml1 </p>
				<p> Setor Kas Negara : $set1 </p>
				<p> SISA Kas Negara : $sisa1 </p>
				<p> Jumlah Kas Negara : $jml2 </p>
				<p> Setor Kas Negara : $set2 </p>
				<p> SISA Kas Negara : $sisa2 </p>
				<p> Jumlah Kas Negara : $jml3 </p>
				<p> Setor Kas Negara : $set3 </p>
				<p> SISA Kas Negara : $sisa3 </p> <br/>

				<p> Nama Pejabat : $nm </p>
				<p> NIP Pejabat : $nip </p>
			";*/
		}
	}

	public function detail_tugas_tl2($id_tl, $id_tim)
	{
		$get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

		$key  = base64_decode($id_tl);
		$key2 = base64_decode($id_tim);

		$cek = $this->db->get_where('tb_tindak_lanjut', array('id_tl' => $key))->row();

		$cek2 = $this->db->get_where('tb_surat', array('fk_tim' => $key2))->row();
		$tgl_surat = date('d', strtotime($cek2->tgl_surat)) ." ".
					 get_nama_bulan(date('m', strtotime($cek2->tgl_surat))) ." ".
					 date('Y', strtotime($cek2->tgl_surat));

		$tgl_awal  = date('d', strtotime($cek2->tgl_awal)) ." ".
					 get_nama_bulan(date('m', strtotime($cek2->tgl_awal))) ." ".
					 date('Y', strtotime($cek2->tgl_awal));

		$tgl_akhir = date('d', strtotime($cek2->tgl_akhir)) ." ".
					 get_nama_bulan(date('m', strtotime($cek2->tgl_akhir))) ." ".
					 date('Y', strtotime($cek2->tgl_akhir));

		$penugasan = $this->tindak_lanjut_m->get_row_tl($key);
		$ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_tim))->row();
		$jml_sas   = $this->tim_m->get_jum_sasaran($key2);

		if($jml_sas->jml != 0)
			{ $get_lhp = $this->tindak_lanjut_m->get_lhp($cek->fk_tgs); }
		else
			{ $get_lhp = $this->tindak_lanjut_m->get_row_lhp($cek->fk_tgs); }

		$data = array(
				'user'      => $get_akun,
				'level'     => $get_akun,
				'jml_notif' => $this->notifikasi_m->jml_notif_staff(),
        		'notif'		=> $this->notifikasi_m->notif_staff(),
				'title'     => 'Tindak Lanjut [KETUA TIM TL]',

				'data'      => $penugasan,
				'ketua_tim'	=> $ketua_tim,
				'tgl_surat' => $tgl_surat,
				'tgl_awal'	=> $tgl_awal,
				'tgl_akhir'	=> $tgl_akhir,
				'tim'      	=> $this->tim_m->get_sub_tim($key2),
				'jml_sas' 	=> $jml_sas,
				'lhp'		=> $get_lhp,

				'kt101'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '101'),
	            'kt102'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '102'),
	            'kt103'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '103'),
	            'kt104'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '104'),
	            'kt105'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '105'),
	            'kt201'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '201'),
	            'kt202'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '202'),
	            'kt203'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '203'),
	            'kt301'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '301'),
	            'kt302'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '302'),
	            'kt303'     => $this->tindak_lanjut_m->get_count_kode_temuan($cek->id_temuan, '303'),

	            'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($cek->id_temuan),
	            'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'spi'),
	            'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'e3'),
	            'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($cek->id_temuan, 'kepatuhan'),

	            'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '1'),
	            'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '2'),
	            'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '3'),
	            'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl($cek->id_temuan, '0'),

				'temuan'    => $this->tindak_lanjut_m->get_detail_temuan($cek->id_temuan),
	            'aspek'     => $this->tindak_lanjut_m->get_detail_aspek($cek->id_temuan),
	            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($cek->id_temuan),
			);

		$this->load->view('ketua_tl/tindak_lanjut/detail_tugas_tl', $data);
	}

	public function penentuan_kat()
	{
		$id_tl  = base64_decode($this->input->post('id1'));
		$id_tim = base64_decode($this->input->post('id2'));
		$id_temuan_rekomendasi  = base64_decode($this->input->post('id3'));

		$data = array(
			'id_tl'      => $id_tl,
			'id_tim'     => $id_tim,
			'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
		);

		$this->load->view('ketua_tl/tindak_lanjut/penentuan_kat', $data);

		//--> jika form submit
		if($this->input->post('submit'))
		{
			$id_tl_en  = base64_encode($this->input->post('id_tl'));
			$id_tim_en = base64_encode($this->input->post('id_tim'));

			$this->tindak_lanjut_m->update_status_tl();

			//--> Tampilkan notifikasi berhasil ubah
			echo $this->session->set_flashdata('sukses',
				 "<div class='alert alert-block alert-success'>
						<button type='button' class='close' data-dismiss='alert'>
							<i class='ace-icon fa fa-times'></i>
						</button>

						<p>
							<strong>
								<i class='ace-icon fa fa-check'></i>
								Berhasil ubah Status!
							</strong>
							Status telah berubah, cek data tersebut di bawah ini.
						</p>
					</div>"
			);

			redirect('ketua_tl/tindak_lanjut/detail_tugas_tl2/'.$id_tl_en.'/'.$id_tim_en.'');
		}
	}
    
    public function cetak_temuan($id_temuan)
    {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));

        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        $data = array(
            'user'          => $get_akun,
            'level'         => $get_akun,
            'jml_notif'     => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
            'notif'         => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
            'title'         => 'Detail Temuan [Staff Evaluasi dan Pelaporan]',

            'kt101'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '101'),
            'kt102'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '102'),
            'kt103'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '103'),
            'kt104'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '104'),
            'kt105'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '105'),
            'kt201'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '201'),
            'kt202'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '202'),
            'kt203'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '203'),
            'kt301'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '301'),
            'kt302'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '302'),
            'kt303'     => $this->tindak_lanjut_m->get_count_kode_temuan($id_temuan, '303'),

            'jml_kt'    => $this->tindak_lanjut_m->get_count_kode_temuan_jml($id_temuan),
            'aspek_spi' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'spi'),
            'aspek_e3'  => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'e3'),
            'aspek_kepatuhan' => $this->tindak_lanjut_m->get_count_aspek($id_temuan, 'kepatuhan'),

            'jml_1'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '1'),
            'jml_2'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '2'),
            'jml_3'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '3'),
            'jml_0'     => $this->tindak_lanjut_m->get_count_status_tl($id_temuan, '0'),

            'temuan'        => $this->tindak_lanjut_m->get_detail_temuan($id_temuan),
            'aspek'         => $this->tindak_lanjut_m->get_detail_aspek($id_temuan),
            'temuan_rekomendasi' => $this->tindak_lanjut_m->get_detail_temuan_rekomendasi($id_temuan),
        );


        $pdf = $this->pdf->load_landscape();
        
        $html = $this->load->view('evlap/temuan/cetak_temuan', $data, TRUE);
        //--> render the view into HTML
        $pdf->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            8, // margin_left
            8, // margin right
            5, // margin top
            5, // margin bottom
            9, // margin header
            9); // margin footer
        $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
        $output = 'Temuan_'. $id_temuan .'_.pdf';
        $pdf->Output("$output", 'I');
    }
    
	public function get_status()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
        );

        $this->load->view('ketua_tl/tindak_lanjut/get_status', $data);
    }


    public function get_upload()
    {
        $id_temuan_rekomendasi  = $this->input->post('id1');

        $data = array(
            'id_temuan_rekomendasi' => $id_temuan_rekomendasi,
            'temuan_rekomendasi'    => $this->tindak_lanjut_m->get_rekomendasi_by_id_rek($id_temuan_rekomendasi),
            'data_upload' => $this->tindak_lanjut_m->get_rekomendasi_upload($id_temuan_rekomendasi),
        );

        $this->load->view('ketua_tl/tindak_lanjut/get_upload', $data);
    }

}

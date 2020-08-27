<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notadinas extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_model');
		$this->auth->cek_auth(); //--> ambil auth dari library
    $this->load->library('form_validation');

		//--> load model
    $this->load->model('notifikasi_m');
    $this->load->model('staff/penugasan_m');
    $this->load->model('staff/tim_m');
    $this->load->model('staff/surat_m');
    $this->load->model('staff/rev_instansi_m');
    $this->load->model('staff/instansi_m');
    $this->load->model('irban/notadinas_m');


		//--> hak akses
    $hak_akses = $this->session->userdata('jbtn');
    if($hak_akses!='irban')
    {
     echo "<script>alert('Anda tidak berhak mengakses halaman ini!!');</script>";
     redirect('log_in','refresh');
     exit();
   }
		// ./hak akses
 }

	//--> list Nota Dinas
 public function index()
 {
  $get_akun  = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
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
   'title'        => 'Nota Dinas [IRBAN]',
   'tugas'        => $this->notadinas_m->get_notadinas($kt->id_pegawai)
 );
       // print "<pre>"; print_r($data); die;
  $this->load->view('irban/notadinas/list_notadinas', $data);
}

	//--> tambah penugasan
public function tambah_notadinas() {
  $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
  $no_urut = 0;
  $id_nd = $this->notadinas_m->get_id_max_tugas();
  $id_tim = $this->tim_m->get_id_max_tim();
  $nu = $this->surat_m->get_no_urut();
  $no_urut = $nu->no_urut + 1;
        //--> nomor urut surat tugas
  if ($no_urut == 1) {
    $no = "01";
  } elseif ($no_urut == 2) {
    $no = "02";
  } elseif ($no_urut == 3) {
    $no = "03";
  } elseif ($no_urut == 4) {
    $no = "04";
  } elseif ($no_urut == 5) {
    $no = "05";
  } elseif ($no_urut == 6) {
    $no = "06";
  } elseif ($no_urut == 7) {
    $no = "07";
  } elseif ($no_urut == 8) {
    $no = "08";
  } elseif ($no_urut == 9) {
    $no = "09";
  } else {
    $no = $no_urut;
  }

  $tgl = date('d') . " " . get_nama_bulan(date('m')) . " " . date('Y');

  $data = array(
    'user' => $get_akun,
    'level' => $get_akun,
    'title' => 'Tambah Nota Dinas [IRBAN]',
    'id_nd' => $id_nd,
    'id_tim' => $id_tim,
    'no_id' => $no . "/Insp/" . date('Y'),
    'irban' => $this->tim_m->get_irban(),
    'dalnis' => $this->tim_m->get_periksa_dalnis(),
    'pegawai' => $this->tim_m->get_pegawai(),
    'sasaran' => $this->rev_instansi_m->get_rev_instansi(),
    'kecamatan' => $this->instansi_m->get_all_instansi(),
    'desa' => $this->instansi_m->get_all_desa(),

    'tgl' => $tgl,
    'no_urut' => $no_urut,
    'nomor' => $no . "/Insp/" . date('Y'),

  );
        // var_dump($data);
        // print_r($data);
            //--> jika form submit
  if ($this->input->post('submit')) {
    /*print "<pre>"; print_r($_POST); die;*/
    $this->validasi();

    if ($this->form_validation->run() != FALSE) {

     $this->notadinas_m->insert_notadinas();
                       // print "<pre>"; print_r($data); die;
                        //--> Tampilkan notifikasi berhasil ubah
     echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
      <button type='button' class='close' data-dismiss='alert'>
      <i class='ace-icon fa fa-times'></i>
      </button>

      <p>
      <strong>
      <i class='ace-icon fa fa-check'></i>
      Berhasil Tambah Penugasan!
      </strong>
      Data penugasan telah ditambahkan, cek data tersebut di bawah ini.
      </p>
      </div>"
    );
     redirect('irban/notadinas');
   } else {

            //print "<pre>"; print_r($data); die;

    $this->load->view('irban/notadinas/form_notadinas', $data); 
  }


} else {
  $this->load->view('irban/notadinas/form_notadinas', $data);
}

}

  //--> form ubah notadinas
public function ubah_notadinas($id)
{
  $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
  $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

  $penugasan = $this->notadinas_m->get_row_penugasan($id);
  $daltu = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->daltu_id_pegawai))->row();
  $dalnis = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->dalnis_id_pegawai))->row();
  $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->ketua_id_pegawai))->row();
  /*$irban = $this->db->get_where('tb_pegawai', array('id_pegawai' => $penugasan->irban_id_pegawai))->row();*/
  $tim =  $this->notadinas_m->get_sub_tim($id);
  $jml_agt = $this->tim_m->count_agt($id);
  $sasaran = $this->notadinas_m->get_sub_sasaran($id);
  $null_sasaran = $this->notadinas_m->get_sub_sasaran_null($id);
  $jml_sas = $this->notadinas_m->get_jum_sasaran($id);
  /*print "<pre>"; print_r($sasaran); die;*/

  $data = array(
    'user'         => $get_akun,
    'level'        => $get_akun,
    'jml_notif'    => $this->notifikasi_m->jml_notif_ketua($kt->id_pegawai),
    'notif'        => $this->notifikasi_m->notif_ketua($kt->id_pegawai),
    'jml_notifAgr' => $this->notifikasi_m->jml_notif_ketuaAgr($kt->id_pegawai),
    'notifAgr'     => $this->notifikasi_m->notif_ketuaAgr($kt->id_pegawai),
    'jml_notifPka' => $this->notifikasi_m->jml_notif_ketuaPka($kt->id_pegawai),
    'notifPka'     => $this->notifikasi_m->notif_ketuaPka($kt->id_pegawai),
    'title'        => 'Nota Dinas [IRBAN]',
    'irban' => $this->tim_m->get_irban(),
    'pegawai' => $this->tim_m->get_all_pegawai(),
    'dalnis' => $dalnis,
    'daltu' => $daltu,
    'ketua_tim' => $ketua_tim,
    'tim' =>    $tim,
    'jml_agt' => $jml_agt,
    'sasaran' => $sasaran,
    'null_sasaran' => $null_sasaran,
    'jml_sas' => $jml_sas,

    'desa' => $this->instansi_m->get_all_desa(),
    'tugas'     => $this->notadinas_m->get_notadinas($kt->id_pegawai)

  );
  $data['notadinass'] = $this->notadinas_m->get_by_id($id);
   $this->load->view('irban/notadinas/form_ubah_notadinas', $data);
  if ($this->input->post('submit')) {
     print "<pre>"; print_r($_POST); die;
    $this->validasiedit();
    $key2 = base64_encode($this->input->post('id_tim'));

    if ($this->form_validation->run() == FALSE)
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
              'title'        => 'Nota Dinas [IRBAN]',
              'tugas'        => $this->notadinas_m->get_notadinas($kt->id_pegawai)
            );
            $this->load->view('irban/notadinas/form_ubah_notadinas', $data);

          }
          else
          {
           
            $this->notadinas_m->update_notadinas();

            echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
              <button type='button' class='close' data-dismiss='alert'>
              <i class='ace-icon fa fa-times'></i>
              </button>

              <p>
              <strong>
              <i class='ace-icon fa fa-check'></i>
              Berhasil Merubah Data Notadinas!
              </strong>
              Notadinas telah ditambahkan, cek data tersebut di bawah ini.
              </p>
              </div>"
            );
            redirect('irban/notadinas');

          }

        /*{
            $this->M_identifikasi->update_data();
            $this->session->set_flashdata('flash', 'Dirubah');
            redirect('admin/identifikasi/Produk_daerah');
          }*/ 
        }
      }

      public function detail_notadinas($id)
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
         'title'        => 'Nota Dinas [IRBAN]',
         'tugas'        => $this->notadinas_m->get_notadinas($kt->id_pegawai)
       );
        $data['notadinass'] = $this->notadinas_m->get_by_id($id);
        $this->load->view('irban/notadinas/detail_notadinas', $data);

      }

      function kirim_notadinas()
      {
          $this->notadinas_m->status_notadinas();
          echo $this->session->set_flashdata('sukses', "<div class='alert alert-block alert-success'>
            <button type='button' class='close' data-dismiss='alert'>
            <i class='ace-icon fa fa-times'></i>
            </button>
            <p>
            <strong>
            <i class='ace-icon fa fa-check'></i>
            Berhasil Mengirim Notadinas!
            </strong>
            Cek data tersebut di bawah ini.
            </p>
            </div>"
          );
          redirect('irban/notadinas');
      }


      function cek_notadinas(){

        $this->load->view('irban/notadinas/cetak_notadinas');
      }


      function cek_telaahan_staff(){

        $this->load->view('irban/telaahan_staff/cetak_telaahan_staff');
      }

    //--> cetak surat tugas
      public function cetak_notadinas($id, $id_tim)
      {
        $get_akun = $this->login_model->get_user($this->session->userdata('username'), $this->session->userdata('lvl'));
        $kt = $this->login_model->get_pegawai($this->session->userdata('username'));

        //ob_start();
        $pdf = $this->pdf->load_surat();
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes

/*        //--> dari tanggal s/d tanggal
        $bln1 = date('m', strtotime($notadinas->tgl_awal));
        $bln2 = date('m', strtotime($notadinas->tgl_akhir));
        if($bln1 == $bln2)
        {
            $tgl_awal = date('d', strtotime($notadinas->tgl_awal));
        }
        else
        {
            $tgl_awal = date('d', strtotime($notadinas->tgl_awal)) ." ". get_nama_bulan(date('m', strtotime($notadinas->tgl_awal)));
        }
        $tgl_akhir = date('d', strtotime($notadinas->tgl_akhir)) ." ". get_nama_bulan(date('m', strtotime($notadinas->tgl_akhir))) ." ". date('Y', strtotime($notadinas->tgl_akhir));
*/
        //--> tgl notadinas tugas
/*        $tgl = date('d', strtotime($notadinas->tgl)) ." ".
        get_nama_bulan(date('m', strtotime($notadinas->tgl))) ." ".
        date('Y', strtotime($notadinas->tgl));
*/
        //--> lama waktu pelaksanaan
  /*      $tgl1 = new Datetime($notadinas->tgl_awal);
        $tgl2 = new Datetime($notadinas->tgl_akhir);
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

        $tim = $this->tim_m->get_row_tim($key2);
        $ketua_tim = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->ketua_tim))->row();
        $dalnis      = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->dalnis))->row();
        $daltu     = $this->db->get_where('tb_pegawai', array('id_pegawai' => $tim->daltu))->row();
*/
        //--> tgl Nota Dinas
        $tgl_notadinas   = $this->notadinas_m->get_by_id($id);

        $tgl = date('d', strtotime($tgl_notadinas->tgl)) ." ".
        get_nama_bulan(date('m', strtotime($tgl_notadinas->tgl))) ." ".
        date('Y', strtotime($tgl_notadinas->tgl));

        $data = array(
         'user'         => $get_akun,
         'level'        => $get_akun,
         'title'        => 'Nota Dinas [IRBAN]',
         'tugas'        => $this->notadinas_m->get_notadinas($kt->id_pegawai),
         'notadinass'   => $this->notadinas_m->get_by_id($id),
         'tanggal_notadinas' => $tgl,
         'addPage'       => $pdf->AddPage()

       );
        /* $data['notadinass'] = $this->notadinas_m->get_by_id($id);
       $data = array(
            'title'         => 'TES',
            'data'      => $notadinas,
             'cek_tim'       => $tim,
            'daltu'     => $daltu,
            'dalnis'        => $dalnis,
            'ketua_tim' => $ketua_tim,
            'tgl' => $tgl,
            'tim'       => $this->tim_m->get_sub_tim($key2),
            'jml_sas'   => $this->tim_m->get_jum_sasaran($key2),
            'sasaran'   => $this->tim_m->get_sub_sasaran($key2),
            'tgl_awal'  => $tgl_awal,
            'tgl_akhir' => $tgl_akhir,
            'lama_wkt'  => $lama_waktu,
                //'tes'       => "GILAAA"
            'addPage'       => $pdf->AddPage()
          );*/


          $html = $this->load->view('irban/notadinas/cetak_notadinas', $data, true);
        //--> render the view into HTML
          $pdf->WriteHTML($html);
        //--> write the HTML into the PDF
          $output = 'Nota Dinas_.pdf';
          $pdf->Output($output, 'I');
        }

        public function validasi()
        {

          $this->form_validation->set_rules('tgl', 'Tanggal Nota Dinas', 'trim|required|min_length[3]');
   /* $this->form_validation->set_rules('nomor', 'Urusan', 'required');
 $this->form_validation->set_rules('daltu', 'Wakil Penanggung Jawab', 'required');
    $this->form_validation->set_rules('dalnis', 'Pengendali Teknis', 'required');
    $this->form_validation->set_rules('ketua_tim', 'Ketua Tim', 'required');
    $this->form_validation->set_rules('anggota', 'Anggota', 'required');
    $this->form_validation->set_rules('hal', 'Hal Nota Dinas', 'required');
    $this->form_validation->set_rules('nama_objek', 'Objek Pengawasan', 'required');
    $this->form_validation->set_rules('sasaran_peng', 'Sasaran Pengawasan', 'required');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'required');
    $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');
    $this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
    $this->form_validation->set_rules('isi_nota', 'Isi Nota', 'required');  */  

  }

  public function validasiedit()
  {

    $this->form_validation->set_rules('tgl', 'Tanggal Nota Dinas', 'trim|required|min_length[3]');
   /* $this->form_validation->set_rules('nomor', 'Urusan', 'required');
 $this->form_validation->set_rules('daltu', 'Wakil Penanggung Jawab', 'required');
    $this->form_validation->set_rules('dalnis', 'Pengendali Teknis', 'required');
    $this->form_validation->set_rules('ketua_tim', 'Ketua Tim', 'required');
    $this->form_validation->set_rules('anggota', 'Anggota', 'required');
    $this->form_validation->set_rules('hal', 'Hal Nota Dinas', 'required');
    $this->form_validation->set_rules('nama_objek', 'Objek Pengawasan', 'required');
    $this->form_validation->set_rules('sasaran_peng', 'Sasaran Pengawasan', 'required');
    $this->form_validation->set_rules('kecamatan', 'Kecamatan', 'required');
    $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'required');
    $this->form_validation->set_rules('tgl_akhir', 'Tanggal Akhir', 'required');
    $this->form_validation->set_rules('lampiran', 'Lampiran', 'required');
    $this->form_validation->set_rules('isi_nota', 'Isi Nota', 'required');  */  

  }
}
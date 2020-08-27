<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_in extends CI_Controller {

	function __construct()
  {
    parent::__construct();
    $this->load->model('login_model'); //memasukkan file model m_login.php
    //--> load model
  }

	public function index()
	{
		$session = $this->session->userdata('isLogin'); //mengabil dari session apakah sudah login atau belum
    if($session == FALSE) //jika session false maka akan menampilkan halaman login
    {
      $sub_data['not_level'] = $this->session->userdata('not_level');
     	$sub_data['wrong']     = $this->session->userdata('wrong');
      $sub_data['empty']     = $this->session->userdata('empty');

      $this->session->unset_userdata('not_level');
      $this->session->unset_userdata('wrong');
      $this->session->unset_userdata('empty');

			$this->load->view('login', $sub_data);
    }
    else //jika session true maka di redirect ke home aktor
    {

      $stat = $this->session->userdata('lvl');
      $stat_jbtn = $this->session->userdata('jbtn');

      if($stat_jbtn == 'irban')
      {
        redirect('irban/home');
      }/*elseif($stat_jbtn == 'inspektur')
      {
        redirect('inspektur/home');
      }elseif($stat_jbtn == 'sekretaris')
      {
        redirect('sekretaris/home');
      }elseif($stat_jbtn == 'adum')
      {
        redirect('adum/home');
      }*/


      else {
        if($stat=='adm')
        {
          redirect('adm/home');
        }
        elseif($stat=='staff')
        {
          redirect('staff/home');
        }
        elseif($stat=='adum')
        {
          redirect('adum/home');
        }
        elseif($stat=='sekretaris')
        {
          redirect('sekretaris/home');
        }
        elseif($stat=='daltu')
        {
          redirect('daltu/home');
        }
        elseif($stat=='dalnis')
        {
          redirect('dalnis/home');
        }
        elseif($stat=='ketua_tim')
        {
          redirect('home');
        }
        elseif($stat=='ketua_nd')
        {
          redirect('home');
        }
        elseif($stat=='anggota_tim')
        {
          redirect('home');
        }
        elseif($stat=='ketua_tl')
        {
          redirect('home');
        }
        elseif($stat=='anggota_tl')
        {
          redirect('home');
        }
        elseif($stat=='inspektur')
        {
          redirect('inspektur/home');
        }
        elseif($stat=='evlap')
        {
          redirect('evlap/home');
        }
        elseif($stat=='staff_evlap')
        {
          redirect('staff_evlap/home');
        }
      }
    }
  }

  function cek_login()
  {
    $username = $this->input->post("username");
    $password = $this->input->post("password");

    if($username == "" || $password == "")
    {
      $empty="
          <div class='alert alert-danger' >
            <h4><i class='fa fa-warning'></i> Peringatan!</h4> Username atau password kosong. <br/> Harap isi username atau password.
          </div>";
      $this->session->set_userdata('empty',$empty);

      redirect('log_in');
    }
    else
    {
      $cek = $this->login_model->cek_user($username, $password); //melakukan persamaan data dengan database

      
      if(count($cek) == 1) //cek data berdasarkan username & pass
      {
        foreach ($cek as $cek) {
            $level = $cek['level']; //mengambil data(level/hak akses) dari database
            $id_user = $cek['id_user'];
            $jenis_jabatan = $cek['jenis_jabatan']; //mengambil data(level/hak akses) dari database
        }

        if($level != NULL)
        {
          $this->session->set_userdata(array(
            'isLogin'   => TRUE,        //set data telah login
            'username'  => $username,   //set session username
            'lvl'       => $level,      //set session hak akses
            'id_user'   => $id_user,     //set session id_user
            'jbtn'       => $jenis_jabatan      //set session hak akses
          ));

          redirect('log_in', 'refresh');  //redirect ke halaman dashboard
        }elseif($jenis_jabatan == 'irban' || $jenis_jabatan == 'adum')
          {
            $this->session->set_userdata(array(
              'isLogin'   => TRUE,        //set data telah login
              'username'  => $username,   //set session username
              'lvl'       => $level,      //set session hak akses
              'jbtn'       => $jenis_jabatan,      //set session hak akses
              'id_user'   => $id_user     //set session id_user
            ));

            redirect('log_in', 'refresh');  //redirect ke halaman dashboard
          }
        else
        {
          $not_level="
              <div class='alert alert-danger'>
                  <h4><i class='fa fa-warning'></i> Gagal Masuk!</h4> Pengguna tidak dalam penugasan. <br/> Harap hubungi administrator.
              </div>";
          $this->session->set_userdata('not_level',$not_level);

          redirect('log_in');
        }        
      }
      else
      { //jika data tidak ada yng sama dengan database
        $wrong="
            <div class='alert alert-danger'>
                <h4><i class='fa fa-warning'></i> Gagal Masuk!</h4> Username atau password salah/tidak terdaftar. <br/> Coba lagi..
            </div>";
        $this->session->set_userdata('wrong',$wrong);

        redirect('log_in');
      }
    }
  }

  function logout()
  {
    $this->session->sess_destroy();
    redirect('log_in','refresh');
  }

}

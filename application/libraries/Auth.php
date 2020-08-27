<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth {
   public function cek_auth()
	{
		$this->ci =& get_instance();
		$this->sesi 	= $this->ci->session->userdata('isLogin');
		$this->hak 		= $this->ci->session->userdata('stat');

		if($this->sesi != TRUE)
		{
      echo "<script>alert('Anda belum login!');</script>";
			redirect('log_in','refresh');
			exit();
		}
	}

}
 
/* End of file Someclass.php */
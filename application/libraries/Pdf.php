<?php

//include_once APPPATH.'/third_party/mpdf/mpdf.php';
class Pdf {
	protected $CI;
	public $param;
    public $pdf;
 
    /*public function __construct($param = '"en-GB-x","F4",0,"",5,5,6,4,6,6')
    {
        $this->param =$param;
        $this->pdf2 = new mPDF($this->param);
    }*/
 
	/*public function __construct()	
	{
        $CI = &get_instance(); 
		log_message('Debug', 'mPDF class is loaded.'); 
	}*/

  //--> lebar surat
  /*function load_surat($param = '"en-GB-x","F4", 0,"",15,15,5,4,9,9') {
    //require_once APPPATH .'third_party/mpdf/mpdf.php';  
    $this->param =$param;
    return new mPDF($this->param);
  }*/
  
  function load_surat() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', 'Folio', 0,'',9,9,3,3,6,6);
  }

  //--> lebar surat
  function load_surat2() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', 'F4', 0,'',10,10,4,4,9,9);
  }

  function load_landscape() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', 'F4', 0,'',10,10,4,4,9,9,'L');
  }

  //--> lebar surat
  function load_f4() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', 'F4', 0,'',20,5,6,8,9,9);
  }

  //--> lebar disposisi
  function load_kartu_penugasan() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', array(180,180), 0,'',5,5,6,4,6,6 );
  }
   
  function load_km2() {
    require_once APPPATH .'third_party/mpdf/mpdf.php';
    
    return new mPDF('en-GB-x', array(200,180), 0,'',5,5,6,4,6,6 );
  } 
} ?>
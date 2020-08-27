<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Tes extends CI_Controller {
 
    public function index()
    {
        $data = [];
        //load the view and saved it into $html variable
        $html=$this->load->view('print', $data, true);
 
        //this the the PDF filename that user will get to download
        $pdfFilePath = "output_pdf_name.pdf";
 
        //load mPDF library
        //$this->load->library('m_pdf');
 
       //generate the PDF from the given html
        $this->pdf->pdf2->WriteHTML($html);
 
        //download it.
        $this->pdf->pdf2->Output($pdfFilePath, "I");        
    }
	
	public function cetak()
    {
	    ob_start();
	    $data['siswa'] = "TES AJA!"; //$this->siswa_model->view_row();
	    $this->load->view('welcome_message', $data);
	    $html = ob_get_contents();
	        ob_end_clean();
	        
	        require_once('./assets/html2pdf/html2pdf.class.php');
	    $pdf = new HTML2PDF('P',array(210,330),'en');
	    $pdf->WriteHTML($html);
	    $pdf->Output('Data Siswa.pdf', 'I');
	  }
}
 
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
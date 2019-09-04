<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class VendorReport extends my_controller {
function __construct(){
   parent::__construct();
  $this->load->model('model_vendor_report');
$this->load->model('model_admin_login');
$this->load->library('pagination'); 
}     


//===========================================================================================


public function vendorbyreport(){
	if($this->session->userdata('is_logged_in')){
		 		      ////Pagination start ///
	  $url   = site_url('/VendorReport/vendorbyreport?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_vendor_report->count_all_tbllog($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/VendorReport/vendorbyreport?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
	$this->load->view('view-vendor-report', $data);
		
	}
	else
	{
	redirect('index');
	}		
}

//===========================================================================================

		
}
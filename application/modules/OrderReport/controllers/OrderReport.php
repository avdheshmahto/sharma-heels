<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class OrderReport extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_order_report'); 
   $this->load->library('pagination'); 
}     

public function orderReportlog(){
	if($this->session->userdata('is_logged_in')){
	 		      ////Pagination start ///
	  $url   = site_url('/OrderReport/orderReportlog?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_order_report->count_all($this->input->get());
	  $totalSum  = $this->model_order_report->total_qtys($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/OrderReport/orderReportlog?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
		$data=$this->user_function();// call permission fnctn
		$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page'],'totalSum' => $totalSum);
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $pagination['per_page'];
		$data['page']=$pagination['page'];	
		$this->load->view('order-report-item-by-log', $data);
	}
	else
	{
	redirect('index');
	}
}

//==================================== Add Customer =============================================================================
			
}
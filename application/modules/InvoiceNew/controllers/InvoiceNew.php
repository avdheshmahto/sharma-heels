<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class InvoiceNew extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_salesorder');

}     

public function addInvoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-invoice');
	}
	else
	{
	redirect('index');
	}
}

public function getproduct(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct');
	}
	else
	{
	redirect('index');
	}
}

public function manageInvoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-invoice');
	}
	else
	{
	redirect('index');
	}
}
			
}
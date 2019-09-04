<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class ViewOrder extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_salesorder');

}     

public function viewOrderNat(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('view-order-nat');
	}
	else
	{
	redirect('index');
	}
}
			
}
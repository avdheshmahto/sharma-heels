<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Payment extends my_controller {

function __construct(){
   parent::__construct(); 
    $this->load->model('model_payment');	
}

public function payment_amount(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/invoice-payment');
	}
	else
	{
	redirect('index');
	}	
}

public function edit_payment(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/edit-payment');
	}
	else
	{
	redirect('index');
	}	
}

public function edit_cash_payment(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/edit-payment-cash');
	}
	else
	{
	redirect('index');
	}	
}

public function fetch_state(){
	if($this->session->userdata('is_logged_in')){
		$sqlquery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['ID']."'");
		$rowfetch=$sqlquery->row();
		echo $rowfetch->state."^".$rowfetch->gst."^".$rowfetch->contact_person;
	}
	else
	{
	redirect('index');
	}	
}

public function edit_gstAmt(){
	if($this->session->userdata('is_logged_in')){
		$sqlquery=$this->db->query("select * from tbl_contact_m where contact_id='".$_GET['ID']."'");
		$rowfetch=$sqlquery->row();
		echo $rowfetch->gst;
	}
	else
	{
	redirect('index');
	}	
}

public function view_payment(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/view-payment');
	}
	else
	{
	redirect('index');
	}	
}

public function view_paymentNat(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/view-payment');
	}
	else
	{
	redirect('index');
	}	
}

public function view_payment_cash(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/view-payment-cash');
	}
	else
	{
	redirect('index');
	}	
}


public function view_payment_cashNat(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/view-payment-cash');
	}
	else
	{
	redirect('index');
	}	
}

public function manage_payment(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get_rega();
	$this->load->view('Payment/manage-paymentReg', $data);
	}
	else
	{
	redirect('index');
	}	
}

public function manage_paymentNat(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	  ////Pagination start ///
	  $url   = site_url('/Payment/manage_paymentNat?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_payment->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/Payment/manage_paymentNat?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
	$this->load->view('Payment/manage-paymentNat', $data);
	}
	else
	{
	redirect('index');
	}	
}

public function manage_paymentMad(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get_mad();
	$this->load->view('Payment/manage-paymentMad', $data);
	}
	else
	{
	redirect('index');
	}	
}

//==
public function manage_paymentSeel(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get_seel();
	$this->load->view('Payment/manage-paymentSeel', $data);
	}
	else
	{
	redirect('index');
	}	
}

//==
public function manage_paymentMum(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get_mum();
	$this->load->view('Payment/manage-paymentMum', $data);
	}
	else
	{
	redirect('index');
	}	
}

public function manage_paymentBapa(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get_bapa();
	$this->load->view('Payment/manage-paymentBapa', $data);
	}
	else
	{
	redirect('index');
	}	
}

public function manage_gst_paymentBapa(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_PaymentMad->contact_get();
	$this->load->view('Payment/manage-gst-paymentBapa');
	}
	else
	{
	redirect('index');
	}	
}

public function manage_gst_paymentMum(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_PaymentMad->contact_get();
	$this->load->view('Payment/manage-gst-paymentMum');
	}
	else
	{
	redirect('index');
	}	
}


public function manage_gst_paymentSeel(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_PaymentMad->contact_get();
	$this->load->view('Payment/manage-gst-paymentSeel');
	}
	else
	{
	redirect('index');
	}	
}


public function manage_gst_paymentMad(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_PaymentMad->contact_get();
	$this->load->view('Payment/manage-gst-paymentMad');
	}
	else
	{
	redirect('index');
	}	
}

public function manage_gst_payment(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_payment->contact_get();
	$this->load->view('Payment/manage-gst-paymentReg');
	}
	else
	{
	redirect('index');
	}	
}


public function manage_gst_paymentNat(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	//$data['result'] = $this->model_payment->contact_get();
	$this->load->view('Payment/manage-gst-paymentNat');
	}
	else
	{
	redirect('index');
	}	
}



public function insert_payment(){
@extract($_POST);
$table_name ='tbl_payment_cash';
$pri_col ='invoice_rid';
//$id= $this->input->post('Product_id');
$status='Payment';
$payment_mode='Non Gst';

date_default_timezone_set('Asia/Kolkata');
$dt = new DateTime();
$mdate=$dt->format('d/m/Y H:i:s');	

			$data= array(
					'contact_id' => $this->input->post('customer_name'),
					'total_billamt' =>$this->input->post('amt'),
					'date' => $this->input->post('date'),
					'status' => $status,
					'payment_mode' => $payment_mode,
					'remarks' => $this->input->post('remarks')
			);
			
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> $mdate,
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);

					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
		$this->session->set_flashdata('flash_msg', 'Record Added Successfully.'); 
		 redirect('Payment/manage_paymentNat');

}


public function update_payment(){
@extract($_POST);
$table_name ='tbl_payment_cash';
$pri_col ='invoice_rid';
$id= $this->input->post('payment_id');
$status='Payment';

				$data=array(
					//$datadtl['contact_id'] = $this->input->post('customer_name')[$i];
					'total_billamt' => $this->input->post('amt'),
					'date' => $this->input->post('date'),
					'remarks' => $this->input->post('remarks'),
					
					);
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data);
					
		$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.'); 
		 $url="Payment/view_payment_cash?id=".$contact_id;
		 redirect($url);
		 
}


public function update_invoice_payment(){
@extract($_POST);
$table_name ='tbl_payment_gst';
$pri_col ='invoice_gstid';
$table_name_cash ='tbl_payment_cash';
$pri_col_cash ='invoice_rid';
$id= $this->input->post('payment_id');
$cashId=$payment_cash;
$status='Payment';
if($type=='Payment'){
	$paidamttt=$this->input->post('amt');
}else{
	$paidamttt=$this->input->post('paidamt');
}

				$datagst=array(
					'total_billamt' => $this->input->post('amt'),
					'date' => $this->input->post('date'),
					'status' => $type,
					'remarks' => $this->input->post('remarks'),
					'cgst' => $this->input->post('cgst'),
					'igst' => $this->input->post('igst'),
					'sgst' => $this->input->post('sgst'),
					);
					
				$datacash=array(
					'total_billamt' => $paidamttt,
					'date' => $this->input->post('date'),
					'status' => $type,
					'remarks' => $this->input->post('remarks'),
					);
					
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$datagst);
					$this->Model_admin_login->update_user($pri_col_cash,$table_name_cash,$cashId,$datacash);
		//die;
					
		    	//$this->Model_admin_login->insert_user($table_name,$dataall);
		$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.'); 
		$url="Payment/view_payment?id=".$contact_id;
		 redirect($url);
		 
}

public function insert_gst_payment(){
@extract($_POST);
$table_name ='tbl_payment_gst';
$table_name_cash ='tbl_payment_cash';
$pri_col ='invoice_gstid';
//$id= $this->input->post('Product_id');
//$status='Payment';
$payment_mode='Gst';
//echo $type;die;
if($type=='Payment'){
	$paidamttt=$this->input->post('amt');
}else{
	$paidamttt=$this->input->post('paidamt');
}
//echo $gstamt;die;
			$datagst= array(
					'contact_id' => $this->input->post('customer_name'),
					'total_billamt' => $this->input->post('amt'),
					'date' => $this->input->post('date'),
					'cgst' => $this->input->post('cgst'),
					'igst' => $this->input->post('igst'),
					'sgst' => $this->input->post('sgst'),
					'firm' => $this->input->post('firm'),
					//'amtgst' => $gstamt,
					'status' => $this->input->post('type'),
					'payment_mode' => $payment_mode,
					'remarks' => $this->input->post('remarks')
			);
			
			$datacash= array(
					'contact_id' => $this->input->post('customer_name'),
					'total_billamt' => $paidamttt,
					'date' => $this->input->post('date'),
					//'cgst' => $this->input->post('paidcgst'),
					//'igst' => $this->input->post('paidigst'),
					//'sgst' => $this->input->post('paidsgst'),
					'firm' => $this->input->post('firm'),
					//'amtgst' => $gstamt,
					'status' => $this->input->post('type'),
					'payment_mode' => $payment_mode,
					'remarks' => $this->input->post('remarks')
			);
			
			$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($datagst,$sesio);
		
		$dataacash = array_merge($datacash,$sesio);

					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
				$this->Model_admin_login->insert_user($table_name_cash,$dataacash);
		$this->session->set_flashdata('flash_msg', 'Record Added Successfully.'); 
		 redirect('Payment/manage_gst_payment');
		 
}

public function invoicereport(){

	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Payment/invoice-payment-report');
}
else{
redirect('index');

}
}
public function invoice_correction(){

	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Payment/invoice-payment-correction');
}

else{
redirect('index');

}

}

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class PaymentNat extends my_controller {

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

public function view_paymentNat(){
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Payment/view-payment');
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

public function manage_paymentNat(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_payment->contact_get();
	$this->load->view('Payment/manage-paymentNat', $data);
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



			$data= array(
					'contact_id' => $this->input->post('customer_name'),
					'total_billamt' =>$this->input->post('amt'),
					'drcr' => $this->input->post('drcr'),
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
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$dataall = array_merge($data,$sesio);

					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
		$this->session->set_flashdata('flash_msg', 'Record Added Successfully.'); 
		 redirect('Payment/manage_payment');
/*
if($save!='')
{

	if($date123==''){
$date123=date('d-m-y');}
	$sqlinsert="insert into tbl_invoice_payment set contact_id='$customerfname',receive_billing_mount='$rec_amount12',date='$date123',payment_mode='$payment_mode',maker_id='".$this->session->userdata('user_id')."',maker_date=NOW(),comp_id='".$this->session->userdata('comp_id')."', status='payment'";
$this->db->query($sqlinsert);
$lastHdrId=$this->db->insert_id();
if($invId!='')
{
	$invoiceId=$invId;
}
else
{
	$invoiceId=0;
}
$this->software_log_insert($invoiceId,$customerfname,$rec_amount12,'Payments Received added');

} 






$querySalesQuery=$this->db->query("select *from tbl_sales_order_hdr where salesid='$invId'");
			
		$getSales=$querySalesQuery->row();
			$cont=$getSales->content;
			$contactQuery=$this->db->query("select *from tbl_contact_m where contact_id='$getSales->vendor_id'");
			$getContactName=$contactQuery->row();
			
		$cont1=" 	
<p>&nbsp;</p>
<div style='font-family: 'Times New Roman'; font-size: medium; background: #fbfbfb;'>
<div style='padding: 25.6094px; text-align: center; background: #4190f2;'>
<div style='color: #ffffff; font-size: 20px;'>Invoice # $lastHdrId</div>
</div>
<div style='max-width: 560px; margin: auto; padding: 0px 25.6094px;'>
<div style='padding: 30px 0px; color: #555555; line-height: 1.7;'>Dear $getContact->safi,&nbsp;<br /><br />Your invoice $lastHdrId is attached.

Thank you for your business.&nbsp;</div>
<br />
<div style='padding: 16.7969px 0px; line-height: 1.6;'>Thanks & Regards
<div style='color: #8c8c8c;'>Gaurav Taneja</div>
<div style='color: #b1b1b1;'>Tech Vyas Solutions Pvt Ltd.</div>
<div style='color: #b1b1b1;'>9990455812</div>
</div>
</div>
</div>
<p>&nbsp;</p>";	
			
		
$data = array(
'id' => $invId,
'payment_date' => $date123,
'payment_mode' => $payment_mode,
'amount' => $rec_amount12,
'contact_id' => $customerfname
);

	





 $url="assets/sales_order_pdf/invoice_order'".$id."'.pdf";

	//load the view and saved it into $html variable

		$html=$this->load->view('email', $data, true);



        //this the the PDF filename that user will get to download

		$pdfFilePath =$url;



        //load mPDF library

		$this->load->library('m_pdf');



       //generate the PDF from the given html

		$this->m_pdf->pdf->WriteHTML($html);



        //download it.

		$this->m_pdf->pdf->Output($pdfFilePath, "f");	
$config = Array(
		'mailtype' => 'html',
		'charset' => 'utf-8',
		'wordwrap' => TRUE
		);
		$contName=$getContactName->email;
		$this->load->library('email', $config);
		$this->email->from('info@techvyaserp.in');
		$this->email->to($contName);
		$this->email->to("collestbablu@gmail.com");
		 $this->email->cc('collestbablu@gmail.com');
		$this->email->subject("Payment");
		$this->email->message($cont);
		 $this->email->attach($url);
		$this->email->send();
			





echo "
<script>
alert('Payment Done');
window.location.href='payment_amount';
window.close();
</script>

";
*/
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
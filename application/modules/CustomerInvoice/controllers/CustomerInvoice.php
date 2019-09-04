<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class CustomerInvoice extends my_controller {
function __construct(){
   parent::__construct();
  $this->load->model('model_stock_manage');

}     

public function add_multiple_qty(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-quantity');
	}
	else
	{
	redirect('index');
	}		
}

public function addInvoice(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceNati(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-Nat');
	}
	else
	{
	redirect('index');
	}		
}

//===================================================================

public function manageInvoiceRag(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-rag');
	}
	else
	{
	redirect('index');
	}		
}

public function addPurchaseRag(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('add-purchase-order-rag');
	}
	else
	{
	redirect('index');
	}		
}


public function manageInvoiceMad(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-mad');
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceSeel(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-seel');
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceMum(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-mum');
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceBapa(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-purchase-order-bapa');
	}
	else
	{
	redirect('index');
	}		
}


//===================================================================
public function getsizecounttest(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getsizecountqty');
		
	}
	else
	{
	redirect('index');
	}
}


public function printInvoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('invoice');
		
	}
	else
	{
	redirect('index');
	}
}


public function getordered(){
	if($this->session->userdata('is_logged_in')){
	 $data['id'] = $_GET['id'];
		$this->load->view('getorderedpage',$data);
	}
	else
	{
	redirect('index');
	}
}

public function updateInvoiceOrdered(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('edit-invoice',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function viewInvoiceOrdered(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-purchase-order',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function updateInvoice(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('update-invoice-page',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function print_new_invoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('print-new-invoice');
	}
	else
	{
	redirect('index');
	}		
}

public function invoice_details(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
		$this->load->view('invoice-details',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function salesOrder_details_mail(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('invoice-details-mail');
	}
	else
	{
	redirect('index');
	}		
}


public function insert_invoice(){
		extract($_POST);
		$table_name ='tbl_sales_order_hdr';
		$pri_col ='salesid';
		 $id=$this->input->post('id');
		
		$data = array(
	
					'from' => $this->input->post('from'),
					'send_to' => $this->input->post('send_to'),
					'cc' => $this->input->post('cc'),
					'subject' => $this->input->post('subject'),	
					'content' => $this->input->post('content'),					
					);
					
			$this->load->model('Model_admin_login');	
		    $this->Model_admin_login->update_user($pri_col,$table_name,$id,$data);
			
			$querySalesQuery=$this->db->query("select *from tbl_sales_order_hdr where salesid='$id'");
			
		$getSales=$querySalesQuery->row();
			$cont=$getSales->content;
			
			
			
		
$data = array(
'id' => $id
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
		$data = array(
			 'id' => $_GET['id']
			 );
		$this->load->library('email', $config);
		$this->email->from('info@techvyaserp.in');
		$this->email->to($send_to);
		 $this->email->cc('collestbablu@gmail.com');
		$this->email->subject($subject);
		$this->email->message($cont);
		 $this->email->attach($url);
		if ($this->email->send()) {
			
			  echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";

			//redirect("salesorder/SalesOrder/manageSalesOrder");
		} else {
	//redirect("salesorder/SalesOrder/manageSalesOrder");
		
		  echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";

		}
			
}




public function testdrop(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('test');
	}
	else
	{
	redirect('index');
	}		
}


public function edit_sales_order(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-sales-order');
	}
	else
	{
	redirect('index');
	}		
}

	
public function manageSalesOrder(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	///$data['result'] = $this->model_salesorder->salesorder_data();
	$this->load->view('manage-sales-order',$data);
	}
	else
	{
	redirect('index');
	}	
}

public function invoiceUpdateFun(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr';
		$pri_col ='ordered_invoiceid';		
		$table_name_dtl ='tbl_ordered_invoice_dtl';
		$pri_col_dtl ='ordered_invoiceid_dtl';
		$id=$this->input->post('invoiceid');
		
		   $this->db->query("delete from tbl_ordered_invoice_dtl where ordered_invoiceid='$id'");
		 			
				$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
				);
	
		$data = array(
	
					'invoice_date' => $this->input->post('order_date'),
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');				
			$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);			
			$lastHdrId=$id;					
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				 					
				 $itemsid=$this->input->post('item_id')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
						
						
							}
					}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="CustomerInvoice/CustomerInvoice/manageInvoice";
		redirect($rediectInvoice);	
			   					  								
}
	
	public function invoiceInsert(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr';
		$pri_col ='ordered_invoiceid';
		
		$table_name_dtl ='tbl_ordered_invoice_dtl';
		$pri_col_dtl ='ordered_invoiceid_dtl';
		
		 $order_idds=$this->input->post('order_idd');
				
				$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
				);
	
		$data = array(
	
					'customer_id' => $this->input->post('Customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
						
							}
					}
			
			$this->db->query("update tbl_order_hdr set invoice_status='InvoiceDone' where order_id='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="CustomerInvoice/CustomerInvoice/manageInvoice";
		redirect($rediectInvoice);	
	   					  					
	
	}
	
	function refil_qnty_del($id){
	
		 $data= $this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
		foreach($data->result() as $update){
		$this->db->query("update tbl_product_stock set quantity=quantity+'".$update->quantity."' where   Product_id='".$update->product_id."'");
		  $this->db->query("update tbl_product_serial set quantity=quantity+'".$update->quantity."' where product_id='".$update->product_id."'");
		
		
		}
return;	
	}
	
	
	
	
	public function stock_refill_qty($qty,$main_id,$sizeval)
	{
	
	 $qtycount=sizeof(explode(',', $qty));
	 $sizecount=sizeof(explode(',', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(',', $sizeval);
		  $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $qtynt=$exp[$p];
		  
		   $sumqtynt +=$exp[$p];
		 
		
		  
			$location_id=$this->session->userdata('brnh_id');
									
			$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and location_id='$location_id' and size='$sizent'";
					$selectQuery1=$this->db->query($selectQuery);
						$num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_serial set size='$sizent',quantity=quantity-'$qtynt',location_id='$location_id' where product_id='$main_id' and size='$sizent'");
			
			
		}else{
			  								$comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizent',quantity='$qtynt',location_id='$location_id',product_id='$main_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}

				
	} 

	$this->db->query("update tbl_product_stock set quantity=quantity-'$sumqtynt' where Product_id='$main_id'");

	}
	
	
	function updata_stock($qty,$main_id,$sizeval){
	
		 
	
	 $qtycount=sizeof(explode(',', $qty));
	 $sizecount=sizeof(explode(',', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(',', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $qtynt=$exp[$p];
		 // echo "<br/>";
			   $sumqtynt +=$exp[$p];
		 
		
		
			$location_id=$this->session->userdata('brnh_id');
									
			$selectQuery = "select quantity from tbl_product_serial where product_id='$main_id' and location_id='$location_id' and size='$sizent'";
					$selectQuery1=$this->db->query($selectQuery);
						$num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_serial set size='$sizent',quantity=quantity-'$qtynt',location_id='$location_id' where product_id='$main_id' and size='$sizent'");
			
			
		}else{
			  								$comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizent',quantity='$qtynt',location_id='$location_id',product_id='$main_id',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}

				
	} 
	//echo   $sumqtynt; 
	$this->db->query("update tbl_product_stock set quantity=quantity-'$sumqtynt' where Product_id='$main_id'");

	 
	
	}	
	

public function paymentAmount($grand_total,$vendor_id,$lastHdrId,$id){
	
	$table_name='tbl_invoice_payment';
	$pri_col='invoiceid';
	if($id!=''){
	$lastHdrId=$id;
	}
	else
	{
		$lastHdrId;
	}
	$data_pay = array(
	
					'contact_id' => $vendor_id,
					'receive_billing_mount' => $grand_total,
					'invoiceid' => $lastHdrId,					
					'date' =>date('Y-m-d H:i:s'),
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'comp_id' => $this->session->userdata('comp_id'),
					'status' => 'invoice'					
					
		);
	$this->load->model('Model_admin_login');
	if($id!=''){

		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_pay);
	}else{
		
	$this->Model_admin_login->insert_user($table_name,$data_pay);
	}	
	return paymentAmount; 
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

	
public function all_product_function(){
	
		$this->load->view('all-product',$data);
	
	}

public function viewSalesOrder(){
	if($this->session->userdata('is_logged_in')){
	
	$this->load->view('view-sales-order');
	}
	else
	{
	redirect('index');
	}
		
}



function deleteSalesOrder(){
	$table_name ='tbl_purchase_order_hdr';
	$table_name_dtl ='tbl_purchase_order_dtl';
	$pri_col ='purchase_order_id';	
	$pri_col_dtl ='purchase_order_hdr_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$id_dtl= $_GET['id'];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col_dtl,$table_name_dtl,$id_dtl);
		redirect('CustomerInvoice/managePurchaseOrder');
}

function delete_updata_stock($qty,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity+'$qty' where product_id='$main_id'");
		return;	
	}	
		
}
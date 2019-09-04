<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class SalesOrder extends my_controller {
function __construct(){
   parent::__construct();
   $this->load->model('model_salesorder');

}     

public function viewOrder(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order',$data);
	}
	else
	{
	redirect('index');
	}
}

public function updateOrder(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('update-order',$data);
	}
	else
	{
	redirect('index');
	}
}


//====================================== Order Cancel Function ===================================================================

public function ordercancelfun(){

 $orderid=$_POST['valueone'];
 
 $rmks=$_POST['remaksval'];

$this->load->model('Model_admin_login');

//$this->db->query("update tbl_order_hdr set cancel_status='Cancel' where order_id='$orderid'");

$sqlQ=$this->db->query("Select * from tbl_order_dtl where order_dtl_id='$orderid'");
foreach($sqlQ->result() as $fetchQ){ 

$this->db->query("update tbl_order_dtl set cancel_status='Cancel', remarks='$rmks' where order_dtl_id='$fetchQ->order_dtl_id'");

$var_dtl_Itemid=$fetchQ->item_id;
$var_dtl_Size=$fetchQ->size_name;
$var_dtl_Qty=$fetchQ->qty_name;
$var_dtl_total=$fetchQ->total_qty;

$sqlStockQ=$this->db->query("Select * from tbl_product_stock where Product_id='$var_dtl_Itemid'");
$fetchStock=$sqlStockQ->row();

$tblstock_ActualQty=$fetchStock->quantity;
$tblstock_orderQty=$fetchStock->qtyinstock;
$tblstock_stotalqty=$fetchStock->total_qty;

$dtl_countsizeof=sizeof(explode(' | ', $var_dtl_Size));
$dtl_orderqtyex=explode(' | ', $var_dtl_Qty);

$stock_qtyex=explode(' ', $tblstock_ActualQty);
$stock_ordqty=explode(' ', $tblstock_orderQty);

$out = array();
$ordout = array();
for($i=0;$i<$dtl_countsizeof;$i++){
	$ir=$i+1;
    $sumqty=$stock_qtyex[$i]+$dtl_orderqtyex[$ir];
 	$subordqty=($stock_ordqty[$i])-($dtl_orderqtyex[$ir]);
array_push($out, $sumqty);
array_push($ordout, $subordqty);
}

$sumqtystockkk=implode(' ', $out);
$strinss = $sumqtystockkk;
$strinss . "<br>";
$sumqtyyy=rtrim($strinss,"0");
$subqtyorderrr=implode(' ', $ordout);
$strinssub = $subqtyorderrr;
$strinssub . "<br>";
$subqtyyy=rtrim($strinssub,"0");
$subtotalqty=$tblstock_stotalqty-$var_dtl_total;

//echo $subqtyyy;

$this->db->query("update tbl_product_stock set qtyinstock='$subqtyyy',total_qty='$subtotalqty' where Product_id='$var_dtl_Itemid'");

//$this->db->query("update tbl_product_stock set quantity='$sumqtyyy',qtyinstock='$subqtyyy',total_qty='$subtotalqty' where Product_id='$var_dtl_Itemid'");

//$this->db->query("update tbl_product_serial set quantity='$sumqtyyy',total_qty='$subtotalqty' where product_id='$var_dtl_Itemid'");


}

}

//=============================================================================log===================================================================
public function viewOrderLog(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order-log',$data);
	}
	else
	{
	redirect('index');
	}
}

public function insertorderlog()
{

		extract($_POST);
		$table_name ='tbl_order_note_log';
		$pri_col ='log_id';
				
	
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					
		);
	
		$data = array(
	
					'note_msg' => $this->input->post('note'),
					'order_id' => $this->input->post('orderid'),

					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
										
			$this->session->set_flashdata('flashmsg', 'Order Log Added Successfully.');
				
			 $rediectInvoice="salesorder/SalesOrder/manageorder";
		redirect($rediectInvoice);	
	   					
	
	
}

//============================================================================ reg ====================================================================

public function viewOrderReg(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order-reg',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewOrderMad(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order-mad',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewOrderSeel(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order-seel',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewOrderMum(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('view-order-mum',$data);
	}
	else
	{
	redirect('index');
	}
}


//=======================================================================================================================================================

public function manageorder(){
	if($this->session->userdata('is_logged_in')){
	  ////Pagination start ///
	  $url   = site_url('/salesorder/SalesOrder/manageorder?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_salesorder->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/salesorder/SalesOrder/manageorder?entries='.$_GET['entries']);
      }
      $pagination         = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	  $data               = $this->user_function();// call permission fnctn
	  $data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	  $data['pagination'] = $this->pagination->create_links();
	  $data['per_page']   = $pagination['per_page'];
	  $data['page']       = $pagination['page'];	
	  $this->load->view('manage-order-nat',$data);
	}
	else
	{
	redirect('index');
	}		
}

//===================================================================================
public function manageorderReg(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_salesorder->salesorder_data();
		$this->load->view('manage-order-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageorderMad(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_salesorder->salesorder_data();
		$this->load->view('manage-order-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageorderSeel(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_salesorder->salesorder_data();
		$this->load->view('manage-order-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageorderMum(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_salesorder->salesorder_data();
		$this->load->view('manage-order-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageorderBapa(){
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_salesorder->salesorder_data();
		$this->load->view('manage-order',$data);
	}
	else
	{
	redirect('index');
	}		
}

//===================================================================================
public function getsizecounttest(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getsizecounttest');
		
	}
	else
	{
	redirect('index');
	}
}


public function getsizecount(){
	if($this->session->userdata('is_logged_in')){
	 $data['countsize'] = $_GET['countsize'];
		$this->load->view('getsizecount',$data);
	}
	else
	{
	redirect('index');
	}
}

//================================================================================================================================================

public function getsizecountreg(){
	if($this->session->userdata('is_logged_in')){
	 $data['countsize'] = $_GET['countsize'];
		$this->load->view('getsizeandactualqty-reg',$data);
	}
	else
	{
	redirect('index');
	}
}

public function getsizecountmad(){
	if($this->session->userdata('is_logged_in')){
	 $data['countsize'] = $_GET['countsize'];
		$this->load->view('getsizeandactualqty-mad',$data);
	}
	else
	{
	redirect('index');
	}
}


//================================================================================================================================================

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

//======================================================================================
	
	public function addOrderRag(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();
	$this->load->view('add-order-reg',$data);
	}
	else
	{
	redirect('index');
	}	
	}

	public function addOrderMad(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();
	$this->load->view('add-order-mad',$data);
	}
	else
	{
	redirect('index');
	}	
	}

	public function addOrderSeel(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();
	$this->load->view('add-order-seel',$data);
	}
	else
	{
	redirect('index');
	}	
	}
	
	public function addOrderMum(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();
	$this->load->view('add-order-mum',$data);
	}
	else
	{
	redirect('index');
	}	
	}

//=======================================================================================

public function insertorder(){
		
		extract($_POST);
		$table_name ='tbl_order_hdr';
		$table_name_dtl ='tbl_order_dtl';
		$pri_col ='order_id';
		$pri_col_dtl ='order_dtl_id';
		$total='0';
				
				$customerid=$this->input->post('customer_id');
		
		
		$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'invoice_status' => 'Pending',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
	
		$data = array(
	
					'customer_id' => $customerid,
					'order_date' => $this->input->post('order_date'),
					//'store_id' => $storeid,			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();	
			
			$lastid=$lastHdrId;
			$this->software_log_insert($lastid,$customerid,$total,'Order added');		
				
			$this->load->model('Model_admin_login');
		
		for($i=0; $i<=$rows; $i++)
				{
				 								
				if($qtyyallval[$i]!=''){
					
				$catesaleid=$this->input->post('categorysoletype')[$i];
				$solesumqty=$this->input->post('checkboxvaluess')[$i];
				
				 $data_dtl['customer_id'] = $customerid;
				 $data_dtl['order_date'] = $this->input->post('order_date');
				// $data_dtl['store_id'] = $storeid;		
				 $data_dtl['order_id']= $lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];				 
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['desc_name']=$this->input->post('desc_name')[$i];	
				 $data_dtl['category_type']=$this->input->post('categorysoletype')[$i];
				 $data_dtl['checkboxtotalqty']=$this->input->post('checkboxvaluess')[$i];
				 $data_dtl['size_name']=$this->input->post('sizeallval')[$i];
				 $data_dtl['qty_name']=$this->input->post('qtyyallval')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_value')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
										
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);	

				$itemidinstock=$this->input->post('item_id')[$i];

				$this->db->query("update tbl_product_stock set order_status='A' where Product_id='$itemidinstock'");	

							}
					}
			
			$makd=date('y-m-d');
			$this->db->query("insert into tbl_order_note_log set note_msg='Order has been taken', order_id='$lastHdrId', maker_date='$makd'");	
			
			$this->session->set_flashdata('flashmsg', 'Order Added Successfully.');
				
			 $rediectInvoice="salesorder/SalesOrder/manageSalesOrder";
		redirect($rediectInvoice);	
	   					
	
	}

//==============================================================================================================================================================


	public function updateTermAndCondition($lastHdrId,$vendor_id,$grand_total,$date)
	{
	$contactQuey=$this->db->query("select *from tbl_contact_m where contact_id='$vendor_id'");
	$getContact=$contactQuey->row();
	
	
	$termandcondition=" 	
<p>&nbsp;</p>
<div style='font-family: 'Times New Roman'; font-size: medium; background: #fbfbfb;'>
<div style='padding: 25.6094px; text-align: center; background: #4190f2;'>
<div style='color: #ffffff; font-size: 20px;'>Invoice # $lastHdrId</div>
</div>
<div style='max-width: 560px; margin: auto; padding: 0px 25.6094px;'>
<div style='padding: 30px 0px; color: #555555; line-height: 1.7;'>Dear $getContact->first_name,&nbsp;<br /><br />Your invoice $lastHdrId is attached.

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
$this->db->query("update tbl_sales_order_hdr set termandcondition='".addslashes($termandcondition)."' where salesid='$lastHdrId'");

	}
	
	public function updateSalesOrder(){
		
		extract($_POST);
		$table_name ='tbl_sales_order_hdr';
		$table_name_dtl ='tbl_sales_order_dtl';
		$pri_col ='salesid';
		$pri_col_dtl ='sales_dtl_id';
		
		
 //$this->refil_qnty_del($id);

		 $this->db->query("delete from tbl_sales_order_dtl where salesid='$id'");	
				
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
	
					'vendor_id' => $this->input->post('vendor_id'),
					'invoice_type' => $this->input->post('invoice_type'),
					'invoice_date' => $this->input->post('date'),
					'sub_total' => $this->input->post('sub_total'),
					'service_charge_per' => $this->input->post('service_charge_per'),	
					'service_charge_total' => $this->input->post('service_charge_total'),
					'gross_discount_per' => $this->input->post('gross_discount_per'),
					'gross_discount_total' => $this->input->post('gross_discount_total'),
					'grand_total' => $this->input->post('grand_total'),
					'due_date' => $this->input->post('due_date'),
					
					);
			
			$data_merge = array_merge($data,$sess);					
		   
			$this->load->model('Model_admin_login');	
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_merge);

		
		for($i=0; $i<=$rows; $i++)
				{
				 				
			    
			
				
				if($qty[$i]!=''){

				 $data_dtl['salesid']= $id;
				 $data_dtl['product_id']=$this->input->post('main_id')[$i];				 
				 $data_dtl['list_price']=$this->input->post('list_price')[$i];
				 $data_dtl['quantity']=$this->input->post('qty')[$i];
				 $data_dtl['discount']=$this->input->post('discount')[$i];
				 $data_dtl['discount_amount']=$this->input->post('disAmount')[$i];
				 $data_dtl['total']=$this->input->post('tot')[$i];
				 $data_dtl['due_date']=$this->input->post('due_date')[$i];
				 $data_dtl['net_price']=$this->input->post('nettot')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
				
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
				//$this->updata_stock($qty[$i],$main_id[$i],$sizeval[$i]);
	
							}
					}
					//$this->paymentAmount($grand_total,$vendor_id,$lastHdrId,$id);
					$this->software_log_insert($id,$vendor_id,$grand_total,'Sales Order Updated');
	   echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					
	
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

//========================================================================================================================================================

public function getproductreg(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-reg');
	}
	else
	{
	redirect('index');
	}
}

public function getproductmad(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-mad');
	}
	else
	{
	redirect('index');
	}
}

public function getproductseel(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-seel');
	}
	else
	{
	redirect('index');
	}
}

public function getproductmum(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-mum');
	}
	else
	{
	redirect('index');
	}
}


//========================================================================================================================================================
	
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
		redirect('SalesOrder/managePurchaseOrder');
}

function delete_updata_stock($qty,$main_id){
	$this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
    $this->db->query("update tbl_product_serial set quantity=quantity+'$qty' where product_id='$main_id'");
	return;	
}	

function ajax_editOrder(){

    //if($this->input->post() != ""){
	$total='0';
	foreach ($this->input->post('arr') as  $dt) {
		$pid      =  $dt['productId'];
		$pidhdr   =  $dt['orderHdrId'];
		$orderdtl =  $dt['orderDtlId'];
		$total    =  $dt['total'];
        
        $selectQuery1 = $this->db->query("select qtyinstock from tbl_product_stock where Product_id='$pid'");	
        $result       = $selectQuery1->row_array();
        //echo  $result['qtyinstock'];
        $qtyarr1      = "";$stockarr1    ="";$stockarr = "";
        $qtyarr       = "";

        $stockQty     = explode(' ', $result['qtyinstock']);
        $i = 0;
        //echo $stockQty[$i];
        
        //print_r($dt['oldValue']);

		foreach ($dt['enterval'] as $enterval) {
			$dt['oldValue'][$i] = $dt['oldValue'][$i+1]==""?0:$dt['oldValue'][$i];
			$enterval           = $enterval==""?'0':$enterval;
			$stockQty[$i]       = $stockQty[$i]==""?0:$stockQty[$i];

		    $sum[] = $stockQty[$i].'-'.$dt['oldValue'][$i+1].'+'.$enterval.'s';
		    $stockarr[] = ($stockQty[$i]-$dt['oldValue'][$i+1])+$enterval; 
            $qtyarr[]   = $enterval;
        $i++;
		}

		// print_r($sum);
		// print_r($stockarr);
		// print_r($qtyarr);
		$stockarr1    = implode(' ', $stockarr);
		$qtyarr1  = implode(' | ', $qtyarr);
		$qtyarrorder =' | '.$qtyarr1;
		//echo "update tbl_product_stock set qtyinstock = '$stockarr1' where Product_id=$pid";
		$this->db->query("update tbl_product_stock set qtyinstock = '$stockarr1' where Product_id=$pid");
		$this->db->query("update tbl_order_dtl set qty_name='$qtyarrorder',checkboxtotalqty=$total,total_qty=$total where order_dtl_id=$orderdtl");
		
		$lastid=$orderdtl;
		$this->software_log_insert($lastid,$lastid,$total,'Order Updated');	
		
		
     }
	 echo 1;
   }
// }

 function insertorderstocktb(){

 	$proid=$_POST['proid'];
 	$categoryid=$_POST['cateid'];
 	$entorderqty=$_POST['orderentqty'];
	
	date_default_timezone_set('Asia/Kolkata');
	$dt = new DateTime();
	$mdate=$dt->format('d/m/Y H:i:s');	

	$stockqry = $this->db->query("select * from tbl_product_stock where Product_id='$proid' and category='$categoryid'");	
    $result = $stockqry->row();

   	$sizeofproduct=$result->size;
    $sizetotal=sizeof(explode(' ', $sizeofproduct));

    $previewoforder=$result->qtyinstock;
    $preordexp=explode(' ', $previewoforder);

    $currentordexp=explode(' ', $entorderqty);

    	$orderqty=array();
	for($i=0;$i<$sizetotal;$i++){

		$j=$i+1;
		$order=$preordexp[$i]+$currentordexp[$j];
		//echo $order;
		array_push($orderqty, $order);
	}    
$totalorder=implode(' ', $orderqty);
//echo $totalorder;

 $this->db->query("update tbl_product_stock set qtyinstock='$totalorder', order_status='lockitem' where Product_id='$proid' and category='$categoryid'");	

 $this->db->query("insert into tbl_order_item_by_log set item_id='$proid', category_id='$categoryid', size_name='$sizeofproduct', qty_name='$entorderqty', maker_date='$mdate'");	

}

function deleteordervalreturn(){

 	$proid=$_POST['proid'];
 	$categoryid=$_POST['cateid'];
 	$entorderqty=$_POST['orderentqty'];
	
	$stockqry = $this->db->query("select * from tbl_product_stock where Product_id='$proid' and category='$categoryid'");	
    $result = $stockqry->row();

   	$sizeofproduct=$result->size;
    $sizetotal=sizeof(explode(' ', $sizeofproduct));

    $previewoforder=$result->qtyinstock;
    $preordexp=explode(' ', $previewoforder);

    $currentordexp=explode(' ', $entorderqty);

    	$orderqty=array();
	for($i=0;$i<$sizetotal;$i++){

		$j=$i+1;
		$order=$preordexp[$i]-$currentordexp[$j];
		//echo $order;
		array_push($orderqty, $order);
	}    
$totalorder=implode(' ', $orderqty);
//echo $totalorder;

 $this->db->query("update tbl_product_stock set qtyinstock='$totalorder', order_status='A' where Product_id='$proid' and category='$categoryid'");	

}
	
}
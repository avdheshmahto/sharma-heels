<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class model_report extends CI_Model {

function getSearchStock($searchBook,$pcode) {
	if($searchBook!='' || $pcode!=''){
    $select_query = "Select * from tbl_product_stock where status='A'";
    if($searchBook!='')
		{				
			$select_query.=" and productname like '$searchBook'";	  
		}
		if($pcode!='')
		{				
			$select_query.=" and Product_id  = '$pcode'";	  
		}
	}else{
			$select_query = "Select * from tbl_product_stock";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}



function getSearchPayment($contactid,$payment_mode) {
	if($contactid!='' || $payment_mode!=''){
   
		$select_query="select * from tbl_invoice_payment where status='payment'";
		
		if($contactid!='')
		{				
			$select_query.=" and contact_id  = '$contactid'";	  
		}
		
		if($payment_mode!='')
		{				
			$select_query.=" and payment_mode  = '$payment_mode'";	  
		}
		  
    	}else{
	$select_query = "Select * from tbl_invoice_payment where status='payment'";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}


function getSearchPaymentReceived($contactid,$payment_mode) {
	if($contactid!='' || $payment_mode!=''){
   
		$select_query="select * from tbl_invoice_payment where status='PaymentReceived'";
		
		if($contactid!='')
		{				
			$select_query.=" and contact_id  = '$contactid'";	  
		}
		
		if($payment_mode!='')
		{				
			$select_query.=" and payment_mode  = '$payment_mode'";	  
		}
		  
    	}else{
	$select_query = "Select * from tbl_invoice_payment where status='PaymentReceived'";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}


function geTtotalSearchStock($searchBook,$pcode) {
	if($searchBook!='' || $pcode!=''){
    $select_query = "Select * from tbl_product_stock where Product_id='$pcode' || productname like '$searchBook'";
    	}else{
	$select_query = "Select *from tbl_product_stock ";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}

function geTSearchProductStockSummery($p_name,$p_code) {
	if($p_name!='' || $p_code!=''){
	
	$select_query = "Select * from tbl_product_serial_log where status='A'";
		if($p_name!='')
		{			
		$sql1 = $this->db->query("select * from tbl_product_stock where productname='".$p_name."' ");
			$sql2 = $sql1->row();	
			$select_query.=" and product_id  = '".$sql2->Product_id."'";	  
		}
		
		if($p_code!='')
		{			
		$sql1 = $this->db->query("select * from tbl_product_stock where Product_id='$p_code' ");
			$sql3 = $sql1->row();	
			$select_query.=" and product_id  = '$sql3->Product_id'";	  
		}
	}else{
	$select_query = "Select * from tbl_product_serial_log";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}


function getSearchPurchaseOrder($p_no,$v_name,$f_date,$t_date,$g_total) {
	if($p_no!='' || $v_name!='' || $f_date!='' || $t_date!='' || $g_total!=''){
//	echo $g_total;die;
   $select_query = "Select * from tbl_purchase_order_hdr";
		if($p_no!='')
		{				
			$select_query.=" where purchaseorderid  = '$p_no'";	  
		}
		
		if($v_name!='')
		{				
			$select_query.=" and vendor_id  = '$v_name'";	  
		}
		
		if($g_total!='')
		{				
			$select_query.=" and grand_total  = '$g_total'";	  
		}
		
		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
		}
    	}else{
	$select_query = "Select * from tbl_purchase_order_hdr";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}

function getSearchSaleOrder($p_no,$v_name,$f_date,$t_date,$g_total) {
	if($p_no!='' || $v_name!='' || $f_date!='' || $t_date!='' || $g_total!=''){
//	echo $g_total;die;
   $select_query = "Select * from tbl_sales_order_hdr";
		if($p_no!='')
		{				
			$select_query.=" where salesid  = '$p_no'";	  
		}
		
		if($v_name!='')
		{				
			$select_query.=" and vendor_id  = '$v_name'";	  
		}
		
		if($g_total!='')
		{				
			$select_query.=" and grand_total  = '$g_total'";	  
		}
		
		if($f_date!='' && $t_date!='')
		{
		
			$tdate=explode("-",$t_date);
			
			$fdate=explode("-",$f_date);

			$todate1=$tdate[0]."-".$tdate[1]."-".$tdate[2];
	        $fdate1=$fdate[0]."-".$fdate[1]."-".$fdate[2];
			$queryy .="and invoice_date >='$fdate1' and invoice_date <='$todate1'";
		}
    }else{
			$select_query = "Select * from tbl_sales_order_hdr";	
		}
	$query = $this->db->query($select_query);
    return $query->result();
}
}
?>
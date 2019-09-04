<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class OrderedInvoiceNew extends my_controller {
function __construct(){
   parent::__construct();
  $this->load->model('model_invoice');
  $this->load->model('Model_admin_login');	

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

public function invoiceInNational(){
	if($this->session->userdata('is_logged_in')){
        $data=$this->user_function();// call permission fnctn
		$this->load->view('create-invoice-nat');
	}
	else
	{
	redirect('index');
	}		
}


public function addInvoice(){
	if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
	  $url   = site_url('/OrderedInvoiceNew/OrderedInvoiceNew/addInvoice?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_invoice->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/OrderedInvoiceNew/OrderedInvoiceNew/addInvoice?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
		$this->load->view('add-invoice-ordered', $data);
	}
	else
	{
	redirect('index');
	}		
}

public function invoicereportlog(){
	if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
	  $url   = site_url('/OrderedInvoiceNew/OrderedInvoiceNew/invoicereportlog?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_invoice->count_all_report_log($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/OrderedInvoiceNew/OrderedInvoiceNew/invoicereportlog?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
		$this->load->view('invoice-report-log', $data);
	}
	else
	{
	redirect('index');
	}		
}

public function outwardreports(){
	if($this->session->userdata('is_logged_in')){	
	$this->load->view('outward-invoice-report');
	}
	else
	{
	redirect('index');
	}		
}


public function addDirectInvoice(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-direct-invoice',$data);
	}
	else
	{
	redirect('index');
	}		
}



public function addDirectInvoiceMad(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-direct-invoice-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addDirectInvoiceSeel(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-direct-invoice-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addDirectInvoiceMum(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-direct-invoice-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addDirectInvoiceBapa(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-direct-invoice-bapa',$data);
	}
	else
	{
	redirect('index');
	}		
}

//=========================================================================================================================

public function addInvoiceReg(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addInvoiceMad(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}



public function addInvoiceSeel(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addInvoiceMum(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function addInvoiceBapa(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('add-invoice-ordered-bapa',$data);
	}
	else
	{
	redirect('index');
	}		
}


//=========================================================================================================================

public function manageInvoiceNat(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered-nat');
	}
	else
	{
	redirect('index');
	}		
}
//==========================================================================

public function manageInvoiceReg(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered-reg');
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceMad(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered-mad');
	}
	else
	{
	redirect('index');
	}		
}
public function manageInvoiceSeel(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered-seel');
	}
	else
	{
	redirect('index');
	}		
}
public function manageInvoiceMum(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered-mum');
	}
	else
	{
	redirect('index');
	}		
}

public function manageInvoiceBapa(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$this->load->view('manage-invoice-ordered');
	}
	else
	{
	redirect('index');
	}		
}

//==========================================================================

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

public function addBuilty(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('add-builty-no',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function viewInvoiceOrdered(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice',$data);
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


public function edit_invoice_validation(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('edit-invoice-validation',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function getorderedsecondpage(){ 
	if($this->session->userdata('is_logged_in')){
		$data['id'] = $_GET['id'];
		$this->load->view('create-invoice-nat-second-page',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function getterm(){
	if($this->session->userdata('is_logged_in')){
		$data['id'] = $_GET['id'];
		$this->load->view('get-term',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function validation_of_negative_qty(){
	if($this->session->userdata('is_logged_in')){
		$data['id'] = $_GET['id'];
		$this->load->view('validation-of-negative-qtys',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function getcreditlimit(){
	if($this->session->userdata('is_logged_in')){
		$data['id'] = $_GET['id'];
		$this->load->view('get-credit-limit',$data);
	}
	else
	{
	redirect('index');
	}		
}

//===================================================================================================================================

public function updateInvoiceReg(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('update-invoice-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function updateInvoiceOrderedReg(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('edit-invoice-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function viewInvoiceOrderedReg(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateInvoiceSeel(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('update-invoice-Seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateInvoiceMum(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('update-invoice-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function updateInvoiceOrderedSeel(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('edit-invoice-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateInvoiceOrderedMum(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('edit-invoice-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function viewInvoiceOrderedSeel(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}


public function viewInvoiceOrderedMum(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function viewInvoiceOrderedBapa(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice-bapa',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function viewInvoiceOrderedMadi(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('view-invoice-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}


//===================================================================================================================================

public function insert_builty_no(){
        extract($_POST);
		
		$builtyno=$this->input->post('builty_no');
		$invid=$this->input->post('inv_id');
		
		$this->load->model('Model_admin_login');	
				
		$this->db->query("update tbl_ordered_invoice_hdr set builty_no='$builtyno' where ordered_invoiceid='$invid'");	
				
		}

//======================================================= Start national customer by invoice =============================================================

public function insertCustomerByInvoice(){
        extract($_POST);
	        
		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$mdate=$dt->format('d/m/Y H:i:s');	
	
		$table_name ='tbl_ordered_invoice_hdr';
		$pri_col ='ordered_invoiceid';
		$table_name_log ='tbl_invoice_log';			
		$table_name_dtl ='tbl_ordered_invoice_dtl';
		$pri_col_dtl ='ordered_invoiceid_dtl';
		$total=$this->input->post('sub_tot');					
		$custidd = $this->input->post('Customer_id');	
		$storeid = $this->input->post('store_id');
		$sess    = array(
			'maker_id'   => $this->session->userdata('user_id'),
			'maker_date' => $mdate,
			'status'  => 'A',
			'comp_id' => $this->session->userdata('comp_id'),
			'zone_id' => $this->session->userdata('zone_id'),
			'brnh_id' => $this->session->userdata('brnh_id'),
			'divn_id' => $this->session->userdata('divn_id')
        );
	
		$data = array(
	        'customer_id' => $this->input->post('Customer_id'),
			'invoice_date' => $this->input->post('invoice_date'),					
			'tot_desc' => $this->input->post('tot_desc'),
			'sub_tot' => $this->input->post('sub_tot'),
			'balance_due' => $this->input->post('balance_due'),
			'due_date' => $this->input->post('due_date'),
			'term_name' => $this->input->post('term_name'),
			'credit_name' => $this->input->post('credit_name'),					
			'store_id' => $this->input->post('store_id'),
		);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId = $this->db->insert_id();		
			
			$lastid=$lastHdrId;
			$this->software_log_insert($lastid,$custidd,$total,'Invoice added');
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow = $rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				 $order_idds  = $this->input->post('orderid')[$i];
				 $orderid_dtl  = $this->input->post('order_id')[$i];
				 $itemsid     = $this->input->post('item_id')[$i];
				 $total_qty   = $this->input->post('total_qty')[$i];
				 $category_id = $this->input->post('category_id')[$i];
				 
				 $sizeval   = $this->input->post('size_value')[$i];
				 //$qty       = $this->input->post('qty_val')[$i];
				 $qty         = $this->input->post('entqty_value')[$i];
				 $valnotnullname=$this->input->post('valnotnull')[$i];	

				 $qry=$this->db->query("select * from tbl_product_stock where Product_id='$itemsid' and category='$category_id'");	
				 $fetchq      = $qry->row();
				 $torderv     = $fetchq->qtyinstock;
				 $toactqty    = $fetchq->quantity;
				 $stocksizes  = $fetchq->size;				 
				 $countstocksize=sizeof(explode(' ', $stocksizes));
				 $tbl_pro_ent = explode(',', $qty);
				 $tbl_pro_stock = explode(' ', $toactqty);
				 $tbl_pro_order = explode(' ', $torderv);
				 $inv_of_array=array();
				 $inv_of_order_array=array();
				 $sumactqty   = 0;
				 for($s=0; $s<$countstocksize;$s++){

				 	$invoic_qty=$tbl_pro_stock[$s]-$tbl_pro_ent[$s];
				    $inv_of_array[]=$invoic_qty;

				    $invoic_order_qty=$tbl_pro_order[$s]-$tbl_pro_ent[$s];
				    $inv_of_order_array[]=$invoic_order_qty;

				    $sumactqty +=$tbl_pro_ent[$s];	
				 }
 				
 				 $imp_actstock_invoice = implode(' ', $inv_of_array);
 				 $imp_orderstock_invoice = implode(' ', $inv_of_order_array);
					
				$itemex  = $this->input->post('item_id')[$i];						
				$exitem  = explode('^',$itemex);								
				$item_id = $exitem[0];
				$sub_item_id=$exitem[1];
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid'] = $lastHdrId;
				 $data_dtl['item_id']           = $item_id;
				 $data_dtl['sub_item_id']       = $sub_item_id;				 
				 $data_dtl['customer_id']       = $custidd;
				 $data_dtl['store_id']          = $storeid;
				 $data_dtl['productname']       = $this->input->post('productname')[$i];	
				 $data_dtl['category_id']       = $this->input->post('category_id')[$i];
				 //$data_dtl['category_type']= $this->input->post('taxonandsole_id')[$i];
				 $data_dtl['description']       = $this->input->post('descname')[$i];
				 $data_dtl['order_id']          = $this->input->post('order_id')[$i];
				 $data_dtl['size_val']          = $this->input->post('size_value')[$i];
				 $data_dtl['qty_val']           = $this->input->post('entqty_value')[$i];
				 $data_dtl['total_qty']         = $this->input->post('total_qty')[$i];				
				 //$data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 //$data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']       = $this->input->post('total_prices')[$i];
				 $data_dtl['one_item_price']    = $this->input->post('item_byprice')[$i];
				 $data_dtl['maker_id']          = $this->session->userdata('user_id');
				 $data_dtl['maker_date']        = $mdate;
				 $data_dtl['comp_id']           = $this->session->userdata('comp_id');
				 $data_dtl['zone_id']           = $this->session->userdata('zone_id');
				 $data_dtl['brnh_id']           = $this->session->userdata('brnh_id');		
												
				 $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);	
				 
				 $this->Model_admin_login->insert_user($table_name_log,$data_dtl);	


			 	 //echo "update tbl_product_stock set qtyinstock='$imp_orderstock_invoice',quantity='$imp_actstock_invoice', total_qty=total_qty-'$total_qty' where Product_id='$item_id' and category='$category_id'";	

			  $this->db->query("update tbl_product_stock set qtyinstock='$imp_orderstock_invoice',quantity='$imp_actstock_invoice', total_qty=total_qty-'$total_qty' where Product_id='$item_id' and category='$category_id'");	

				// echo "update tbl_product_serial set quantity='$imp_actstock_invoice', total_qty=total_qty-'$sumactqty' where product_id='$itemsid' and category='$category_id'";die;

               $this->db->query("update tbl_product_serial set quantity='$imp_actstock_invoice', total_qty=total_qty-'$sumactqty' where product_id='$itemsid' and category='$category_id'");	
										
$orddtlqryrer=$this->db->query("Select * from tbl_order_dtl where cancel_status='A' and order_id='$orderid_dtl' and customer_id='$custidd' and item_id='$itemsid'");						
	$dd=$orddtlqryrer->row();	
		
		$invoicedtlq=$this->db->query("Select * from tbl_ordered_invoice_dtl where status='A' and order_id='$dd->order_id' and item_id='$dd->item_id'");
		$fetchlistinv=$invoicedtlq->row();
		$qtyinvoice=$fetchlistinv->qty_val;
		
		$sizeval=$dd->size_name;
	 	$preorderqtys=$dd->qty_name;

	 	$sizecount=sizeof(explode(' | ', $sizeval));

		$sizearr=explode(' | ', $sizeval);
		$preorderqtyarr=explode(' | ', $preorderqtys);
		$entqtyarr=explode(',', $qty);

		$arr1 = array();
		foreach($invoicedtlq->result() as $inventqtyrow){
		     $arr =  $inventqtyrow->qty_val;
			 $arr1[] = explode(',',$arr);
		}
				
		$sumArray = array();
		if(sizeof($arr1) > 0){
         foreach ($arr1 as $k=>$subArray) {
            foreach ($subArray as $id=>$value) {
              $sumArray[$id]+=$value;
           }
          }
	   }

	  print_r($sumArray);

	  $resultqtys= array();
	  $sumqtyord=0;
		for($j=1;$j<$sizecount;$j++){ $jk=$j-1;
		 if($sumArray[$jk] ==""){
		  $sumArray[$jk] = 0;
		}
 		
 	 $preinvqtyandentinvqtys=$sumArray[$jk];	
   	 $orderqtyyy=$preorderqtyarr[$j]-$preinvqtyandentinvqtys;
   	 $resultqtys[]=$orderqtyyy;
	//$sumqtyord +=$orderqtyyy;
   }

 print_r($resultqtys);
   if(count(array_filter($resultqtys)) == 0){
   		//echo "hello".$resultqtys;
   		$this->db->query("update tbl_order_dtl set invoice_status='Completed' where order_id='$orderid_dtl' and item_id='$itemsid' and category_id='$category_id'");

   		//echo "update tbl_order_dtl set invoice_status='Completed' where order_id='$orderid_dtl' and item_id='$itemsid' and category_id='$category_id'";	

   }else{

   	    $this->db->query("update tbl_order_dtl set invoice_status='Part Pending' where order_id='$orderid_dtl' and item_id='$itemsid' and category_id='$category_id'");	
   		//print_r($resultqtys);
   		//echo "update tbl_order_dtl set invoice_status='Part Pending' where order_id='$orderid_dtl' and item_id='$itemsid' and category_id='$category_id'";
   }
	
//============================================================================			
		
	$orddtlqry=$this->db->query("Select * from tbl_order_dtl where cancel_status='A' and customer_id='$custidd' and order_id='$orderid_dtl'");						
	$allordrow=$orddtlqry->num_rows();	

	$ordcompletedqry=$this->db->query("select * from tbl_order_dtl where invoice_status='Completed' and order_id='$orderid_dtl' and customer_id='$custidd'");
	$Completedordrow=$ordcompletedqry->num_rows();

	if($allordrow==$Completedordrow){
		
		//echo "update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid_dtl' and customer_id='$custidd'";

		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid_dtl' and customer_id='$custidd'");	
	}else{
		// echo "update tbl_order_hdr set invoice_status='Part Pending' where order_id='$orderid_dtl' and customer_id='$custidd'";
		 
		$this->db->query("update tbl_order_hdr set invoice_status='Part Pending' where order_id='$orderid_dtl' and customer_id='$custidd'");	
	}

//=============================================================================

     	}
	}
		//die;		
		$this->session->set_flashdata('flash_msg', 'Invoice Added Successfully.');
		$rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/invoiceInNational";
		redirect($rediectInvoice);	
	   					  					
	} 

//=============================================== Close national customer by invoice =================================================

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
			
		//	 $itemsid=$this->input->post('item_id');				 
			//	 $category_id=$this->input->post('category_id');
			
		    $this->load->model('Model_admin_login');					
			$rowss=$this->input->post('rows');			
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 					
				 $itemsid=$this->input->post('item_id')[$i];				 
				 $category_id=$this->input->post('category_id')[$i];
				 $sub_item_id=$this->input->post('sub_item_id')[$i];
				
				 $sizeval=$this->input->post('size_val')[$i]; 
				 $qty_val=$this->input->post('qty_val')[$i];
				 $total_qty=$this->input->post('total_qty')[$i];
				 $total_price=$this->input->post('total_price')[$i];
					
				
				 $qry=$this->db->query("select * from tbl_product_stock where Product_id='$itemsid' and category='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
				 	  $qty_valord=$this->input->post('qty_valord')[$p][$i];					 
					  					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$qty_valord;
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
					//echo $stockqtyord;
					
				 
			if($sub_item_id!=''){
		           $this->db->query("update tbl_ordered_invoice_dtl set qty_val='$qty_val',total_qty='$total_qty',total_price='$total_price' where item_id='$itemsid' and category_id='$category_id' and sub_item_id='$sub_item_id'");		 
		           $this->db->query("update tbl_product_stock set qtyinstock='$stockqtyord' where Product_id='$itemsid' and category='$category_id'");	
				 }else{
			       $this->db->query("update tbl_ordered_invoice_dtl set qty_val='$qty_val',total_qty='$total_qty',total_price='$total_price' where item_id='$itemsid' and category_id='$category_id'");	
			       $this->db->query("update tbl_product_stock set qtyinstock='$stockqtyord' where Product_id='$itemsid' and category='$category_id'");		
				 }				
			}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoice";
		redirect($rediectInvoice);	
			   					  								
}

//=============================================================================================================================================
	
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
					'order_id' => $this->input->post('order_idd'),			
					
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock where Product_id='$itemsid' and category='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 $toactqty=$fetchq->quantity;				 
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];				
				 				
				 $qtycount=sizeof(explode(',', $qty));
	 			 $sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $sumactqty=0;
					  $out = array();
					  $outactqty = array();
					  for($p=0;$p<$sizecount;$p++){
					 
					  $exp=explode(',', $qty);
					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$exp[$p];
					   array_push($out, $suborqty);

					  $expact=explode(' ', $toactqty);
					  $subactqty=$expact[$p]-$exp[$p];
					   array_push($outactqty, $subactqty);
					 
					   $sumactqty +=$exp[$p];	
												
						}
					
					$impqtyoreder=implode(' ', $out);
					$impactqty=implode(' ', $outactqty);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
				$stractqty = $impactqty;
				 $stractqty . "<br>";
				$stockqtyordactqty=rtrim($stractqty,"0!");					
												
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
									
				$this->db->query("update tbl_product_stock set qtyinstock='$stockqtyord',quantity='$stockqtyordactqty', total_qty=total_qty-'$sumactqty' where Product_id='$itemsid' and category='$category_id'");	

                $this->db->query("update tbl_product_serial set quantity='$stockqtyordactqty', total_qty=total_qty-'$sumactqty' where product_id='$itemsid' and category='$category_id'");	
						
			}
	}
			
			$this->db->query("update tbl_order_hdr set invoice_status='Part Pending' where order_id='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			$rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoice";
		    redirect($rediectInvoice);	
	   					  					
	
	}

//=================================================================================================================================================================



//============================================================ Start Regarpura =================================================================================
	
	public function invoiceInsertReg(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_reg';
					$pri_col ='ordered_invoiceid_reg';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_reg';
					$pri_col_dtl ='ordered_invoiceid_dtl_reg';
						
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
					'order_id' => $this->input->post('order_idd'),			
					
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_regarpura where Product_id_reg='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
					 
					  $exp=explode(',', $qty);
					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$exp[$p];
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
								
												
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_reg']=$lastHdrId;
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
									
				$this->db->query("update tbl_product_stock_regarpura set qtyinstock='$stockqtyord' where Product_id_reg='$itemsid' and category_id='$category_id'");	
						
							}
					}
			
			$this->db->query("update tbl_order_hdr_reg set invoice_status='Part Pending' where order_id_reg='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceReg";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Update Funtion =================================================================================================

public function invoiceUpdateFunReg(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr_reg';
		$pri_col ='ordered_invoiceid_reg';		
		$table_name_dtl ='tbl_ordered_invoice_dtl_reg';
		$pri_col_dtl ='ordered_invoiceid_dtl_reg';
		$id=$this->input->post('invoiceid');
		
		   $this->db->query("delete from tbl_ordered_invoice_dtl_reg where ordered_invoiceid_reg='$id'");
		 			
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_regarpura where Product_id_reg='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];
				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
				 	  $qty_valord=$this->input->post('qty_valord')[$p][$i];					 
					  					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$qty_valord;
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
				 
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_reg']=$lastHdrId;
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
				
				$this->db->query("update tbl_product_stock_regarpura set qtyinstock='$stockqtyord' where Product_id_reg='$itemsid' and category_id='$category_id'");			
						
							}
					}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceReg";
		redirect($rediectInvoice);	
			   					  								
}

//============================================================== Close Regarpura =================================================================================


//============================================================ Start Madipur =================================================================================
	
	public function invoiceInsertMad(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_mad';
					$pri_col ='ordered_invoiceid_mad';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_mad';
					$pri_col_dtl ='ordered_invoiceid_dtl_mad';
						
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
					'order_id' => $this->input->post('order_idd'),			
					
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_madipur where Product_id_mad='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
					 
					  $exp=explode(',', $qty);
					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$exp[$p];
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
								
												
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mad']=$lastHdrId;
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
									
				$this->db->query("update tbl_product_stock_madipur set qtyinstock='$stockqtyord' where Product_id_mad='$itemsid' and category_id='$category_id'");	
						
							}
					}
			
			$this->db->query("update tbl_order_hdr_mad set invoice_status='Part Pending' where order_id_mad='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceMad";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Update Funtion =================================================================================================

public function invoiceUpdateFunMad(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr_mad';
		$pri_col ='ordered_invoiceid_mad';		
		$table_name_dtl ='tbl_ordered_invoice_dtl_mad';
		$pri_col_dtl ='ordered_invoiceid_dtl_mad';
		$id=$this->input->post('invoiceid');
		
		   $this->db->query("delete from tbl_ordered_invoice_dtl_mad where ordered_invoiceid_mad='$id'");
		 			
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_madipur where Product_id_mad='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];
				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
				 	  $qty_valord=$this->input->post('qty_valord')[$p][$i];					 
					  					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$qty_valord;
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
				 
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mad']=$lastHdrId;
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
				
				$this->db->query("update tbl_product_stock_madipur set qtyinstock='$stockqtyord' where Product_id_mad='$itemsid' and category_id='$category_id'");			
						
							}
					}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceMad";
		redirect($rediectInvoice);	
			   					  								
}

//============================================================== Close Madipur =================================================================================


//============================================================ Start Seelampur =================================================================================
	
	public function invoiceInsertSeel(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_seel';
					$pri_col ='ordered_invoiceid_seel';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_seel';
					$pri_col_dtl ='ordered_invoiceid_dtl_seel';
						
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
					'order_id' => $this->input->post('order_idd'),			
					
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_seelampur where Product_id_seel='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
					 
					  $exp=explode(',', $qty);
					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$exp[$p];
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
								
												
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_seel']=$lastHdrId;
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
									
				$this->db->query("update tbl_product_stock_seelampur set qtyinstock='$stockqtyord' where Product_id_seel='$itemsid' and category_id='$category_id'");	
						
							}
					}
			
			$this->db->query("update tbl_order_hdr_seel set invoice_status='Part Pending' where order_id_seel='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceSeel";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Update Funtion =================================================================================================

public function invoiceUpdateFunSeel(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr_seel';
		$pri_col ='ordered_invoiceid_seel';		
		$table_name_dtl ='tbl_ordered_invoice_dtl_seel';
		$pri_col_dtl ='ordered_invoiceid_dtl_seel';
		$id=$this->input->post('invoiceid');
		
		   $this->db->query("delete from tbl_ordered_invoice_dtl_seel where ordered_invoiceid_seel='$id'");
		 			
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_seelampur where Product_id_seel='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];
				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
				 	  $qty_valord=$this->input->post('qty_valord')[$p][$i];					 
					  					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$qty_valord;
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
				 
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_seel']=$lastHdrId;
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
				
				$this->db->query("update tbl_product_stock_seelampur set qtyinstock='$stockqtyord' where Product_id_seel='$itemsid' and category_id='$category_id'");			
						
							}
					}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceSeel";
		redirect($rediectInvoice);	
			   					  								
}

//============================================================== Close Seelampur =================================================================================

//============================================================ Start Mumbai =================================================================================
	
	public function invoiceInsertMum(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_mum';
					$pri_col ='ordered_invoiceid_mum';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_mum';
					$pri_col_dtl ='ordered_invoiceid_dtl_mum';
						
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
					'order_id' => $this->input->post('order_idd'),			
					
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_mumbai where Product_id_mum='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
					 
					  $exp=explode(',', $qty);
					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$exp[$p];
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
								
												
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mum']=$lastHdrId;
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
									
				$this->db->query("update tbl_product_stock_mumbai set qtyinstock='$stockqtyord' where Product_id_mum='$itemsid' and category_id='$category_id'");	
						
							}
					}
			
			$this->db->query("update tbl_order_hdr_mum set invoice_status='Part Pending' where order_id_mum='$order_idds'");	 		
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceMum";
		redirect($rediectInvoice);	
	   					  					
	

	}

//============================================================== Update Funtion =================================================================================================

public function invoiceUpdateFunMum(){

		extract($_POST);
		$table_name ='tbl_ordered_invoice_hdr_mum';
		$pri_col ='ordered_invoiceid_mum';		
		$table_name_dtl ='tbl_ordered_invoice_dtl_mum';
		$pri_col_dtl ='ordered_invoiceid_dtl_mum';
		$id=$this->input->post('invoiceid');
		
		   $this->db->query("delete from tbl_ordered_invoice_dtl_mum where ordered_invoiceid_mum='$id'");
		 			
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
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_mumbai where Product_id_mum='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$this->input->post('size_val')[$i];
				 $qty=$this->input->post('qty_val')[$i];
				
				 				
				$qtycount=sizeof(explode(',', $qty));
	 				$sizecount=sizeof(explode(' | ', $sizeval));
		  
					  $sizent=0;
					  $qtynt=0;
					  $out = array();
					  for($p=0;$p<$sizecount;$p++){
				 	  $qty_valord=$this->input->post('qty_valord')[$p][$i];					 
					  					  					  
					  $expor=explode(' ', $torderv);
					  $suborqty=$expor[$p]-$qty_valord;
					   array_push($out, $suborqty);
					 						
						}
					
					$impqtyoreder=implode(' ', $out);
					
				$str = $impqtyoreder;
				 $str . "<br>";
				$stockqtyord=rtrim($str,"0!");	
				
				 
				 								
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mum']=$lastHdrId;
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
				
				$this->db->query("update tbl_product_stock_mumbai set qtyinstock='$stockqtyord' where Product_id_mum='$itemsid' and category_id='$category_id'");			
						
							}
					}
				 		
			$this->session->set_flashdata('flashmsg', 'Update Invoice Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addInvoiceMum";
		redirect($rediectInvoice);	
			   					  								
}

//============================================================== Close Mumbai =================================================================================

//============================================================== Start Direct Invoice Regarpura=================================================================================

	public function invoiceInsertDirectReg(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_reg';
					$pri_col ='ordered_invoiceid_reg';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_reg';
					$pri_col_dtl ='ordered_invoiceid_dtl_reg';
						
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
	
					'customer_id' => $this->input->post('customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),
					'order_id' => $this->input->post('order_idd'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 $entqty_name=$this->input->post('entqty_name')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_regarpura where Product_id_reg='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$fetchq->size_val;
				 $qty=$fetchq->qty_val;
				 $toqty=$fetchq->total_qty-$entqty_name; 		
				 																
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_reg']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 //$data_dtl['size_val']=$sizeval;
				 //$data_dtl['qty_val']=$impqtyaqual;
				 $data_dtl['total_qty']=$entqty_name;				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
				$this->db->query("update tbl_product_stock_regarpura set total_qty=total_qty-'$entqty_name' where Product_id_reg='$itemsid' and category_id='$category_id'");	
						
							}
					}
						
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoice";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Close Direct Invoice Regarpura =================================================================================


//============================================================== Start Direct Invoice Madipur =================================================================================

	public function invoiceInsertDirectMad(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_mad';
					$pri_col ='ordered_invoiceid_mad';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_mad';
					$pri_col_dtl ='ordered_invoiceid_dtl_mad';
						
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
	
					'customer_id' => $this->input->post('customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),
					'order_id' => $this->input->post('order_idd'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 $entqty_name=$this->input->post('entqty_name')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_madipur where Product_id_mad='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$fetchq->size_val;
				 $qty=$fetchq->qty_val;
				 $toqty=$fetchq->total_qty-$entqty_name; 		
				 																
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mad']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 //$data_dtl['size_val']=$sizeval;
				 //$data_dtl['qty_val']=$impqtyaqual;
				 $data_dtl['total_qty']=$entqty_name;				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
				$this->db->query("update tbl_product_stock_madipur set total_qty=total_qty-'$entqty_name' where Product_id_mad='$itemsid' and category_id='$category_id'");	
						
							}
					}
						
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoiceMad";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Close Direct Invoice Madipur =================================================================================


//============================================================== Start Direct Invoice Seelampur =================================================================================

	public function invoiceInsertDirectSeel(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_seel';
					$pri_col ='ordered_invoiceid_seel';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_seel';
					$pri_col_dtl ='ordered_invoiceid_dtl_seel';
						
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
	
					'customer_id' => $this->input->post('customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),
					'order_id' => $this->input->post('order_idd'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 $entqty_name=$this->input->post('entqty_name')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_seelampur where Product_id_seel='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$fetchq->size_val;
				 $qty=$fetchq->qty_val;
				 $toqty=$fetchq->total_qty-$entqty_name; 		
				 																
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_seel']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 //$data_dtl['size_val']=$sizeval;
				 //$data_dtl['qty_val']=$impqtyaqual;
				 $data_dtl['total_qty']=$entqty_name;				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
				$this->db->query("update tbl_product_stock_seelampur set total_qty=total_qty-'$entqty_name' where Product_id_seel='$itemsid' and category_id='$category_id'");	
						
							}
					}
						
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoiceSeel";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Close Direct Invoice Seelampur =================================================================================

//============================================================== Start Direct Invoice Mumbai =================================================================================

	public function invoiceInsertDirectMum(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_mum';
					$pri_col ='ordered_invoiceid_mum';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_mum';
					$pri_col_dtl ='ordered_invoiceid_dtl_mum';
						
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
	
					'customer_id' => $this->input->post('customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),
					'order_id' => $this->input->post('order_idd'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 $entqty_name=$this->input->post('entqty_name')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_mumbai where Product_id_mum='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$fetchq->size_val;
				 $qty=$fetchq->qty_val;
				 $toqty=$fetchq->total_qty-$entqty_name; 		
				 																
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_mum']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 //$data_dtl['size_val']=$sizeval;
				 //$data_dtl['qty_val']=$impqtyaqual;
				 $data_dtl['total_qty']=$entqty_name;				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
				$this->db->query("update tbl_product_stock_mumbai set total_qty=total_qty-'$entqty_name' where Product_id_mum='$itemsid' and category_id='$category_id'");	
						
							}
					}
						
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoiceMum";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Close Direct Invoice Mumbai =================================================================================

//============================================================== Start Direct Invoice Bapa Nagar =================================================================================

	public function invoiceInsertDirectBapa(){

					extract($_POST);
					$table_name ='tbl_ordered_invoice_hdr_bapa';
					$pri_col ='ordered_invoiceid_bapa';
					
					$table_name_dtl ='tbl_ordered_invoice_dtl_bapa';
					$pri_col_dtl ='ordered_invoiceid_dtl_bapa';
						
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
	
					'customer_id' => $this->input->post('customer_id'),
					'invoice_date' => $this->input->post('order_date'),
					'store_id' => $this->input->post('location_id'),
					'order_id' => $this->input->post('order_idd'),			
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    $this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$rowss; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 $entqty_name=$this->input->post('entqty_name')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_stock_bapanagar where Product_id_bapa='$itemsid' and category_id='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->qtyinstock;
				 
				 $sizeval=$fetchq->size_val;
				 $qty=$fetchq->qty_val;
				 $toqty=$fetchq->total_qty-$entqty_name; 		
				 																
				if($itemsid!=''){
					
				 $data_dtl['ordered_invoiceid_bapa']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 //$data_dtl['size_val']=$sizeval;
				 //$data_dtl['qty_val']=$impqtyaqual;
				 $data_dtl['total_qty']=$entqty_name;				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
												
				$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
				$this->db->query("update tbl_product_stock_bapanagar set total_qty=total_qty-'$entqty_name' where Product_id_bapa='$itemsid' and category_id='$category_id'");	
						
							}
				}
						
			
			$this->session->set_flashdata('flashmsg', 'Invoice Added Successfully.');
				
			 $rediectInvoice="OrderedInvoiceNew/OrderedInvoiceNew/addDirectInvoiceBapa";
		redirect($rediectInvoice);	
	   					  					
	
	}

//============================================================== Close Direct Invoice Bapa Nagar =================================================================================

	
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

public function getproductreg(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-reg');
	}
	else
	{
	redirect('index');
	}
}
//===================================================================================

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

public function getproductbapa(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproduct-bapa');
	}
	else
	{
	redirect('index');
	}
}


//===================================================================================
	
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
		redirect('OrderedInvoiceNew/managePurchaseOrder');
}

function delete_updata_stock($qty,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity+'$qty' where product_id='$main_id'");
		return;	
	}	


function ajax_updateInvoice(){
		
       $table_name = "tbl_ordered_invoice_dtl"; 
       $pri_col    = "ordered_invoiceid_dtl";

       $table_name1= "tbl_ordered_invoice_hdr";
       $pri_col1   = "ordered_invoiceid";
       $inId       = $this->input->post('invoiceId');
       
        $n = 0;$m = 0; 
        if(sizeof($this->input->post('cellsSize')) > 0){
            $sub_tot      = $this->input->post('sub_tot');  
			$balance_due  = $this->input->post('balance_due');
	        $data         = array();
	        $qtycount     = "";
	       // print_r($this->input->post('enterQty'));
	        $total        = 0;
        ///////////////// loop for Row  /////////////////// 
	    foreach ($this->input->post('cellsSize') as $value) { 
	       $explodeVal   = "";$qtyVall = ""; $quantityVal = "";                                   
		   $qty       = array();
	       $total     = $total+$value;

	       $rowId     = $this->input->post('rowId')[$n]; 
	       $rowQty    = $this->input->post('totalqty')[$n]; 

        //echo "select S.*,D.qty_val as qtyVal,D.total_qty as tQty,D.order_id from tbl_ordered_invoice_dtl D,tbl_product_stock S where S.Product_id = D.item_id and D.ordered_invoiceid_dtl = $rowId";

	       $qry       = $this->db->query("select S.*,D.qty_val as qtyVal,D.total_qty as tQty,D.order_id from tbl_ordered_invoice_dtl D,tbl_product_stock S where S.Product_id = D.item_id and D.ordered_invoiceid_dtl = $rowId");	
		   $fetchq         = $qry->row_array();
           $Qty_refill     = $fetchq['qtyinstock'];
           $ProId          = $fetchq['Product_id'];
           $ProcategoryId  = $fetchq['category'];

        //$muinas         = $fetchq['tQty']-$rowQty;

           $explodeVal     = explode(" ",$Qty_refill);
           $qtyVall        = explode(",",$fetchq['qtyVal']);          /////   ordered Qty //////
           $quantityVal    = explode(" ",$fetchq['quantity']);        ////   refill Qty  //////
           $totalqtyfetch  = ($fetchq['qtyinstock']+$fetchq['tQty'])-$rowQty; /// total qty ///
           $totalqtyfetch  = $fetchq['tQty'];


         ////////  loop for size and Enter Value  //////////

           $stockRefill    = "";
           $stockordered   = "";
           $qty            = "";
           $qtycount       = "";
           $StockordVal    = "";
           $StockRefillVal = "";
           $k = 0;
		   for($i=$m;$i < $total;$i++){                                                            
		   	  $qty[]       = $this->input->post('enterQty')[$i];
		   	  $stockordered[] = ($explodeVal[$k]+$qtyVall[$k])-$this->input->post('enterQty')[$i];
		   	  $stockRefill[]  = ($quantityVal[$k]+$qtyVall[$k])-$this->input->post('enterQty')[$i];
              // echo $explodeVal[$k].'+'.$qtyVall[$k].'-'.$this->input->post('enterQty')[$i];
              // echo "<br>";
              // echo $quantityVal[$k].'+'.$qtyVall[$k].'-'.$this->input->post('enterQty')[$i];
              //    echo "<br>last";
              $k++;
           }
          
            $m              = $m+$value;
	        $qtycount       = implode(',', $qty);
	        $StockordVal    = implode(' ', $stockordered);
	        $StockRefillVal = implode(' ', $stockRefill);

	        $rowPrice       = $this->input->post('finalPrice')[$n];
		    $rowdescription = $this->input->post('descname')[$n]; 
		   
            $data = array( 'qty_val' => $qtycount, 'total_qty' => $rowQty, 'total_price' => $rowPrice,'description' => $rowdescription );
            $this->Model_admin_login->update_user($pri_col,$table_name,$rowId,$data);   

           //echo "update tbl_product_stock set qtyinstock='$StockordVal',quantity='$StockRefillVal', total_qty='$totalqtyfetch' where Product_id=$ProId"; qtyinstock='$StockordVal'

		   $this->db->query("update tbl_product_stock set quantity='$StockRefillVal', total_qty='$totalqtyfetch' where Product_id=$ProId");

           // echo "update tbl_product_serial set quantity='$StockRefillVal', total_qty='$totalqtyfetch' where product_id='$ProId' and category='$ProcategoryId'";
		
		   $this->db->query("update tbl_product_serial set quantity='$StockRefillVal', total_qty='$totalqtyfetch' where product_id='$ProId' and category='$ProcategoryId'");

           $n++;
	    }

            $data1 = array('sub_tot' => $sub_tot, 'balance_due' => $balance_due );
            $this->Model_admin_login->update_user($pri_col1,$table_name1,$inId,$data1);
       
          echo 1;
    }

 }
		
}
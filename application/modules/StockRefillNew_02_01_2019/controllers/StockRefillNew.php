<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class StockRefillNew extends my_controller {
function __construct(){
   parent::__construct();
  $this->load->model('model_stock_manage');
$this->load->model('model_admin_login');
$this->load->library('pagination'); 
}     

//-----------------------------------Add Quantity----------------------

public function add_multiple_qty(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-quantity');
	}
	else
	{
	redirect('index');
	}		
}

public function managestocknational(){
	if($this->session->userdata('is_logged_in')){
			 		      ////Pagination start ///
	  $url   = site_url('/StockRefillNew/managestocknational?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_stock_manage->count_all_inward($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';
      $totalInward = $this->model_stock_manage->inwarqtys($this->input->get());

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/StockRefillNew/managestocknational?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
		$data=$this->user_function();// call permission fnctn
		$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page'],'total_inward_qty_sum'=>$totalInward);
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $pagination['per_page'];
		$data['page']=$pagination['page'];	
		$this->load->view('manage-stock-national', $data);
	}
	else
	{
	redirect('index');
	}		
}

//===========================================================================================
public function repsecinwdandoutwd(){
	if($this->session->userdata('is_logged_in')){
		 
		$this->load->view('view-second-inward-and-outward');
		
	}
	else
	{
	redirect('index');
	}		
}

public function edit_qty(){
	
		@extract($_POST);		
	 	
		$entedsqty=" ".$entqtysid;
		//$addpro= $this->input->post('add_new_product');	sizedata	
		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$authordate=$dt->format('d/m/Y H:i:s');
	
		$totentqts=$totalqty;
		if($totentqts>0){
			$entedsqty_log=$entedsqty;
			$totalqty_log=$totalqty;
		}else{
			$entedsqty_log=" ".$old_ent_qty_tot;
			$totalqty_log=$old_tottid;
		}

	$this->db->query("update tbl_product_stock_log set size='$sizedata', quantity='$entedsqty_log', total_qty='$totalqty_log' where p_logid='$updateid'");
	
	$this->db->query("update tbl_product_serial set size='$sizedata', quantity='$serisingalqtyids', total_qty='$seritotids' where serial_number='$serialids'");

	$this->db->query("update tbl_product_stock set quantity='$serisingalqtyids', total_qty='$seritotids' where Product_id='$proid'");

	$this->db->query("INSERT INTO tbl_stock_point_history_log SET quantity='$entedsqty_log', total_qty='$totalqty_log', p_logid='$updateid', author_date='$authordate', mode_status='update'");
	
}


public function repsitembyhistory(){
	if($this->session->userdata('is_logged_in')){
		 		      ////Pagination start ///
	  $url   = site_url('/StockRefillNew/repsitembyhistory?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_stock_manage->count_all_tbllog($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/StockRefillNew/repsitembyhistory?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
	$this->load->view('view-itembystock-report', $data);
		
	}
	else
	{
	redirect('index');
	}		
}

public function update_stock_point_history(){
	if($this->session->userdata('is_logged_in')){
		 		      ////Pagination start ///
	  $url   = site_url('/StockRefillNew/update_stock_point_history?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_stock_manage->count_all_tbl_history_log($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/StockRefillNew/update_stock_point_history?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
	$this->load->view('view-update-stock-point-report', $data);
		
	}
	else
	{
	redirect('index');
	}		
}


public function reportinward(){
	if($this->session->userdata('is_logged_in')){
	
	$this->load->view('view-inward-report');
		
	}
	else
	{
	redirect('index');
	}		
}

//===========================================================================================

public function repinwdandoutwd(){
	if($this->session->userdata('is_logged_in')){
			      ////Pagination start ///
	  $url   = site_url('/StockRefillNew/repinwdandoutwd?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_stock_manage->count_all_inward($this->input->get());
	  $totalInward = $this->model_stock_manage->inwarqtys($this->input->get());
	  $totaloutward = $this->model_stock_manage->outwardqtys($this->input->get());
	  $totactqtys=$totalInward-$totaloutward;
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/StockRefillNew/repinwdandoutwd?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);
		
		
      //////Pagination end ///
		$data=$this->user_function();// call permission fnctn
		$data['result'] = array('total_inward_qty_sum'=>$totalInward, 'total_outward_qty_sum'=>$totaloutward, 'total_act_qtys'=>$totactqtys);
		$data['pagination'] = $this->pagination->create_links();
		$data['per_page'] = $pagination['per_page'];
		$data['page']=$pagination['page'];
		$this->load->view('view-inward-and-outward', $data);
		
	}
	else
	{
	redirect('index');
	}		
}


public function Editqtyupdate(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-qty');
	}
	else
	{
	redirect('index');
	}		
}
	

public function updateStocknat(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('upadet-stock-nat');
	}
	else
	{
	redirect('index');
	}		
}


public function viewStockReport(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('view-stock-report');
	}
	else
	{
	redirect('index');
	}		
}

public function updateItemNat(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-item');
	}
	else
	{
	redirect('index');
	}		
}

public function insert_item(){
			
		@extract($_POST);
		$table_name ='tbl_product_stock';
		$pri_col ='Product_id';
	 	$id= $this->input->post('Product_id');
		$addpro= $this->input->post('add_new_product');
				
		$countsize=count($size);
		$out = array();
		$outweight = array();
		for($i=0;$i<$countsize;$i++){
				
				$sizeid=$this->input->post('size')[$i];
				$weightnameid=$this->input->post('weightname')[$i];
							
			if($sizeid!=''){					
					 array_push($out, $sizeid);
					 array_push($outweight, $weightnameid);					
				}	
				
			}
		
		$totalsize=implode(' ', $out);
		$totalweight=implode(' ', $outweight);
		
		 @$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
					$branchFetch2 = $branchQuery2->row();
		   
		
	$this->load->model('Model_admin_login');
	
		
				if($_FILES['image_name']['name']!='')
					{
						$target = "assets/image_data/"; 
						$target1 =$target . @date(U)."_".( $_FILES['image_name']['name']);
						$image_name=@date(U)."_".( $_FILES['image_name']['name']);
						move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
					}
					else
					
					{
					$image_name=$branchFetch2->product_image;
					
					}		
					$data= array(
					'productname' => $this->input->post('item_name'),
					'Product_type' => $this->input->post('Product_type'),
					'category' => $this->input->post('category'),
					'price_range' => $this->input->post('price_range'),
					'product_image' => $image_name,
					'size' => $totalsize,
					'weight_name' => $totalweight,
					'Product_typeid' => $Product_typeid,
					'sku_no' => $this->input->post('sku_no'),
					'min_re_order_level' => $this->input->post('min_re_order_level'),
					'usageunit' => $this->input->post('unit'),
					'pic_per_box' => $this->input->post('pic_per_box'),
					
					
					
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
				//$this->session->set_flashdata('flash_msg', 'Record Added Successfully.'); 
		 redirect('StockRefillNew/add_multiple_qty');
	}


//---------------------------------------End------------------------------------------

public function manageStockFirstNat(){
	 $table_name = 'tbl_stockpoint_and_vendor';
	if($this->session->userdata('is_logged_in')){
		      ////Pagination start ///
	  $url   = site_url('/StockRefillNew/manageStockFirstNat?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_stock_manage->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/StockRefillNew/manageStockFirstNat?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
		$data=$this->user_function();// call permission fnctn
		$data['pagination']        = $this->pagination->create_links();
		$data['per_page'] = $pagination['per_page'];
		$data['page']=$pagination['page'];
		$this->load->view('first-manage-stock-refill-nat',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageStockNat(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-nat',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateStockIn(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('Stock-in-invoice',$data);
	}
	else
	{
	redirect('index');
	}		
}
//========================================================================================

public function updateStockInMad(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('Stock-in-invoice-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateStockInSeel(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('Stock-in-invoice-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateStockInMum(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('Stock-in-invoice-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function updateStockInBapa(){
	if($this->session->userdata('is_logged_in')){
		$data['ID'] = $_GET['ID'];
		$this->load->view('Stock-in-invoice-bapa',$data);
	}
	else
	{
	redirect('index');
	}		
}


//========================================================================================
public function manageStockRag(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-reg',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageStockMad(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-mad',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageStockSeel(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-seel',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageStockMum(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-mum',$data);
	}
	else
	{
	redirect('index');
	}		
}

public function manageStockBapa(){
	if($this->session->userdata('is_logged_in')){
		$data=$this->user_function();// call permission fnctn
		$data['result'] = $this->model_stock_manage->stock_datas();
		$this->load->view('manage-stock-refill-bapa',$data);
	}
	else
	{
	redirect('index');
	}		
}

//========================================================================================
public function getsizecounttest(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getsizecountqty');
		
	}
	else
	{
	redirect('index');
	}
}


public function getsizecount(){
	if($this->session->userdata('is_logged_in')){
	 $data['countsize'] = $_GET['countsize'];
		$this->load->view('getsizecountqtyall',$data);
	}
	else
	{
	redirect('index');
	}
}


public function print_sales(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('email');
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

//============================================================= Regarpura ===============================================================================================

public function insertStockIn(){

		@extract($_POST);
		$table_name ='tbl_product_stock_regarpura';
		$pri_col ='Product_id_reg';
		$invoiceid=$this->input->post('invoiceid');
		$orderid=$this->input->post('orderid');		
			
		$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 $qtyval=$this->input->post('qty_val')[$i];
				 
				 $ordered_qtyval=$this->input->post('ordered_qty_val')[$i];
				 $ordered_totalqty=$this->input->post('ordered_total_qty')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];
				 $data_dtl['productname']=$this->input->post('productname')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['invoice_status']='Pending';
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
																
						
							}
																		
					}
			
				$queryItem=$this->db->query("select * from tbl_product_stock_regarpura where status='A' and item_id='$itemsid'");	 
				$fetchq=$queryItem->row();
				$rowitem=$queryItem->num_rows();
				
				if($rowitem>0){
					
					$qty=$fetchq->qty_val;
					$sizeval=$fetchq->size_val;
					$ordered_qtyvalst=$fetchq->ordered_qty_val;
					
		 $qtycount=sizeof(explode(',', $qty));
		 $sizecount=sizeof(explode(' | ', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  $sumqtyntor=0;
		  $out = array();
		  $outord = array();
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(' | ', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $expqtytext=explode(',', $qtyval);
		  $qtynt=$exp[$p]+$expqtytext[$p];
		   array_push($out, $qtynt);
		
		  $expord=explode(',', $ordered_qtyvalst);
		  $expqtytextord=explode(',', $ordered_qtyval);
		  $qtyntorder=$expord[$p]+$expqtytextord[$p];
		  array_push($outord, $qtyntorder);
		 // echo "<br/>";
			   $sumqtynt +=$qtynt;
		 	   $sumqtyntor +=$qtyntorder;
			}
		     
				  $impqty=implode(',', $out);		
				  $str = $impqty;
				  $str . "<br>";
				  $tqtyimp=rtrim($str,"0!");	
				   
				  $impqtyord=implode(',', $outord);		
				  $strord = $impqtyord;
				  $strord . "<br>";
				  $tqtyimpOrd=rtrim($strord,"0!");	
				  	 	
					$this->db->query("update tbl_product_stock_regarpura set qty_val='$tqtyimp',total_qty='$sumqtynt',ordered_qty_val='$tqtyimpOrd',ordered_total_qty='$sumqtyntor'  where item_id='$itemsid'");
									
				}else{												
				
					$this->Model_admin_login->insert_user($table_name,$data_dtl);					
					
				}
	
		
		$this->db->query("update tbl_ordered_invoice_hdr set stock_in_status='Completed' where ordered_invoiceid='$invoiceid'");
		
		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid'");
	
	$this->session->set_flashdata('flashmsg', 'Stock In Successfully.');						
					$rediectInvoice="StockRefillNew/StockRefillNew/manageStockRag";
					redirect($rediectInvoice);					
		
}

//========================================================================== Start Madipur ==================================================================================

public function insertStockInMad(){						

		@extract($_POST);
		$table_name ='tbl_product_stock_madipur';
		$pri_col ='Product_id_mad';
		$invoiceid=$this->input->post('invoiceid');
		$orderid=$this->input->post('orderid');		
			
		$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 $qtyval=$this->input->post('qty_val')[$i];
				 
				 $ordered_qtyval=$this->input->post('ordered_qty_val')[$i];
				 $ordered_totalqty=$this->input->post('ordered_total_qty')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];
				 $data_dtl['productname']=$this->input->post('productname')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['invoice_status']='Pending';
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
																
						
							}
																		
					}
			
				$queryItem=$this->db->query("select * from tbl_product_stock_madipur where status='A' and item_id='$itemsid'");	 
				$fetchq=$queryItem->row();
				$rowitem=$queryItem->num_rows();
				
				if($rowitem>0){
					
					$qty=$fetchq->qty_val;
					$sizeval=$fetchq->size_val;
					$ordered_qtyvalst=$fetchq->ordered_qty_val;
					
		 $qtycount=sizeof(explode(',', $qty));
		 $sizecount=sizeof(explode(' | ', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  $sumqtyntor=0;
		  $out = array();
		  $outord = array();
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(' | ', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $expqtytext=explode(',', $qtyval);
		  $qtynt=$exp[$p]+$expqtytext[$p];
		   array_push($out, $qtynt);
		
		  $expord=explode(',', $ordered_qtyvalst);
		  $expqtytextord=explode(',', $ordered_qtyval);
		  $qtyntorder=$expord[$p]+$expqtytextord[$p];
		  array_push($outord, $qtyntorder);
		 // echo "<br/>";
			   $sumqtynt +=$qtynt;
		 	   $sumqtyntor +=$qtyntorder;
			}
		     
				  $impqty=implode(',', $out);		
				  $str = $impqty;
				  $str . "<br>";
				  $tqtyimp=rtrim($str,"0!");	
				   
				  $impqtyord=implode(',', $outord);		
				  $strord = $impqtyord;
				  $strord . "<br>";
				  $tqtyimpOrd=rtrim($strord,"0!");	
				  	 	
					$this->db->query("update tbl_product_stock_madipur set qty_val='$tqtyimp',total_qty='$sumqtynt',ordered_qty_val='$tqtyimpOrd',ordered_total_qty='$sumqtyntor'  where item_id='$itemsid'");
									
				}else{												
				
					$this->Model_admin_login->insert_user($table_name,$data_dtl);					
					
				}
	
		
		$this->db->query("update tbl_ordered_invoice_hdr set stock_in_status='Completed' where ordered_invoiceid='$invoiceid'");
		
		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid'");
	
	$this->session->set_flashdata('flashmsg', 'Stock In Successfully.');						
					$rediectInvoice="StockRefillNew/StockRefillNew/manageStockMad";
					redirect($rediectInvoice);					
		

}

//============================================================================== close Madipur ========================================================================


//========================================================================== Start Seelampur ==================================================================================

public function insertStockInSeel(){						

		@extract($_POST);
		$table_name ='tbl_product_stock_seelampur';
		$pri_col ='Product_id_seel';
		$invoiceid=$this->input->post('invoiceid');
		$orderid=$this->input->post('orderid');		
			
		$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 $qtyval=$this->input->post('qty_val')[$i];
				 
				 $ordered_qtyval=$this->input->post('ordered_qty_val')[$i];
				 $ordered_totalqty=$this->input->post('ordered_total_qty')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];
				 $data_dtl['productname']=$this->input->post('productname')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['invoice_status']='Pending';
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
																
						
							}
																		
					}
			
				$queryItem=$this->db->query("select * from tbl_product_stock_seelampur where status='A' and item_id='$itemsid'");	 
				$fetchq=$queryItem->row();
				$rowitem=$queryItem->num_rows();
				
				if($rowitem>0){
					
					$qty=$fetchq->qty_val;
					$sizeval=$fetchq->size_val;
					$ordered_qtyvalst=$fetchq->ordered_qty_val;
					
		 $qtycount=sizeof(explode(',', $qty));
		 $sizecount=sizeof(explode(' | ', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  $sumqtyntor=0;
		  $out = array();
		  $outord = array();
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(' | ', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $expqtytext=explode(',', $qtyval);
		  $qtynt=$exp[$p]+$expqtytext[$p];
		   array_push($out, $qtynt);
		
		  $expord=explode(',', $ordered_qtyvalst);
		  $expqtytextord=explode(',', $ordered_qtyval);
		  $qtyntorder=$expord[$p]+$expqtytextord[$p];
		  array_push($outord, $qtyntorder);
		 // echo "<br/>";
			   $sumqtynt +=$qtynt;
		 	   $sumqtyntor +=$qtyntorder;
			}
		     
				  $impqty=implode(',', $out);		
				  $str = $impqty;
				  $str . "<br>";
				  $tqtyimp=rtrim($str,"0!");	
				   
				  $impqtyord=implode(',', $outord);		
				  $strord = $impqtyord;
				  $strord . "<br>";
				  $tqtyimpOrd=rtrim($strord,"0!");	
				  	 	
					$this->db->query("update tbl_product_stock_seelampur set qty_val='$tqtyimp',total_qty='$sumqtynt',ordered_qty_val='$tqtyimpOrd',ordered_total_qty='$sumqtyntor'  where item_id='$itemsid'");
									
				}else{												
				
					$this->Model_admin_login->insert_user($table_name,$data_dtl);					
					
				}
	
		
		$this->db->query("update tbl_ordered_invoice_hdr set stock_in_status='Completed' where ordered_invoiceid='$invoiceid'");
		
		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid'");
	
	$this->session->set_flashdata('flashmsg', 'Stock In Successfully.');						
					$rediectInvoice="StockRefillNew/StockRefillNew/manageStockSeel";
					redirect($rediectInvoice);					
		

}

//============================================================================== close Seelampur ========================================================================


//========================================================================== Start Mumbai ==================================================================================

public function insertStockInMum(){						

		@extract($_POST);
		$table_name ='tbl_product_stock_mumbai';
		$pri_col ='Product_id_mum';
		$invoiceid=$this->input->post('invoiceid');
		$orderid=$this->input->post('orderid');		
			
		$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 $qtyval=$this->input->post('qty_val')[$i];
				 
				 $ordered_qtyval=$this->input->post('ordered_qty_val')[$i];
				 $ordered_totalqty=$this->input->post('ordered_total_qty')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];
				 $data_dtl['productname']=$this->input->post('productname')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['invoice_status']='Pending';
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
																
						
							}
																		
					}
			
				$queryItem=$this->db->query("select * from tbl_product_stock_mumbai where status='A' and item_id='$itemsid'");	 
				$fetchq=$queryItem->row();
				$rowitem=$queryItem->num_rows();
				
				if($rowitem>0){
					
					$qty=$fetchq->qty_val;
					$sizeval=$fetchq->size_val;
					$ordered_qtyvalst=$fetchq->ordered_qty_val;
					
		 $qtycount=sizeof(explode(',', $qty));
		 $sizecount=sizeof(explode(' | ', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  $sumqtyntor=0;
		  $out = array();
		  $outord = array();
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(' | ', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $expqtytext=explode(',', $qtyval);
		  $qtynt=$exp[$p]+$expqtytext[$p];
		   array_push($out, $qtynt);
		
		  $expord=explode(',', $ordered_qtyvalst);
		  $expqtytextord=explode(',', $ordered_qtyval);
		  $qtyntorder=$expord[$p]+$expqtytextord[$p];
		  array_push($outord, $qtyntorder);
		 // echo "<br/>";
			   $sumqtynt +=$qtynt;
		 	   $sumqtyntor +=$qtyntorder;
			}
		     
				  $impqty=implode(',', $out);		
				  $str = $impqty;
				  $str . "<br>";
				  $tqtyimp=rtrim($str,"0!");	
				   
				  $impqtyord=implode(',', $outord);		
				  $strord = $impqtyord;
				  $strord . "<br>";
				  $tqtyimpOrd=rtrim($strord,"0!");	
				  	 	
					$this->db->query("update tbl_product_stock_mumbai set qty_val='$tqtyimp',total_qty='$sumqtynt',ordered_qty_val='$tqtyimpOrd',ordered_total_qty='$sumqtyntor'  where item_id='$itemsid'");
									
				}else{												
				
					$this->Model_admin_login->insert_user($table_name,$data_dtl);					
					
				}
	
		
		$this->db->query("update tbl_ordered_invoice_hdr set stock_in_status='Completed' where ordered_invoiceid='$invoiceid'");
		
		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid'");
	
	$this->session->set_flashdata('flashmsg', 'Stock In Successfully.');						
					$rediectInvoice="StockRefillNew/StockRefillNew/manageStockMum";
					redirect($rediectInvoice);					
		

}

//============================================================================== close Mumbai ========================================================================


//========================================================================== Start Bapa Nagar ==================================================================================

public function insertStockInBapa(){						

		@extract($_POST);
		$table_name ='tbl_product_stock_bapanagar';
		$pri_col ='Product_id_bapa';
		$invoiceid=$this->input->post('invoiceid');
		$orderid=$this->input->post('orderid');		
			
		$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss-1;
			for($i=0; $i<$forrow; $i++)
				{
				
				 $itemsid=$this->input->post('item_id')[$i];				
				 $qtyval=$this->input->post('qty_val')[$i];
				 
				 $ordered_qtyval=$this->input->post('ordered_qty_val')[$i];
				 $ordered_totalqty=$this->input->post('ordered_total_qty')[$i];
				 								
				if($itemsid!=''){
					
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];
				 $data_dtl['productname']=$this->input->post('productname')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('size_val')[$i];
				 $data_dtl['qty_val']=$this->input->post('qty_val')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty')[$i];				
				 $data_dtl['ordered_qty_val']=$this->input->post('ordered_qty_val')[$i];
				 $data_dtl['ordered_total_qty']=$this->input->post('ordered_total_qty')[$i];
				 $data_dtl['total_price']=$this->input->post('total_price')[$i];
				 $data_dtl['invoice_status']='Pending';
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');
																
						
							}
																		
					}
			
				$queryItem=$this->db->query("select * from tbl_product_stock_bapanagar where status='A' and item_id='$itemsid'");	 
				$fetchq=$queryItem->row();
				$rowitem=$queryItem->num_rows();
				
				if($rowitem>0){
					
					$qty=$fetchq->qty_val;
					$sizeval=$fetchq->size_val;
					$ordered_qtyvalst=$fetchq->ordered_qty_val;
					
		 $qtycount=sizeof(explode(',', $qty));
		 $sizecount=sizeof(explode(' | ', $sizeval));
		  
		  $sizent=0;
		  $qtynt=0;
		  $sumqtynt=0;
		  $sumqtyntor=0;
		  $out = array();
		  $outord = array();
		  for($p=0;$p<$sizecount;$p++){
		  
		  $expsize=explode(' | ', $sizeval);
		   $sizent=$expsize[$p];
		  
		  $exp=explode(',', $qty);
		  $expqtytext=explode(',', $qtyval);
		  $qtynt=$exp[$p]+$expqtytext[$p];
		   array_push($out, $qtynt);
		
		  $expord=explode(',', $ordered_qtyvalst);
		  $expqtytextord=explode(',', $ordered_qtyval);
		  $qtyntorder=$expord[$p]+$expqtytextord[$p];
		  array_push($outord, $qtyntorder);
		 // echo "<br/>";
			   $sumqtynt +=$qtynt;
		 	   $sumqtyntor +=$qtyntorder;
			}
		     
				  $impqty=implode(',', $out);		
				  $str = $impqty;
				  $str . "<br>";
				  $tqtyimp=rtrim($str,"0!");	
				   
				  $impqtyord=implode(',', $outord);		
				  $strord = $impqtyord;
				  $strord . "<br>";
				  $tqtyimpOrd=rtrim($strord,"0!");	
				  	 	
					$this->db->query("update tbl_product_stock_bapanagar set qty_val='$tqtyimp',total_qty='$sumqtynt',ordered_qty_val='$tqtyimpOrd',ordered_total_qty='$sumqtyntor'  where item_id='$itemsid'");
									
				}else{												
				
					$this->Model_admin_login->insert_user($table_name,$data_dtl);					
					
				}
	
		
		$this->db->query("update tbl_ordered_invoice_hdr set stock_in_status='Completed' where ordered_invoiceid='$invoiceid'");
		
		$this->db->query("update tbl_order_hdr set invoice_status='Completed' where order_id='$orderid'");
	
	$this->session->set_flashdata('flashmsg', 'Stock In Successfully.');						
					$rediectInvoice="StockRefillNew/StockRefillNew/manageStockBapa";
					redirect($rediectInvoice);					
		

}

//============================================================================== close Bapa Nagar ========================================================================


public function insertqty(){
				
				extract($_POST);
				
				date_default_timezone_set('Asia/Kolkata');
				$dt = new DateTime();
				$mdate=$dt->format('d/m/Y H:i:s');	
				
				$stockpname=$this->input->post('stockpid');
				$vendor_id=$this->input->post('vendorid');
				 
				$datename=$this->input->post('dateid');
				$urliddd=$this->input->post('upid');

				$comp_id = $this->session->userdata('comp_id');
				$divn_id = $this->session->userdata('divn_id');
				$zone_id = $this->session->userdata('zone_id');
				$brnh_id = $this->session->userdata('brnh_id');
				$maker_date= $mdate;
				$author_date= $mdate;

				for($i=0; $i<=$rows; $i++)
				{
				
				 $pid=$this->input->post('item_id')[$i];				 
				 $catid=$this->input->post('category_id')[$i];
				 $total_qty_values=$this->input->post('total_qty_value')[$i];
				 if($total_qty_values!=''){
				 $str = $qtyyallval[$i];
				 $str . "<br>";
				 $totalq=ltrim($str," ");
					
				 $selectQuery = "select * from tbl_product_stock where Product_id='$pid' and category='$catid'";
				 $selectQuery1=$this->db->query($selectQuery);									 
				 $num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_stock set quantity='$totalq', total_qty=total_qty+'$total_qty_values' where Product_id='$pid' and category='$catid'");
			
			
		}
			
		$sizeallvals=$this->input->post('sizeallval')[$i];	
		$location_id=$this->session->userdata('brnh_id');
		
		$selectQueryser = "select * from tbl_product_serial where product_id='$pid' and location_id='$location_id' and category='$catid' and stock_point='$stockpname' and vendor_id='$vendor_id'";
					$selectQueryser=$this->db->query($selectQueryser);
						$numser= $selectQueryser->num_rows();
							
		if($numser>0){
			
			$rowsss=$selectQueryser->row();
			$hdrid = $rowsss->serial_hdrid;
			$serialid = $rowsss->serial_number;	

			$this->db->query("update tbl_product_serial set size='$sizeallvals',quantity='$totalq',location_id='$location_id',total_qty=total_qty+'$total_qty_values' where product_id='$pid' and location_id='$location_id' and category='$catid' and stock_point='$stockpname' and vendor_id='$vendor_id'");
			
		$this->db->query("update tbl_product_serial_hdr set date_name='$datename', vendor_id='$vendor_id' where stock_point='$stockpname' and vendor_id='$vendor_id'");

		}else{							
				
				$this->db->query("insert into tbl_product_serial_hdr set vendor_id='$vendor_id', stock_point='$stockpname', date_name='$datename', comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");

				$hdrid = $this->db->insert_id();

				$this->db->query("insert into tbl_product_serial set serial_hdrid='$hdrid', vendor_id='$vendor_id', stock_point='$stockpname', date_name='$datename', size='$sizeallvals',quantity='$totalq',location_id='$location_id',product_id='$pid',category='$catid',total_qty=total_qty+'$total_qty_values',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
				
				$serialid = $this->db->insert_id();				
		}

		$qtyidval=$this->input->post('entqty')[$i];
		$total_qvalue=$this->input->post('total_qty_value')[$i];
		if($pid!=''){
		
			$this->db->query("insert into tbl_product_stock_log set serial_hdrid='$hdrid', serial_number='$serialid', vendor_id='$vendor_id', stock_point='$stockpname', date_name='$datename', size='$sizeallvals',quantity='$qtyidval',location_id='$location_id',product_id='$pid',category='$catid',total_qty='$total_qvalue',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
		
		 $updatehistoryid = $this->db->insert_id();

			 $this->db->query("INSERT INTO tbl_stock_point_history_log SET quantity='$qtyidval', total_qty='$total_qvalue', p_logid='$updatehistoryid', author_date='$mdate', mode_status='Insert'");

			//  $this->db->query("INSERT INTO tbl_stock_inword_log SET quantity='$qtyidval', total_qty='$total_qvalue', p_logid='$updatehistoryid', author_date='$mdate', mode_status='Insert'");

			}
				}
					}
				$this->session->set_flashdata('flashmsg', 'Quantity Added Successfully.'); 
				
			 $rediectInvoice="StockRefillNew/add_multiple_qty";
		redirect($rediectInvoice);		

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
		redirect('StockRefillNew/managePurchaseOrder');
}

function delete_updata_stock($qty,$main_id){
	
		 $this->db->query("update tbl_product_stock set quantity=quantity+'$qty' where Product_id='$main_id'");
		 $this->db->query("update tbl_product_serial set quantity=quantity+'$qty' where product_id='$main_id'");
		return;	
	}	

//==============================================================================================================================================
	
public function import_stocknat(){	
	if($this->session->userdata('is_logged_in')){	
		$this->load->view('import-stock-nat');
	}else{
	redirect('index');
	}

}


public function import_insert_stocknat(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"]; 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 

 $catId=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id!='121' and prodcatg_name='".$getData[1]."'");
 $catRow=$catId->row();
 
//select id of unit id
 $unitId=$this->db->query("select *from tbl_product_stock where productname='".$getData[0]."'");
 $unitRow=$unitId->row();
	         
if($getData[0]!='')
{
//========================================================================================
				
				 $pid=$unitRow->Product_id;				 
				 $catid=$catRow->prodcatg_id;
				 $total_qty_values=$getData[4];
				 $totalq=$getData[3];					
				 $selectQuery = "select * from tbl_product_stock where Product_id='$pid' and category='$catid'";
				 $selectQuery1=$this->db->query($selectQuery);									 
				 $num= $selectQuery1->num_rows();
						
		
		if($num>0){
			
			$this->db->query("update tbl_product_stock set quantity='$totalq', total_qty=total_qty+'$total_qty_values' where Product_id='$pid' and category='$catid'");
						
		}
	
		$sizeallvals=$getData[2];	
		$location_id=$this->session->userdata('brnh_id');
									
			$selectQueryser = "select * from tbl_product_serial where product_id='$pid' and location_id='$location_id' and category='$catid'";
					$selectQueryser=$this->db->query($selectQueryser);
						$numser= $selectQueryser->num_rows();
						
		
		if($numser>0){
			
			$this->db->query("update tbl_product_serial set size='$sizeallvals',quantity='$totalq',location_id='$location_id',total_qty=total_qty+'$total_qty_values' where product_id='$pid' and location_id='$location_id' and category='$catid'");
			
			
		}else{
			  								$comp_id = $this->session->userdata('comp_id');
											$divn_id = $this->session->userdata('divn_id');
											$zone_id = $this->session->userdata('zone_id');
											$brnh_id = $this->session->userdata('brnh_id');
											$maker_date= date('y-m-d');
											$author_date= date('y-m-d');
											
				$this->db->query("insert into tbl_product_serial set size='$sizeallvals',quantity='$totalq',location_id='$location_id',product_id='$pid',category='$catid',total_qty=total_qty+'$total_qty_values',comp_id='$comp_id',divn_id='$divn_id',zone_id='$zone_id',brnh_id='$brnh_id',maker_date='$maker_date',author_date='$author_date'");
					
		}				
									
//========================================================================================	
				   
}		
	         }
			 fclose($file);
		
		 }
	    
echo "<script>
alert('Stock Imported Successfully');
window.location.href = 'manageStockNat';
</script>";
			 	
}

//==============================================================================================================================================
		
}
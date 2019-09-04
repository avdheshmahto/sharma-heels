<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class GstInvoice extends my_controller {
function __construct(){
   parent::__construct(); 
$this->load->model('model_invoice');	
}     


public function gstinvoiceeditfun(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('gst_invoice_edit');
	}
	else
	{
	redirect('index');
	}		
}


public function gst_invoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('gst_invoice');
	}
	else
	{
	redirect('index');
	}		
}

public function edit_gst_item()
    {
        if($this->session->userdata('is_logged_in')){
        
        $this->load->view('edit-gst-item');
    }
    else
    {
    redirect('index');
    }    
	}
public function gst_table()
    {
        if($this->session->userdata('is_logged_in')){
        
        $this->load->view('gst-table');
    }
    else
    {
    redirect('index');
    }    
    
    }
//============================================ Insert GST INVOICE ========================
public function insertgstinvoice(){
		extract($_POST);

		$table_name='tbl_gst_invoice_hdr';
		$table_name_dtl='tbl_gst_invoice_dtl';
		$table_name_log='tbl_gst_invoice_log';
		$table_name_cash='tbl_payment_cash';
		$data= array(
							'firm_id' => $this->input->post('firmid'),
							'c_firm_name' => $this->input->post('c_firm_name'),
							'inv_date' => $this->input->post('currentdate_id'),
							'invoice_no' =>$this->input->post('invoice_id'),
							'customer_name' =>$this->input->post('customer_id'),
							'total'	=> $this->input->post('sumtot'),
							'gst_amt'=> $this->input->post('sumgst'),
							'grand_total'=>$this->input->post('grandtotal'),
							'total_billamt'=>$this->input->post('sumsubgst'),
						);
		
		$sesio = array(
							
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> date('y-m-d'),
							'author_date'=> date('y-m-d')
							);
		
		$this->load->model('Model_admin_login');
			
		$dataall = array_merge($data,$sesio);

		$this->Model_admin_login->insert_user($table_name,$dataall);
		$lastHdrId = $this->db->insert_id();

		$forrow = $this->input->post('rows');
			for($i=0; $i<$forrow; $i++)
				{
				 $cat_name  = $this->input->post('cate_id')[$i];
				 $qty     = $this->input->post('qty')[$i];
				 $rate = $this->input->post('ratesname')[$i];
				 $gstp = $this->input->post('gstp')[$i];
				 $amt = $this->input->post('amt')[$i];
				 $gst = $this->input->post('gst')[$i];
									 
						if($cat_name!=''){
					
				 $data_dtl['inv_id'] = $lastHdrId;
				 $data_dtl['category_id'] = $cat_name;
				 $data_dtl['qty'] = $qty;
				 $data_dtl['rate'] = $rate;				 
				 $data_dtl['gstp'] = $gstp;
				 $data_dtl['amt'] = $amt;
				 $data_dtl['gst'] = $gst;	 
				 $data_dtl['total'] = $this->input->post('total');	
				 $data_dtl['gst_amt'] = $this->input->post('gstamt');	
				 $data_dtl['grand_total'] = $this->input->post('grandtotal');	
				 $data_dtl['maker_id']          = $this->session->userdata('user_id');
				 $data_dtl['maker_date']        = date('y-m-d');
				 $data_dtl['comp_id']           = $this->session->userdata('comp_id');
				 $data_dtl['zone_id']           = $this->session->userdata('zone_id');
				 $data_dtl['brnh_id']           = $this->session->userdata('brnh_id');
				 $data_dtl['divn_id']			= $this->session->userdata('divn_id');		
				 $data_dtl['author_id']			= $this->session->userdata('user_id');		
				 $data_dtl['author_date']        = date('y-m-d');
				 $data_dtl['inv_status']="InsertGst";
				 $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);	
				 $this->Model_admin_login->insert_user($table_name_log,$data_dtl);	
														}
				}

		$datacash=array(
			'contact_id'=>$this->input->post('customer_id'),
			'total_billamt'=>$this->input->post('sumsubgst'),
			'payment_mode'=>"gst",
			'firm'=>$this->input->post('firmid'),
			'date'=>$this->input->post('currentdate_id'),
		);
		$casharr=array_merge($datacash,$sesio);
		$this->Model_admin_login->insert_user($table_name_cash,$casharr);			
		redirect('GstInvoice/manage_invoice');	
		
	}
//============================================CLOSE Insert GST INVOICE ========================

//============================================ EDIT GST INVOICE ========================
public function editgstinvoice(){
		extract($_POST);

		$table_name='tbl_gst_invoice_hdr';
		$table_name_dtl='tbl_gst_invoice_dtl';
		$pri_col="gst_inv_id";
		$id=$this->input->post("myupid");
				
		$data= array(
							'firm_id' => $this->input->post('firmid'),
							'inv_date' => $this->input->post('currentdate_id'),
							'invoice_no' =>$this->input->post('invoice_id'),
							'customer_name' =>$this->input->post('customer_id'),
							'total'	=> $this->input->post('sumtot'),
							'gst_amt'=> $this->input->post('sumgst'),
							'grand_total'=>$this->input->post('grandtotal'),
						);
		
		$sesio = array(
							
							'comp_id' => $this->session->userdata('comp_id'),
							'divn_id' => $this->session->userdata('divn_id'),
							'zone_id' => $this->session->userdata('zone_id'),
							'brnh_id' => $this->session->userdata('brnh_id'),
							'author_id' => $this->session->userdata('user_id'),
							'maker_id'=> $this->session->userdata('user_id'),
							'maker_date'=> date('y-m-d'),
							'author_date'=> date('y-m-d')
							);
		
		$this->load->model('Model_admin_login');
			
		$dataall = array_merge($data,$sesio);

		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
		
		$forrow = $this->input->post('rows');
			for($i=0; $i<$forrow; $i++)
				{
				 $cat_name  = $this->input->post('cate_id')[$i];
				 $qty     = $this->input->post('qty')[$i];
				 $rate = $this->input->post('ratesname')[$i];
				 $gstp = $this->input->post('gstp')[$i];
				 $amt = $this->input->post('amt')[$i];
				 $gst = $this->input->post('gst')[$i];
									 
						if($cat_name!=''){
					
				 $data_dtl['inv_id'] = $id;
				 $data_dtl['category_id'] = $cat_name;
				 $data_dtl['qty'] = $qty;
				 $data_dtl['rate'] = $rate;				 
				 $data_dtl['gstp'] = $gstp;
				 $data_dtl['amt'] = $amt;
				 $data_dtl['gst'] = $gst;	 
				 $data_dtl['total'] = $this->input->post('total');	
				 $data_dtl['gst_amt'] = $this->input->post('gstamt');	
				 $data_dtl['grand_total'] = $this->input->post('grandtotal');	
				 $data_dtl['maker_id']          = $this->session->userdata('user_id');
				 $data_dtl['maker_date']        = date('y-m-d');
				 $data_dtl['comp_id']           = $this->session->userdata('comp_id');
				 $data_dtl['zone_id']           = $this->session->userdata('zone_id');
				 $data_dtl['brnh_id']           = $this->session->userdata('brnh_id');
				 $data_dtl['divn_id']			= $this->session->userdata('divn_id');		
				 $data_dtl['author_id']			= $this->session->userdata('user_id');		
				 $data_dtl['author_date']        = date('y-m-d');
				 
				 $this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);	

										}
				}
					
		redirect('GstInvoice/manage_invoice');	
		
	}
//============================================CLOSE EDIT GST INVOICE ========================

//============================================ EDIT GST INVOICE ITEM BY =======================
public function updategstorder(){
		extract($_POST);
		
		$table_name='tbl_gst_invoice_hdr';
		$table_name_dtl='tbl_gst_invoice_dtl';
		$pri_col="gst_inv_id";
		$pri_col_dtl="p_id";
		$id=$this->input->post("upid");
		$id_dtl=$this->input->post("eid");
//echo $id."hello";die;
		$data= array(
					'firm_id' => $this->input->post('myfirmid'),
					'inv_date' => $this->input->post('mycurrentdate_id'),
					'invoice_no' =>$this->input->post('myinvoice_id'),
					'customer_name' =>$this->input->post('mycustomer_id'),
					'total' =>$this->input->post('to_totid'),
					'gst_amt' =>$this->input->post('to_gsttot'),
					'grand_total' =>$this->input->post('to_gtot'),	
		      	);

		$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_id'=> $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);

			$this->load->model('Model_admin_login');
					
		$dataall = array_merge($data,$sesio);

		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
//$lastHdrId = $this->db->insert_id();
				 $cat_name  = $this->input->post('mycatid');
				 $qty     = $this->input->post('myqty');
				 $rate = $this->input->post('myrate');
				 $gstp = $this->input->post('mygst_percent');
				 $amt = $this->input->post('myamount');
				 $gst = $this->input->post('mygst');
									 
						if($cat_name!=''){
				 $data_dtl['inv_id'] = $id;	
				 $data_dtl['category_id'] = $cat_name;
				 $data_dtl['qty']           = $qty;
				 $data_dtl['rate']       = $rate;				 
				 $data_dtl['gstp']       = $gstp;
				 $data_dtl['amt']          = $amt;
				 $data_dtl['gst']       = $gst;	
				 $data_dtl['total'] = $this->input->post('to_totid');	
				 $data_dtl['gst_amt'] = $this->input->post('to_gsttot');	
				 $data_dtl['grand_total'] = $this->input->post('to_gtot');	
				 
				 $data_dtl['maker_id']          = $this->session->userdata('user_id');
				 $data_dtl['maker_date']        = date('y-m-d');
				 $data_dtl['comp_id']           = $this->session->userdata('comp_id');
				 $data_dtl['zone_id']           = $this->session->userdata('zone_id');
				 $data_dtl['brnh_id']           = $this->session->userdata('brnh_id');
				 $data_dtl['divn_id']			= $this->session->userdata('divn_id');		
				 $data_dtl['author_id']			= $this->session->userdata('user_id');		
				 $data_dtl['author_date']        = date('y-m-d');
				 
		$this->Model_admin_login->update_user($pri_col_dtl,$table_name_dtl,$id_dtl,$data_dtl);	

		}		
		redirect('GstInvoice/manage_invoice');			
			
			}

//============================================CLOSE GST INVOICE ITEM BY======================
public function manage_invoice()
	{
		if($this->session->userdata('is_logged_in')){
		 ////Pagination start ///
	  $url   = site_url('/GstInvoice/manage_invoice?');
	  $sgmnt = "4";
	  $showEntries =10;
      $totalData  = $this->model_invoice->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'10';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/GstInvoice/manage_invoice?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page']   = $pagination['per_page'];
	$data['page']=$pagination['page'];	
			$this->load->view('manage-invoice', $data);
	}
	else
	{
	redirect('index');
	}		
			
	}	

public function update_gst_Ordered()
	{
		if($this->session->userdata('is_logged_in'))
			{
				$data['upid']=$_GET['upid'];
				$this->load->view('update_gst_Ordered',$data);
			}
		
	}

public function view_gst_Ordered()
	{
		if($this->session->userdata('is_logged_in'))
			{
				$data['vid']=$_GET['vid'];
				$this->load->view('view_gst_Ordered',$data);
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

public function printGSTInvoice(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('printout');
	}
	else
	{
	redirect('index');
	}
}

//==============================================================================================================================================
//=============DELETE ENTRY ON GST EDIT INVOICE PAGE==================
public function deleteinvoicedtl(){
	if($this->session->userdata('is_logged_in'))
	{
		$table_name="tbl_gst_invoice_hdr";
		$total=$_GET['total'];
		$gstamt=$_GET['gstamt'];
		$grandtotal=$_GET['grandtotal'];
		$dataall=array(
		'total'=>$total,
		'gst_amt'=>$gstamt,
		'grand_total'=>$grandtotal,
		);
		$pri_col="gst_inv_id";
		$query=$this->db->query("select * from tbl_gst_invoice_dtl where p_id='".$_GET['id']."'");
		$res=$query->row();
		$id=$res->inv_id;
		echo $id."id".$dataall['total']."total".$dataall['gst_amt']."gstamt".$dataall[grand_total]."grandtotal";
			$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
	   
	   $this->db->query("DELETE FROM tbl_gst_invoice_dtl WHERE p_id='".$_GET['id']."'");
				
	}
	else
	{
	redirect('index');
	}		
}

public function post_c_firm_name()
	{
		$data['cid']=$_POST['cid'];
		$this->load->view('c_firm_name',$data);
	} 	
}	
		

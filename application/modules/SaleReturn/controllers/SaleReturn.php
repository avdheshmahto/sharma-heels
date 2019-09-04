<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class SaleReturn extends my_controller {
function __construct(){
   parent::__construct();
  $this->load->model('model_stock_manage');

}     

//-----------------------------------Add Quantity----------------------

public function manageSaleReturn(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-sale-return');
	}
	else
	{
	redirect('index');
	}		
}

public function addSaleReturn(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-sale-return');
	}
	else
	{
	redirect('index');
	}		
}

public function viewSaleReturn(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('view-sale-return');
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


//---------------------------------------End------------------------------------------


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

public function insertsalereturn(){

					extract($_POST);
					$table_name ='tbl_sale_return_hdr';
					$pri_col ='sale_return_id';
					
					$table_name_dtl ='tbl_sale_return_dtl';
					$pri_col_dtl ='sale_return_dtl_id';
						
					$custidd=$this->input->post('customer_id');	
		          	$storeid=$this->input->post('store_id');
							
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
					'type_name' => $this->input->post('type_name'),
					'return_date' => $this->input->post('return_date'),
					'store_id' => $this->input->post('store_id'),
					
					);
			
			$data_merge = array_merge($data,$sess);					
		    $this->load->model('Model_admin_login');	
		    //$this->Model_admin_login->insert_user($table_name,$data_merge);
			$lastHdrId=$this->db->insert_id();		
			
			$rowss=$this->input->post('rows');			
			$this->load->model('Model_admin_login');	
			$forrow=$rowss;
			for($i=0; $i<$forrow; $i++)
				{
				
				$itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 
				if($itemsid!=''){
					
				 $data_dtl['sale_return_id']=$lastHdrId;
				 $data_dtl['item_id']=$this->input->post('item_id')[$i];				 
				 $data_dtl['customer_id']=$custidd;
				 $data_dtl['store_id']=$storeid;
				 $data_dtl['return_date']=$this->input->post('return_date');
				 $data_dtl['productname']=$this->input->post('item_name')[$i];	
				 $data_dtl['category_id']=$this->input->post('category_id')[$i];
				 $data_dtl['size_val']=$this->input->post('sizeallval')[$i];
				 $data_dtl['qty_val']=$this->input->post('qtyyallval')[$i];
				 $data_dtl['total_qty']=$this->input->post('total_qty_value')[$i];				
				 $data_dtl['one_item_price']=$this->input->post('pricename')[$i];
				 $data_dtl['maker_id']=$this->session->userdata('user_id');
				 $data_dtl['maker_date']=date('y-m-d');
				 $data_dtl['comp_id']=$this->session->userdata('comp_id');
				 $data_dtl['zone_id']=$this->session->userdata('zone_id');
				 $data_dtl['brnh_id']=$this->session->userdata('brnh_id');		
												
				//$this->Model_admin_login->insert_user($table_name_dtl,$data_dtl);		
									
			
				 $itemsid=$this->input->post('item_id')[$i];
				 $category_id=$this->input->post('category_id')[$i];
				 
				 $qry=$this->db->query("select * from tbl_product_serial where product_id='$itemsid' and category='$category_id'");	
				 $fetchq=$qry->row();
				 $torderv=$fetchq->size;
				 $toactqty=$fetchq->quantity;
				 $toqty=$fetchq->total_qty;				 
				 $sizecount=sizeof(explode(' | ', $torderv));
				 $qtystock=explode(' ', $toactqty);
				 for($j=0;$j<$sizecount;$j++){
						
					 echo $qtystock[$j];	
						
					}
			
							}
					}
				
			
			$this->session->set_flashdata('flash_msg', 'Sale Return is Successfully.');
				
			 $rediectInvoice="SaleReturn/addSaleReturn";
		//redirect($rediectInvoice);	
	   					  						
}

		
}
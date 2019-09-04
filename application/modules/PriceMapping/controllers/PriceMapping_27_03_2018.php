<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class PriceMapping extends my_controller {
function __construct(){
   parent::__construct(); 
}     

public function managePriceMapping(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping');
	}
	else
	{
	redirect('index');
	}		
}

public function managePriceMappingReg(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping-reg');
	}
	else
	{
	redirect('index');
	}		
}

public function managePriceMappingMad(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping-mad');
	}
	else
	{
	redirect('index');
	}		
}

public function managePriceMappingSeel(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping-seel');
	}
	else
	{
	redirect('index');
	}		
}

public function managePriceMappingMum(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping-mum');
	}
	else
	{
	redirect('index');
	}		
}

public function managePriceMappingBapa(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('manage-price-mapping-bapa');
	}
	else
	{
	redirect('index');
	}		
}


public function contact_product_price_mapping(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('contact-product-price-mapping');
	}
	else
	{
	redirect('index');
	}		
}

public function contact_product_price_mapping_loc(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('contact-product-price-mapping-loc');
	}
	else
	{
	redirect('index');
	}		
}

public function insertSalesOrder(){
		extract($_POST);

$table_name='tbl_contact_product_price_mapping';
$pri_col='product_id';

$custid=$this->input->post('customer_id');
$locid=$this->input->post('location_name');

$a=sizeof($main_id);
for($i=0; $i<$a; $i++){
if($new_price[$i]!='')
{

$checkQuery=$this->db->query("select *from tbl_contact_product_price_mapping where product_id='$main_id[$i]' and contact_id='$custid' and catg_id='$cate_id[$i]' and location_name='$locid'");
$cnt=$checkQuery->num_rows();
$data= array(
					'product_id' => $this->input->post('main_id')[$i],
					'catg_id' => $this->input->post('cate_id')[$i],
					'price' => $this->input->post('new_price')[$i],
					'contact_id' =>$this->input->post('customer_id'),
					'location_name' =>$this->input->post('location_name'),
					'credit_limit' =>$this->input->post('credit_limit'),
		      	);

$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);

			$this->load->model('Model_admin_login');
		

if($cnt>0)
{
$id=$main_id[$i];
$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data);
}
else

{

			
		$dataall = array_merge($data,$sesio);

$this->Model_admin_login->insert_user($table_name,$dataall);
}
		
}

}


$this->session->set_flashdata('flashmsg', 'Product Mapped Successfully.');

	redirect('PriceMapping/contact_product_price_mapping?id='.$custid.'^'.$locid);	
	/*echo "<script>";
	echo "open(location, '_self').close(); ";
	echo "</script>";
	*/
	}
	
public function updateprice(){
		
		extract($_POST);
		
		$id=$this->input->post('updateid');
		$price=$this->input->post('price');
		$contact_id=$this->input->post('contact_id');
		$location_name=$this->input->post('location_name');
		
		$this->load->model('Model_admin_login');
		
		if($price!=''){
			
				$this->db->query("update tbl_contact_product_price_mapping set price='$price' where id='$id'");	
				
				$this->session->set_flashdata('flashmsg', 'Update Price Successfully.');
			}
			
		redirect('PriceMapping/contact_product_price_mapping?id='.$contact_id.'^'.$location_name);
			
		}

public function updateCreditLimit(){
		
		extract($_POST);
		
		$creditlimit=$this->input->post('creditlimit');
		$contact_id=$this->input->post('contact_id');
		$location_name=$this->input->post('location_name');
		
		$this->load->model('Model_admin_login');
		
		if($creditlimit!=''){
			
				$this->db->query("update tbl_contact_m set credit_limit='$creditlimit' where contact_id='$contact_id' and module_status='$location_name'");	
				
				$this->session->set_flashdata('flashmsg', 'Update Credit Limit Successfully.');
			}
			
		redirect('PriceMapping/managePriceMapping');
			
		}

public function updateCreditLimitLoc(){
		
		extract($_POST);
		
		$creditlimit=$this->input->post('creditlimit');
		$contact_id=$this->input->post('contact_id');
		$location_name=$this->input->post('location_name');
		
		$this->load->model('Model_admin_login');
		
		if($creditlimit!=''){
			
				$this->db->query("update tbl_location set credit_limit='$creditlimit' where id='$contact_id' and location_name='$location_name'");	
				
				$this->session->set_flashdata('flashmsg', 'Update Credit Limit Successfully.');
			}
			
		redirect('PriceMapping/managePriceMapping');
			
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

public function getproductloc(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('getproductloc');
	}
	else
	{
	redirect('index');
	}
}


public function EditCreditLimit(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-credit-limit');
	}
	else
	{
	redirect('index');
	}		
}

public function EditCreditLimitLoc(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-credit-limit-loc');
	}
	else
	{
	redirect('index');
	}		
}

public function EditPriceMap(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-price-map');
	}
	else
	{
	redirect('index');
	}		
}

public function EditPriceMapLoc(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('edit-price-map-loc');
	}
	else
	{
	redirect('index');
	}		
}
	
public function all_product_function(){
	
		$this->load->view('all-product',$data);
	
	}

	
	
}	
		

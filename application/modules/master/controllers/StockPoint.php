<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class StockPoint extends my_controller {

function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
}


public function addStockPoint(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('/StockPoint/add-stock-point');
	}
	else
	{
	redirect('index');
	}
}


	public function manageStockPoint(){

 	$table_name = 'tbl_stockpoint_and_vendor';
	if($this->session->userdata('is_logged_in')){
    ////Pagination start ///
	  $url   = site_url('/master/StockPoint/manageStockPoint?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_master->count_all_stockpointandvendor($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/master/StockPoint/manageStockPoint?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	

			$this->load->view('/StockPoint/manage-stock-point',$data);
	}
	else
	{
	redirect('index');
	}
}


public function updateStockPoint(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/StockPoint/edit-stock-point',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewCustomerNat(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/StockPoint/view-contact-nat',$data);
	}
	else
	{
	redirect('index');
	}
}


public function updateStockPointss(){
	
		@extract($_POST);
		
		$table_name ='tbl_stockpoint_and_vendor';
		$pri_col ='stockpid';
		$id =  $this->input->post('vendorid');

		$total='0';

		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$mdate=$dt->format('d/m/Y H:i:s');	


		$data= array(
					'stockpointname' =>  $this->input->post('stockpoint'),	
					'type' =>  $this->input->post('pointtype'),
	                'phone_no' =>  $this->input->post('mobile'),
	                'gst_per' =>  $this->input->post('gst'),
	                'address' =>  $this->input->post('addressidds'),					
					
					);

	   $sesio = array(
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> $mdate,
					'author_date'=> $mdate

					);
		
		
		$data_entr = array_merge($data,$sesio);
		
    	$this->load->model('Model_admin_login');
		
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
		
		$lastid = $id;

		$this->software_log_insert($lastid,$lastid,$total,'StockPoint/Vendor Updated');	

			$this->load->view('master/StockPoint/second-stock-point');	
	
	}


public function insert_stockpoint(){
		
		@extract($_POST);
		$table_name ='tbl_stockpoint_and_vendor';
		$pri_col ='stockpid';
		$total='0';

		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$mdate=$dt->format('d/m/Y H:i:s');	

		$data= array(
					'stockpointname' => $this->input->post('stockpointid'),	
					'type' => $this->input->post('pointtypeid'),
	                'phone_no' => $this->input->post('mobile'),
	                'gst_per' => $this->input->post('gstid'),
	                'address' => $this->input->post('addressid'),
							
					);

	   $sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> $mdate,
					'author_date'=> $mdate

					);
		
		
		$data_entr = array_merge($data,$sesio);
		
    	$this->load->model('Model_admin_login');
														
		$this->Model_admin_login->insert_user($table_name,$data_entr);
		$lastid = $this->db->insert_id();

		$this->software_log_insert($lastid,$lastid,$total,'StockPoint/Vendor added');		
										     
		$this->load->view('master/StockPoint/second-stock-point');
				
	}
	

}
?>
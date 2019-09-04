<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Masterdata extends my_controller {
function __construct(){
parent::__construct();
$this->load->model('model_admin');

}
	

//----------------------------------start master data function-----------------------

	public function masterdata_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_master_data');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('param_id',$row->param_id)
           -> get('tbl_master_data_mst');
		  $compRow = $compQuery->row();
	
			$info[$i]['1']=$compRow->keyname;
			$info[$i]['2']=$row->keyvalue;
			$info[$i]['3']=$row->description;
			$info[$i]['4']=$row->serial_number;
			
				$i++;
			
		}
		return $info;
	
	}
	
	public function insert_master_data(){
		
		extract($_POST);
		$table_name ='tbl_master_data';
		 $pri_col ='serial_number';
		// echo $param_id.",".$keyvalue.",".$description.",".$serial_number.",";die;
	 	$id= $this->input->post('serial_number');		
		$count= count($id);
		//echo $count;die;
		$this->load->model('Model_admin_login');
		
		if($id!=''){
					for($i=0;$i<$count;$i++){
					$idE=$serial_number[$i];
					$dataarr = array(
					
					'param_id' => $this->input->post('param_id')[$i],
					'keyvalue' => $this->input->post('keyvalue')[$i],
					'description' => $this->input->post('description')[$i]
					
					);
					//echo $idE.",".$param_id[$i].",".$keyvalue[$i].",".$description[$i];die;
					$this->Model_admin_login->update_user($pri_col,$table_name,$idE,$dataarr);
					}
					$this->session->set_flashdata('flash_msg', 'Record Update Successfully.');
				redirect('/admin/masterdata/manage_master_data');
					}
		else
				{
				$data = array(
					
					'param_id' => $this->input->post('param_id'),
					'keyvalue' => $this->input->post('keyvalue'),
					'description' => $this->input->post('description')
					
					);
		$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
			$dataall=array_merge($data,$sesio);
				
				$this->Model_admin_login->insert_user($table_name,$dataall);
				$this->session->set_flashdata('flash_msg', 'Record Added Successfully.');
				redirect('/admin/masterdata/manage_master_data');
				}
				
			}	
			
public function add_master_data(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('/masterdata/add-master-data');
		
	}
	else
	{
	redirect('index');
	}
	
	
}
	
	public function manage_master_data(){
	
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_admin->master_data();
	$this->load->view('/masterdata/manage-master-data',$data);
	}
	else
	{
	redirect('index');
	}
	
	
}

	//--------------------------close master data -----------------------------------	



	
}


?>
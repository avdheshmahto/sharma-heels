<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Enterprise extends my_controller {

//-----------------Enterprise starts function----------------
public function manage_enterprise(){
	
	if($this->session->userdata('is_logged_in')){
$data=$this->user_function();// call permission fnctn
	$this->load->view('enterprise/manage-enterprise',$data);
	}
	else
	{
	redirect('index');
	}
}
public function enterprice_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_enterprise_mst');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
			
			$info[$i]['1']=$row->comp_id;
			$info[$i]['2']=$row->code;
			$info[$i]['3']=$row->comp_name;			
			
				$i++;
			
		}
		return $info;
	
	}		

public function add_enterprise(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
		$this->load->view('enterprise/add-enterprise',$data);
	}
	else
	{
	redirect('index');
	}
}

public function insert_enterprise(){
	
		@extract($_POST);
		$table_name ='tbl_enterprise_mst';
		$pri_col ='comp_id';
	 	$id= $this->input->post('comp_id');
		$count=count($id);
		$this->load->model('Model_admin_login');
		if($id!=''){
				for($i=0;$i<=$count;$i++){
					$idE= $this->input->post('comp_id')[$i];
					$dataarr= array(
						'code' => $this->input->post('code')[$i],
						'comp_name' => $this->input->post('comp_name')[$i],
					);
					
					$this->Model_admin_login->update_user($pri_col,$table_name,$idE,$dataarr);
				}
					$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.');
					redirect('admin/Enterprise/manage_enterprise');
		}else{
		$data= array(
					'code' => $this->input->post('code'),
					'comp_name' => $this->input->post('comp_name'),
					);
		$sesio = array(
					
					'compa_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
		
		$data_entr = array_merge($data,$sesio);
		
		
		    	$this->Model_admin_login->insert_user($table_name,$data_entr);
				$this->session->set_flashdata('flash_msg', 'Record Added Successfully.');
				redirect('admin/Enterprise/manage_enterprise');
		}
	
}

//----------------- Close Enterprise starts function----------------

	
}


?>
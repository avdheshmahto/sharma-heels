<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Role extends my_controller {

	

//-----------------role function---------------	
public function add_role(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('/role/add-role');
	}
	else
	{
	redirect('index');
	}
	
	
}	

public function manage_role(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
		$this->load->view('/role/manage-role',$data);
	}
	else
	{
	redirect('index');
	}

}

	public function role_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A','comp_id',$this->session->userdata('comp_id'))
           -> get('tbl_role_mst');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
			$info[$i]['1']=$row->code;
			$info[$i]['2']=$row->role_name;
			$info[$i]['3']=$row->role_id;	
			$info[$i]['4']=$row->action;	
				$i++;
			
		}
		return $info;
	
	}

public function insert_role(){
	
	extract($_POST);
		$tablename ='tbl_role_mst';
		$pri_col ='role_id';
	 	$id= $this->input->post('role_id');
		$count= count($id);
		
		$this->load->model('Model_admin_login');
	if($id==''){
		$action1= $this->input->post('action1');
		$action2= $this->input->post('action2');
		$action3= $this->input->post('action3');
		$action4= $this->input->post('action4');
		$ction =$action1."-".$action2."-".$action3."-".$action4;
				
		$data = array(
					'code' => $this->input->post('code'),
				'role_name' => $this->input->post('role_name'),
					'action'=>$ction
					);
					
//create session					
					
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
		
				$this->Model_admin_login->insert_user($tablename,$dataall);
				$this->session->set_flashdata('flash_msg', 'Record Added Successfully.');
				redirect('/admin/role/manage_role');
	}else
		{
				for($i=0;$i<=$count;$i++){
				
				$idE=$this->input->post('role_id')[$i];
				
				$action1= $this->input->post('action1')[$i];
				$action2= $this->input->post('action2')[$i];
				$action3= $this->input->post('action3')[$i];
				$action4= $this->input->post('action4')[$i];
				$ction[] =$action1."-".$action2."-".$action3."-".$action4;
				
				$dataarr = array(
					'code' => $this->input->post('code')[$i],
					'role_name' => $this->input->post('role_name')[$i],
					'action'=>$ction[$i]
					);
					
					$this->Model_admin_login->update_user($pri_col,$tablename,$idE,$dataarr);
					
				}
					$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.');
					redirect('/admin/role/manage_role');
				
				}
}



	//--------------------------close role data -----------------------------------	

	

	
}


?>
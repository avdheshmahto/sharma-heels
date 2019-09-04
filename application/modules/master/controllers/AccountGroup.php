<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class AccountGroup extends my_controller {

	public function insert_account(){	
			extract($_POST);
			$table_name ='tbl_account_mst';
		 	$pri_col ='account_id';
	 		$id= $this->input->post('account_id');
			$mid1= $this->input->post('mid1');
			if($mid1==''){
			$mid= $this->input->post('mid');
			}else{
			$mid= $this->input->post('mid1');
			}
			$data=array(
					
					'account_name' => $this->input->post('account_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'main_account_id' => $mid
					
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
					$this->load->model('Model_admin_login');
							
								
		if($id!=''){
					$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
					}
		else
				{
					if($mid==1){
					$this->Model_admin_login->insert_user($table_name,$dataall);
					redirect('/master/AccountGroup/manage_account');
					}else{
					$this->Model_admin_login->insert_user($table_name,$dataall);
					echo "<script type='text/javascript'>";
					echo "window.close();";
					echo "window.opener.location.reload();";
					echo "</script>";
				
				}
				}
				
			}	
			

public function add_account(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('AccountGroup/add-account-grp');
	}
	else
	{
	redirect('index');
	}
	
	
}
	
	public function manage_account(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('AccountGroup/manage-account-grp',$data);
	}
	else
	{
	redirect('index');
	}
	
	
}

		
public function accountfunction(){
	
		$data['accountid']=$_GET['accountid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
public function acc_alies_function(){
	
		$data['ac_alies_id']=$_GET['ac_alies_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
//--------------------------close accountfunction -----------------------------------	

}
?>
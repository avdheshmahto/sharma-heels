<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Location extends my_controller {

public function manage_location(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$this->load->view('manage-location',$data);
	}
	else
	{
	redirect('index');
	}
		
}

public function location_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_location');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		 		  
		  $compQuery1 = $this -> db
           -> select('*')
           -> where('brnh_id',$row->branch_id)
           -> get('tbl_branch_mst');
		  $keyvalue1 = $compQuery1->row();
		  
		
			$info[$i]['1']=$row->location_name;
			$info[$i]['2']=$keyvalue1->brnh_name;
			$info[$i]['3']=$row->id;
							
				$i++;
			
		}
		return $info;
	
	}
	
public function get_cid(){
	//$data=$this->user_function();// call permission function
	
		$this->load->view('get_cid');
	
	}

public function addLocation(){
//echo "";die;
	if($this->session->userdata('is_logged_in')){
		$this->load->view('add-location');
}
	else
	{
	redirect('index');
	}
}

public function formvalidation(){
		
		 $data=$_GET['con'];
			 $ex=explode("^",$data);
			 $databasename=$ex[0];
			 $table_lname=$ex[1];
			 $table_bname=$ex[2];
			 $table_glname=$ex[3];
			 $table_gbname=$ex[4];
	 $sqldata=$this->db->query("select * from $databasename where $table_lname='$table_glname' and $table_bname='$table_gbname'");		
	 $sqldata->num_rows();
	if($sqldata->num_rows()>0){	
			echo "
			<script>
			
			alert('Location Name and Branch Name Already Exit');
			window.location.href='addLocation';
			</script>
			";

	}else{
		$this->insert_location($table_glname,$table_gbname);
	}
 }


public function insert_location($location_name,$branch_name){
	
		@extract($_POST);
		$table_name ='tbl_location';
		$pri_col ='id';
	 	$id= $this->input->post('locationid');
		if($id!=''){
			$data= array(
					'location_name' => $this->input->post('location_name'),
					'branch_id' => $this->input->post('branch_name')
		      	);
		}else{
		$data= array(
					'location_name' => $location_name,
					'branch_id' => $branch_name
		      	);
		}

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
		
		$dataall = array_merge($data,$sesio);

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
				
					
		    	$this->Model_admin_login->insert_user($table_name,$dataall);
			
			 redirect('/Location/manage_location');
		
		
	}
	}

}

?>
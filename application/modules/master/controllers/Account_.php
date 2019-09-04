<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Account extends my_controller {

public function manage_contact(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('/Account/manage-contact',$data);
}
	else
	{
	redirect('index');
	}
}
public function contact_log(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('Account/contact-log',$data);
}
	else
	{
	redirect('index');
	}
}


public function contact_log_pay(){

	if($this->session->userdata('is_logged_in')){
	
$data=$this->user_function();// call permission fnctn

		$this->load->view('Account/contact-log-pay',$data);
}
	else
	{
	redirect('index');
	}
}



public function contact_list_pay()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','5')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}
	
public function contact_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('group_name','4')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}	

public function contact_list_m()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_contact_m');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('account_id',$row->group_name)
           -> get('tbl_account_mst');
		  $compRow = $compQuery->row();
		
			$info[$i]['1']=$row->first_name;
			$info[$i]['2']=$compRow->account_name;
			$info[$i]['3']=$row->email;
			$info[$i]['4']=$row->mobile;
			$info[$i]['5']=$row->contact_id;	
			$info[$i]['6']=$row->phone;		
				$i++;
			
		}
		return $info;
	
	}	

public function add_contact(){


	if($this->session->userdata('is_logged_in')){

 



		$this->load->view('Account/add-contact');
}
	else
	{
	redirect('index');
	}
}

	



public function insert_contact(){
	
		@extract($_POST);
		$table_name ='tbl_contact_m';
		$pri_col ='contact_id';
	 	$id= $this->input->post('contact_id');
		$total='0';
		
		$data= array(
					'first_name' => $this->input->post('first_name'),
					'ledgertype' => $this->input->post('ledgertype'),	
					'address1' => $address1,
                 	'address3' => $address3,
	 				'group_name' => $this->input->post('maingroupname'),		       
					'accunt' => $this->input->post('groupname'),
				     'alias' => $this->input->post('alias_name'),
					'printname' => $this->input->post('print_name'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
					'station' => $this->input->post('station'),
	                'contact_person' => $this->input->post('contact_person'),
					'IT_Pan' => $this->input->post('it_pan'),
					'ward' => $this->input->post('ward'),
	                //'lst' => $this->input->post('lst_no'),
					//'cst' => $this->input->post('cst_no'),
	                'gst' => $this->input->post('gst_no'),
					'state_id' => $this->input->post('state_id'),
					
					'fax' => $this->input->post('fax'),
	                'opening_balance' => $this->input->post('op_bal'),
					 'previous_balance' => $this->input->post('prev_bal'),
					'transport' => $this->input->post('transport'),
	                'mobile' => $this->input->post('mobile')
					
					
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
		
		
		$data_entr = array_merge($data,$sesio);
		
    	$this->load->model('Model_admin_login');
		//echo "sss";die;
		if($id!=''){
		//echo "kk";die;
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
					
		            $table_name ='tbl_contact_m';
		            $pri_col ='contact_id';
	 	            $id= $this->input->post('contact_id');
		            $data= array(
					'first_name' => $this->input->post('first_name'),
					'address1' => $address1,
                 	'address3' => $address3,
					
					'ledgertype' => $this->input->post('ledgertype'),	
	 				'group_name' => $this->input->post('maingroupname'),		       'state_id' => $this->input->post('state_id'),
					'accunt' => $this->input->post('groupname'),
				    'alias' => $this->input->post('alias_name'),
					'printname' => $this->input->post('print_name'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
					'station' => $this->input->post('station'),
	                'contact_person' => $this->input->post('contact_person'),
					'IT_Pan' => $this->input->post('it_pan'),
					'ward' => $this->input->post('ward'),
	                'lst' => $this->input->post('lst_no'),
					'cst' => $this->input->post('cst_no'),
	                'tin' => $this->input->post('tin_no'),
					'fax' => $this->input->post('fax'),
	                'opening_balance' => $this->input->post('op_bal'),
					'previous_balance' => $this->input->post('prev_bal'),
					'transport' => $this->input->post('transport'),
	                'mobile' => $this->input->post('mobile')
					);
		
					//print_r ($data_entr);
					$table_name1 ='tbl_address_m';
		          	 $pri_col1 ='addressid';
	 	            $id1 = $this->input->post('adress_id');			

					$data1= array(					
								'address1' => $this->input->post('address1'),
								'address3' => $this->input->post('address3'),
								'City' => $this->input->post('City'),
								'state' => $this->input->post('state'),
								'country' => $this->input->post('country'),
								'Street' => $this->input->post('Street'),
								'pobox' => $this->input->post('pobox'),
								'zip' => $this->input->post('zip'),
								'description' => $this->input->post('textarea')
								);					
								$this->Model_admin_login->update_user($pri_col1,$table_name1,$id1,$data1);					
									//this data is for inserting in tbl_invoice_payment for opening balance
									
										$lastHdrId=$this->db->insert_id();
												$this->software_log_insert($lastHdrId,$id,$total,'Contact Updated');
											
								
								echo "<script type='text/javascript'>";
								echo "window.close();";
								echo "window.opener.location.reload();";
								echo "</script>";
								}
							else
				     		{ 
							
							
								
								$this->Model_admin_login->insert_user($table_name,$data_entr);

							$lastid = $this->db->insert_id();
							
		$this->software_log_insert($lastid,$lastid,$total,'Contact added');
		
								
						
					if($maingroupname=='8')
					{
						$ContactLastid=$lastid;
						$openingBal=$this->input->post('op_bal');
						$this->insertOpeningBal($ContactLastid,$openingBal);
					}		          
				  //$this->Model_admin_login->insert_user($table_name,$data1,$data);
				  if($popup=='True'){
						$this->fillselect($first_name,$lastid,$field='contact_id_copy');
								echo "<script type='text/javascript'>";
								echo "window.close();";
								//echo "window.opener.location.reload();";
								echo "</script>";
					}else{
					redirect('master/Account/manage_contact');
					}
					
				
	}
	
	}
	
	function insertOpeningBal($ContactLastid,$openingBal)
	{
		
		$table_name='tbl_invoice_payment';
		$data= array(
					
					'contact_id' => $ContactLastid,
                 	'receive_billing_mount' => $openingBal,
	                'remarks' => 'Opening Balance',
                 	'comp_id' => $this->session->userdata('comp_id'),
					
					'date' =>  date('y-m-d'),
					
					'maker_id' => $this->session->userdata('user_id'),
					
					'maker_date'=> date('y-m-d'),
					'status'=> 'invoice'
					
						
					);
	$this->Model_admin_login->insert_user($table_name,$data);
			 return;
	
	}
	function delete_contact() {
	
	$table_name ='tbl_contact_m';
	$pri_col ='contact_id';
	$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		
		// echo "select * from tbl_invoice_payment where contact_id='$id'"
		
		$querypayment= $this->db->query("select * from tbl_invoice_payment where contact_id='$id'");
		$fetchid=$querypayment->row();
		if($fetchid->contact_id!=''){
		?>	
		<script>
        	
			confirm("You can't delete it because this id is in tbl_invoice_payment"); 
			window.location.href='manage_contact';			
		
        </script>
        <?php	
		}
		
		//echo "select * from tbl_invoice_dtl where productid='$id'";
		
		$queryP=$this->db->query("select * from tbl_invoice_hdr where contactid='$id'");
		$fetchP=$queryP->row();
		
		
		if($fetchP->contactid!=''){
		?>			 
			<script> alert("please delete product in tbl_invoice_dtl table then you can delete this product:"); 
			window.location.href='manage_contact';
			</script>				 
				
		<?php			 
		}else{
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		
		$table_name1 ='tbl_address_m';
		$pri_col1 ='entityid';
		$this->load->model('Model_admin_login');
		$id= $_GET['id'];
		$this->Model_admin_login->delete_address($pri_col1,$table_name1,$id);
	    redirect('/index.php/Account/manage_contact');
}
}

public function firstfunction(){
	
		$data['firstid']=$_GET['firstid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
public function aliesnamefunction(){
	
		$data['aliesnameid']=$_GET['aliesnameid'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

}
?>
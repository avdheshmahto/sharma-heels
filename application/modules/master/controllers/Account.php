<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Account extends my_controller {

function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
}

public function manage_contact(){

	if($this->session->userdata('is_logged_in')){

	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_master->contact_get();	
			$this->load->view('/Account/manage-contact',$data);
	}
	else
	{
	redirect('index');
	}
}

public function addCustomer(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('/Account/add-contact');
	}
	else
	{
	redirect('index');
	}
}

//===============================================================================================================================

	public function manageContactNat(){

	if($this->session->userdata('is_logged_in')){
 ////Pagination start ///
	  $url   = site_url('/master/Account/manageContactNat?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_master->count_all_customernat($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/master/Account/manageContactNat?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
			$this->load->view('/Account/manage-contact-nat',$data);
	}
	else
	{
	redirect('index');
	}
}


	public function manageContactRag(){

	if($this->session->userdata('is_logged_in')){

			$data=$this->user_function();// call permission fnctn
			$this->load->view('/Account/manage-contact-rag',$data);
	}
	else
	{
	redirect('index');
	}
}

	public function manageContactMad(){

	if($this->session->userdata('is_logged_in')){

			$data=$this->user_function();// call permission fnctn
			$this->load->view('/Account/manage-contact-mad',$data);
	}
	else
	{
	redirect('index');
	}
}

	public function manageContactSeel(){

	if($this->session->userdata('is_logged_in')){

			$data=$this->user_function();// call permission fnctn
			$this->load->view('/Account/manage-contact-seel',$data);
	}
	else
	{
	redirect('index');
	}
}

	public function manageContactMum(){

	if($this->session->userdata('is_logged_in')){

			$data=$this->user_function();// call permission fnctn
			$this->load->view('/Account/manage-contact-mum',$data);
	}
	else
	{
	redirect('index');
	}
}


public function manageContactBapa(){

	if($this->session->userdata('is_logged_in')){

			$data=$this->user_function();// call permission fnctn
			$this->load->view('/Account/manage-contact-Bapa',$data);
	}
	else
	{
	redirect('index');
	}
}

//===============================================================================================================================

public function updateContact(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact',$data);
	}
	else
	{
	redirect('index');
	}
}

//===============================================================================================================================

public function updateContactNat(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-nat',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewCustomerNat(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/view-contact-nat',$data);
	}
	else
	{
	redirect('index');
	}
}

public function viewinvoice(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/view-invoice',$data);
	}
	else
	{
	redirect('index');
	}
}


public function updateContactRag(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-rag',$data);
	}
	else
	{
	redirect('index');
	}
}


public function updateContactMad(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-mad',$data);
	}
	else
	{
	redirect('index');
	}
}

public function updateContactSeel(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-seel',$data);
	}
	else
	{
	redirect('index');
	}
}

public function updateContactMum(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-mum',$data);
	}
	else
	{
	redirect('index');
	}
}

public function updateContactBapa(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Account/edit-contact-Bapa',$data);
	}
	else
	{
	redirect('index');
	}
}


//===============================================================================================================================

public function getdata_fun(){
	if($this->session->userdata('is_logged_in')){
	 $data['id'] = $_GET['con'];
		$this->load->view('/Account/getdata',$data);
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


public function update_contact_nat(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		
		$countsizesum=$sizerow;
		$out = array();
		$outgstno = array();
		$outstate = array();
		$countsize=$countsizesum+1;
		for($i=0;$i<=$countsize;$i++){
				
				$c_firmid=$this->input->post('c_firmid')[$i];
				$gstinnoid=$this->input->post('gstinnoid')[$i];
				$stateid=$this->input->post('stateid')[$i];
							
			if($c_firmid!=''){					
					 array_push($out, $c_firmid);
					 array_push($outgstno, $gstinnoid);
					 array_push($outstate, $stateid);					
				}	
				
			}
		
		$totalcfirm=implode(',', $out);
		$totalgstno=implode(',', $outgstno);
		$totalstate=implode(',', $outstate);
		
		$data= array(
					
					'first_name' => $this->input->post('first_name'),	
					'address1' => $address1,
                 	'address3' => $address3,		       
					'add_opening_balance' =>$this->input->post('add_opening_balance'),
					'add_opening_balancename' =>$this->input->post('add_opening_balancename'),
					'term' => $this->input->post('term'),
					'gst' => $this->input->post('gst_per'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
	                'tinno_id' => $this->input->post('tinnoid'),
	                'contact_person' => $this->input->post('contact_person'),
	                'tin' => $totalgstno,					
					'location_id' => '5^NAT',
					'group_name' => '4',
					'module_status' => 'National',
					'note' => $this->input->post('note'),					
	                'smobile' => $this->input->post('smobile'),
	                'firma_name' => $totalcfirm,
	                'state' => $totalstate,
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
			$this->load->view('master/Account/second-customer-nat');	
	
	}

//==========
public function update_contact_reg(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		$data= array(
					'first_name' => $first_name,					
					'address1' => $address1,
                 	'address3' => $address3,	 				    
					'add_opening_balance' =>$add_opening_balance,
					'add_opening_balancename' =>$add_opening_balancename,
					'term' => $term,
					'gst' => $gst_per,
					//'pan_no' => $pan_no,
                 	'email' => $email,
	                'phone' => $phone,
	                'contact_person' => $contact_person,
					'contact_code' => $contact_code,				
	                'tin' => $tin_no,	
					
					'group_name' => '4',
					'module_status' => 'Ragarpura',
					'location_id' => '1^REG',
					'note' => $note,					
	                'smobile' => $smobile,
	                'state' => $state,
	                'mobile' => $mobile
					
					
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
					//redirect('master/Account/manage_contact');				
	
	}
//-=-----------------------

public function update_contact_mad(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		$data= array(
					'first_name' => $first_name,					
					'address1' => $address1,
                 	'address3' => $address3,	 				    
					'add_opening_balance' =>$add_opening_balance,
					'add_opening_balancename' =>$add_opening_balancename,
					'term' => $term,
					'gst' => $gst_per,
					//'pan_no' => $pan_no,
                 	'email' => $email,
	                'phone' => $phone,
	                'contact_person' => $contact_person,
					'contact_code' => $contact_code,				
	                'tin' => $tin_no,	
					
					'group_name' => '4',
					'module_status' => 'Madipur',
					'location_id' => '3^MAD',
					'note' => $note,					
	                'smobile' => $smobile,
	                'state' => $state,
	                'mobile' => $mobile
					
					
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
					//redirect('master/Account/manage_contact');				
	
	}
	
//========
public function update_contact_seel(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		$data= array(
					'first_name' => $first_name,					
					'address1' => $address1,
                 	'address3' => $address3,	 				    
					'add_opening_balance' =>$add_opening_balance,
					'add_opening_balancename' =>$add_opening_balancename,
					'term' => $term,
					'gst' => $gst_per,
					//'pan_no' => $pan_no,
                 	'email' => $email,
	                'phone' => $phone,
	                'contact_person' => $contact_person,
					'contact_code' => $contact_code,				
	                'tin' => $tin_no,	
					
					'group_name' => '4',
					'module_status' => 'Seelampur',
					'location_id' => '4^SPR',
					'note' => $note,					
	                'smobile' => $smobile,
	                'state' => $state,
	                'mobile' => $mobile
					
					
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
					//redirect('master/Account/manage_contact');				
	
	}
//==--------------
public function update_contact_mum(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		$data= array(
					'first_name' => $first_name,					
					'address1' => $address1,
                 	'address3' => $address3,	 				    
					'add_opening_balance' =>$add_opening_balance,
					'add_opening_balancename' =>$add_opening_balancename,
					'term' => $term,
					'gst' => $gst_per,
					//'pan_no' => $pan_no,
                 	'email' => $email,
	                'phone' => $phone,
	                'contact_person' => $contact_person,
					'contact_code' => $contact_code,				
	                'tin' => $tin_no,	
					
					'group_name' => '4',
					'module_status' => 'Mumbai',
					'location_id' => '6^SPM',
					'note' => $note,					
	                'smobile' => $smobile,
	                'state' => $state,
	                'mobile' => $mobile
					
					
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
					//redirect('master/Account/manage_contact');				
	
	}
	
//--------
public function update_contact_Bapa(){
	
		@extract($_POST);
		
		$table_name ='tbl_contact_m';		
		$pri_col ='contact_id';
		$id = $contact_id;
		$data= array(
					'first_name' => $first_name,					
					'address1' => $address1,
                 	'address3' => $address3,	 				    
					'add_opening_balance' =>$add_opening_balance,
					'add_opening_balancename' =>$add_opening_balancename,
					'term' => $term,
					'gst' => $gst_per,
					//'pan_no' => $pan_no,
                 	'email' => $email,
	                'phone' => $phone,
	                'contact_person' => $contact_person,
					'contact_code' => $contact_code,				
	                'tin' => $tin_no,	
					
					'group_name' => '4',
					'module_status' => 'BapaNagar',
					'location_id' => '7^BPR',
					'note' => $note,					
	                'smobile' => $smobile,
	                'state' => $state,
	                'mobile' => $mobile
					
					
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
		
		//$this->Model_admin_login->insert_user($table_name,$data_entr);
		$this->Model_admin_login->update_user($pri_col,$table_name,$id,$data_entr);
				 					
					//redirect('master/Account/manage_contact');				
	
	}
	

//=======End==============
public function insert_contact(){
	
		@extract($_POST);
		$table_name ='tbl_contact_m';
		$pri_col ='contact_id';
	 	$id= $this->input->post('contact_id');
		$redloc= $this->input->post('Ragarpura_name');
		$total='0';
				
		$countsizesum=count($sizerow);
		$out = array();
		$outgstno = array();
		$outstate = array();
		$countsize=$countsizesum+1;
		for($i=0;$i<=$countsize;$i++){
				
				$c_firmid=$this->input->post('c_firmid')[$i];
				$gstinnoid=$this->input->post('gstinnoid')[$i];
				$stateid=$this->input->post('stateid')[$i];
							
			if($c_firmid!=''){					
					 array_push($out, $c_firmid);
					 array_push($outgstno, $gstinnoid);
					 array_push($outstate, $stateid);					
				}	
				
			}
		
		$totalcfirm=implode(',', $out);
		$totalgstno=implode(',', $outgstno);
		$totalstate=implode(',', $outstate);
					
		$data= array(
					'first_name' => $this->input->post('first_name'),	
					'address1' => $address1,
                 	'address3' => $address3,		       
					'add_opening_balance' =>$this->input->post('add_opening_balance'),
					'add_opening_balancename' =>$this->input->post('add_opening_balancename'),
					'term' => $this->input->post('term'),
					'gst' => $this->input->post('gst_per'),
                 	'email' => $this->input->post('email'),
	                'phone' => $this->input->post('phone'),
	                'tinno_id' => $this->input->post('tinnoid'),
	                'contact_person' => $this->input->post('contact_person'),
					'contact_code' => $this->input->post('contact_code'),
	                'tin' => $totalgstno,					
					'location_id' => '5^NAT',
					'group_name' => '4',
					'module_status' => $redloc,
					'note' => $this->input->post('note'),					
	                'smobile' => $this->input->post('smobile'),
	                'firma_name' => $totalcfirm,
	                'state' => $totalstate,
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
														
		$this->Model_admin_login->insert_user($table_name,$data_entr);
		$lastid = $this->db->insert_id();

		$this->software_log_insert($lastid,$lastid,$total,'Contact added');		
							
		$ContactLastid=$lastid;
		$openingBal=$this->input->post('add_opening_balance');
		$this->insertOpeningBal($ContactLastid,$openingBal);
			          
			
					if($redloc=='National'){
							$this->load->view('master/Account/second-customer-nat');
							//redirect('master/Account/manageContactNat');
					}else if($redloc=='Ragarpura'){
							redirect('master/Account/manageContactRag');		
					}else if($redloc=='Madipur'){
							redirect('master/Account/manageContactMad');
					}else if($redloc=='Seelampur'){
							redirect('master/Account/manageContactSeel');
					}else if($redloc=='Mumbai'){
							redirect('master/Account/manageContactMum');
					}else if($redloc=='BapaNagar'){
							redirect('master/Account/manageContactBapa');
					}else{
					
					redirect('master/Account/manage_contact');
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
//==============================================================================================================================================
	
public function import_customer_nat(){	
	if($this->session->userdata('is_logged_in')){	
		$this->load->view('master/Account/import-customer-nat');
}else{
redirect('index');
}

}


public function import_insert_customer_nat(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"]; 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 
// $costq=$this->db->query("select * from tbl_contact_m where first_name='".$getData[0]."'");
// $costRow=$costq->row();

 $catId=$this->db->query("select * from tbl_state_m where countryid='1' and stateName='".$getData[12]."'");
 $catRow=$catId->row();
 
//select id of unit id
 //$unitId=$this->db->query("select *from tbl_product_stock where productname='".$getData[2]."'");
 //$unitRow=$unitId->row();
	         
if($getData[0]!='')
{
	
	
			   $this->db->query("insert into tbl_contact_m set first_name='".$getData[0]."',group_name='4',contact_person='".$getData[1]."',email='".$getData[2]."',mobile='".$getData[3]."',smobile='".$getData[4]."',phone='".$getData[5]."',tin='".$getData[6]."',gst='".$getData[7]."',contact_code='".$getData[8]."',add_opening_balancename='".$getData[9]."',add_opening_balance='".$getData[10]."',term='".$getData[11]."',state='".$catRow->stateid."',address1='".$getData[13]."',address3='".$getData[14]."',note='".$getData[15]."',location_id='5^NAT',module_status='National',comp_id='".$this->session->userdata('comp_id')."',divn_id='".$this->session->userdata('divn_id')."',zone_id='".$this->session->userdata('zone_id')."',brnh_id='".$this->session->userdata('brnh_id')."',maker_date='".date('y-m-d')."',author_date='".date('y-m-d')."'");
			   
}		
	         }
			 fclose($file);
		
		 }
	    
echo "<script>
alert('Customer Imported Successfully');
window.location.href = 'manageContactNat';
</script>";
			 	
}

//==============================================================================================================================================


}
?>
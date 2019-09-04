<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */

class my_controller extends MX_Controller {
function __construct(){
   parent::__construct(); 
   $this->load->model('Model_admin_login'); 
      $this->load->library('pagination'); 
  
}
	
public function page_protection(){
	
	
$mod_sql2 = $this->db->query("select distinct f.function_url from tbl_module_function f  join tbl_role_func_action rf on f.func_id=rf.function_url where rf.role_id='".$this->session->userdata('role')."' and rf.action_id !='Inactive'");
  $CUrl="../".$this->uri->segment(1)."/".$this->uri->segment(2);
foreach($mod_sql2->result() as $mdd_f)

{
	
	
	  $geturl=$mdd_f->function_url;
	 
	if($CUrl==$geturl)
	{
	
	
	$active='1';
	//redirect("/report/report_function");
	
	}
	
$active;
	
}

return $active;
	
}


public function user_function(){
if($this->session->userdata('is_logged_in')){
$userRole=$this->db->query("select * from tbl_user_role_mst where user_id='".$this->session->userdata('user_id')."' ");
$userRoleFetch=$userRole->row();
$userRoleFetch->role_id;
$userRole1=$this->db->query("select * from tbl_role_mst where role_id='".$userRoleFetch->role_id."'");
$userRoleFetch1=$userRole1->row();
$userRoleFetch1->role_id;
$data_user=$userRoleFetch1->action;
$action=explode("-",$data_user);
$kk['edit']=$action[0];
$kk['view']=$action[1];
$kk['delete']=$action[2];
$kk['add']=$action[3];
$kk['obj']=new my_controller();
return $kk;
 }

}

////////////function to give permission(add,edit,delete) to users starts///////////////
public function dashboard(){
						
			$user_name = $this->input->post('username');
			$password = $this->input->post('password');
			$userQuery = $this->db->query("SELECT * FROM tbl_user_mst where status='A' and user_name= BINARY '$user_name' and password= BINARY '$password' ");
			$fetchUser = $userQuery->row();
			$roleQuery = $this->db->query("SELECT * FROM tbl_user_role_mst where   user_id='".$fetchUser->user_id."'");
			$fetchRole = $roleQuery->row();
			$cnt = $userQuery->num_rows();
			$sess_array = array(
         				'user_id' => $fetchUser->user_id,
		 				'is_logged_in'=>1,
         				'user_name' => $fetchUser->user_name,
		 				'user_type' => $fetchUser->user_type,
		 				'comp_id' 	=> $fetchUser->comp_id,
		 				'zone_id' 	=> $fetchUser->zone_id,
		 				'brnh_id' 	=> $fetchUser->brnh_id,
		 				'divn_id' 	=> $fetchUser->divn_id,
		  				'divn_id' 	=> $fetchUser->divn_id,
		  				'role' 	  	=> @$fetchRole->role_id
       				);
				if($cnt>0){
				$this->session->set_userdata(@$sess_array);
				redirect('master/Item/dashboar');
				//redirect('dashboard');
				}	else{
					$this->session->set_flashdata('error', 'Invalid username/password');

	redirect('index');
	}
					
				
				
				
}

 function index() {
	if($this->session->userdata('is_logged_in')){
		redirect('master/dashboar');
		}	else{
	redirect('index');
	}
}



public function dashboar(){

if($this->session->userdata('is_logged_in')){
	$this->load->view('dashboard');
    }else{	
		redirect('index');
	}
		}

public function logout(){

		$this->session->sess_destroy();
		redirect('/index');
}







public function popupclose(){
echo "<script type='text/javascript'>";
echo "window.close();";
echo "window.opener.location.reload();";
echo "</script>";
}

public function get_cid() {
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();
		$this->load->view('get_cid',$data); 
	
	}	else{
	
		$this->load->view('index');
	
	}
		}
		
		
public function error_page() {
	if($this->session->userdata('is_logged_in')){
			$this->load->view('invalid_url');
		}	else{
		$this->load->view('index');
	}
		}
		
public function session_data() {
	$data = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_id' => $this->session->userdata('user_id'),
					'author_id' => $this->session->userdata('user_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> date('y-m-d')
					);
	return $data;
		}	
			

 function load_page1($page){
	if($this->session->userdata('is_logged_in')){
		$this->load->view($page);
	}
	else
	{
	redirect('/master/index');
	}
}	




function parseWord($filename) 
{

    $striped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);

    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }// end while

    zip_close($zip);

    //echo $content;
    //echo "<hr>";
    //file_put_contents('1.xml', $content);

    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);

    return $striped_content;
} 
	
	
	

 function load_page($page){
	 $pageActive=$this->page_protection();
	
	if($this->session->userdata('is_logged_in')){
		
		$data=$this->user_function();
		
			$this->load->view($page,$data);
		
		
	}
	else
	{
	redirect('/master/index');
	}
}	

 public function product_check($productId){
 //echo $productId;die;
   $this->db->where('product_id', $productId);

    $query = $this->db->get('tbl_sales_order_dtl');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }

//=============================enter price=======================
 
 public function enterPriceCheck($compId){
 //echo $productId;die;
   $this->db->where('comp_id', $compId);

    $query = $this->db->get('tbl_region_mst');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close enter price ===============================

//=============================Start Region =======================
 
 public function regionCheck($zoneid){
 //echo $productId;die;
   $this->db->where('zone_id', $zoneid);

    $query = $this->db->get('tbl_branch_mst');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close Region===============================
 
 
//=============================Start Branch =======================
 
 public function branchCheck($brnhid){
 //echo $productId;die;
   $this->db->where('brnh_id', $brnhid);

    $query = $this->db->get('tbl_wing_mst');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close Branch===============================
 
 
//=============================Start Department =======================
 
 public function departmentCheck($divnid){
 //echo $productId;die;
   $this->db->where('divn_id', $divnid);

    $query = $this->db->get('tbl_user_mst');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close Department===============================
 
 
//=============================Start Role =======================
 
 public function roleCheck($roleid){
 //echo $productId;die;
   $this->db->where('role_id', $roleid);

    $query = $this->db->get('tbl_role_func_action');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close Role===============================
 
 
//=============================Start User =======================
 
 public function userCheck($userid){
 //echo $productId;die;
   $this->db->where('user_id', $userid);

    $query = $this->db->get('tbl_user_role_mst');

    $count_row = $query->num_rows();

    if ($count_row > 0) {
      //if count row return any row; that means you have already this email address in the database. so you must set false in this sense.
	  return prodductActive;
		

       //redirect('/master/add_category');
     } else {
      // doesn't return any row means database doesn't have this email
        return TRUE; // And here false to TRUE
     }

 
 }
 
//=================================Close User===============================
 
//================================*Start delete data ============== 
 function delete_data() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name1 =tbl_product_serial_log;
		$pri_col1 =product_id;
		$table_name2 =tbl_product_serial;
		$pri_col2 =product_id;		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col1,$table_name1,$id);
		$this->Model_admin_login->delete_user($pri_col2,$table_name2,$id);
		
}
//================================Close delete data ============== 

 
//================================* Start Multiple delete table data ============== 
 function delete_multiple_table_data() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name_dtl =$dataex[3];
		$pri_col_dtl =$dataex[4];
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col_dtl,$table_name_dtl,$id);		
}
//================================Close Multiple delete table data ============== 

 
//================================* Start Sales order Multiple delete table data ============== 
 function delete_multiple_table_data_sales_order() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name_dtl =$dataex[3];
		$pri_col_dtl =$dataex[4];
				
		if($table_name=='tbl_sales_order_hdr' && $pri_col=='salesid'){
		
		$salesQuery=$this->db->query("select * from tbl_sales_order_dtl where salesid='$id'");
		foreach($salesQuery->result() as $fetchQ){
			$proid=$fetchQ->product_id;
			$qnty=$fetchQ->quantity;
			
		$salesOrderReturnQ=$this->db->query("select * from tbl_sales_order_return_hdr where so_no='$id'");	
		$numrow=$salesOrderReturnQ->num_rows();
		if($numrow>0){
			
		}else{
		$this->db->query("update tbl_product_serial set quantity=quantity+'$qnty' where product_id='$proid'");
		$this->db->query("update tbl_product_stock set quantity=quantity+'$qnty' where Product_id='$proid'");	
			  }
			}
		}
	$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
	$this->Model_admin_login->delete_user($pri_col_dtl,$table_name_dtl,$id);	
}
//================================Close Sales order Multiple delete table data ============== 


//================================*Start Select All delete data==================
function multiple_delete_two_table(){		
$id=$_POST['ids'];

	$tabledata =$_POST['table_name'];
	$table_name_ex=explode("^",$tabledata);
	$table_name=tbl_product_serial_log;
	$table_name_dtl=tbl_product_serial;
	
	
	$pri_data =$_POST['pri_col'];
	$pri_col_ex =explode("^",$pri_data);
	$pri_col =product_id;
	$pri_col_dtl =product_id;
	

	$this->db->query("delete from $tabledata where $pri_data in($id)");
	$this->db->query("delete from $table_name where $pri_col in($id)");
	$this->db->query("delete from $table_name_dtl where $pri_col_dtl in($id)");
		
	
			
}

//===============================Close Select All delete data==========================



function multiple_delete_item(){		
$id=$_POST['ids'];
//$this->db->query("delete from $_POST['table_name'] where $_POST['pri_col'] in($id)");	

	
	
	

	$table_name =$_POST['table_name'];
	$table_name1 ='tbl_product_serial';
	$table_name2 ='tbl_product_serial_log';
	$pri_coll =$_POST['pri_col'];
	$pri_col ='product_id';
	$this->db->query("delete from $table_name where $pri_coll in($id)");
$this->db->query("delete from $table_name1 where $pri_coll in($id)");	
$this->db->query("delete from $table_name2 where $pri_coll in($id)");
	
	/*
	$this->load->model('Model_admin_login');
	
		
		$this->Model_admin_login->delete_user($pri_col,$table_name1,$id);
		$this->Model_admin_login->delete_user($pri_col,$table_name2,$id);
		return;
		*/
	
}






//================================*Start delete sales order ============== 
 function delete_sales_order_data() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name1 =tbl_sales_order_dtl;
		$pri_col1 =salesid;
		
		
		
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col1,$table_name1,$id);
		
		
		
}
//================================Close delete sales order ============== 

//================================*Start delete invoice ============== 
 function delete_invoice_data() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name1 =tbl_invoice_dtl;
		$pri_col1 =invoiceid;
		$table_name_pay='tbl_invoice_payment';
			
		
		
		// starts select product id and qty from invoice table //
		
		$selectSalesDtl=$this->db->query("select *from $table_name1 where invoiceid='$id'");
		foreach($selectSalesDtl->result() as $getSalesDtl){
		$qty=$getSalesDtl->qty;
		$main_id=$getSalesDtl->productid;
		$this->delete_updata_stock($qty,$main_id);
		}
		// ends//
		
		
		
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col1,$table_name1,$id);
		
		$this->db->query("delete from $table_name_pay where $pri_col1='$id' and status='invoice'");
		
}
//================================Close delete invoice ============== 



//================================*Start delete purchase order ============== 
 function delete_purchase_order_data() {
	
	$this->load->model('Model_admin_login');
		$getdata= $_GET['id'];
		$dataex=explode("^",$getdata);
		$id=$dataex[0];
		$table_name =$dataex[1];
		$pri_col =$dataex[2];
		$table_name1 =tbl_purchase_order_dtl;
		$pri_col1 =purchaseorderhdr;
			
		
		// starts select product id and qty from sales table //
		
		$selectSalesDtl=$this->db->query("select * from $table_name1 where purchaseorderhdr='$id'");
		foreach($selectSalesDtl->result() as $getSalesDtl){
		$qty=$getSalesDtl->quantity;
		$main_id=$getSalesDtl->product_id;
		$this->delete_updata_stock($qty,$main_id);
		}
		// ends//
		
		
		
		
		$this->Model_admin_login->delete_user($pri_col,$table_name,$id);
		$this->Model_admin_login->delete_user($pri_col1,$table_name1,$id);
		
		
		
}
//================================Close delete purchase order ============== 


public function forgotPassword()
{
@extract($_POST);
$userQuery=$this->db->query("select *from tbl_user_mst where email_id='$email_id'");
$cnt=$userQuery->num_rows();
if($cnt>0)
{
$getUser=$userQuery->row();


$msg="Your Password Is:-$password";
					$this->load->library('email');
$name=$first_name." ".$last_name;
$this->email->from('info@techvyas.com', 'Techcyas');
$this->email->to($email_id);
$this->email->bcc('collestbablu@gmail.com');

$this->email->subject('Password Details');
$this->email->message($msg);

$this->email->send();
$this->session->set_flashdata('message', 'Please check your mail for password ');
redirect('index');
}
else
{

$this->session->set_flashdata('message', 'Email Id do not match to admin account.');
redirect('index');
}
}
//starts
function fillselect($name,$id,$field='contact_id_copy'){
	echo "<script>
			foropener('".$name."','".$id."','".$field."');
function foropener(text,value,field)
{
	var openerWindow= window.opener;
	if (openerWindow != null && !openerWindow.closed) 
    {
		try{
		var selectcopy = window.opener.document.getElementById(field);
		var option = window.opener.document.createElement('option');
		option.text = text;
		option.value = value;
		selectcopy.add(option, selectcopy[1]);
		selectcopy.value=option.value;
		return;
		}catch(ex){}
	}
	else {
    alert('Parent closed/does not exist.'); 
	}
}
			</script>";
			return;
	}

//ends

public function software_log_insert($log_id,$contact_id,$total,$type)
{

$table_name='tbl_software_log';
date_default_timezone_set("Asia/Kolkata");
$dtTime = date('H:i:s');

$data=array(
'log_id' => $log_id,
'contact_id' => $contact_id,
'total' => $total,
'type' => $type,
'author_id' => $dtTime
);

$sess = array(
					
					'maker_id' => $this->session->userdata('user_id'),
					'maker_date' => date('y-m-d'),
					'status' => 'A',
					'comp_id' => $this->session->userdata('comp_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'divn_id' => $this->session->userdata('divn_id')
		);
$data_merge = array_merge($data,$sess);	
$this->Model_admin_login->insert_user($table_name,$data_merge);
return;

}

// payment due starts here

public function pur_payment_due($contact_id)
{

$selectin1="select * from tbl_invoice_payment where contact_id='$contact_id'";
 $resultin1=$this->db->query($selectin1);
 foreach($resultin1->result() as $rowin1)
 {
 
 
 
 if($rowin1->status=='Purchaseorder')
 {
   $invoiceSum=$invoiceSum+$rowin1->receive_billing_mount;
 }
 if($rowin1->status=='payment')
 {
  $paySum=$paySum+$rowin1->receive_billing_mount;
 
 }
 
 }
 $remaining_amt=$invoiceSum-$paySum;
return $remaining_amt;
}


// ends here


// payment due starts here

public function payment_due($contact_id)
{

$selectin1="select * from tbl_invoice_payment where contact_id='$contact_id'";
 $resultin1=$this->db->query($selectin1);
 foreach($resultin1->result() as $rowin1)
 {
 
 
 
 if($rowin1->status=='invoice')
 {
   $invoiceSum=$invoiceSum+$rowin1->receive_billing_mount;
 }
 if($rowin1->status=='PaymentReceived')
 {
  $paySum=$paySum+$rowin1->receive_billing_mount;
 
 }
 
 }
 $remaining_amt=$invoiceSum-$paySum;
return $remaining_amt;
}

public function ciPagination($url,$totalData,$sgmnt,$showEntries){
	   
	  
	    $config['use_page_numbers']     = FAlSE;
        $config['page_query_string']    = TRUE;
        $config['query_string_segment'] = 'offset';
       
        $config['base_url']       =  $url;
        $config['total_rows']     =  $totalData;
        $config['per_page']       =  $showEntries;
        $config["uri_segment"]    =  $sgmnt;
        $choice                   =  $config["total_rows"] / $config["per_page"];
        $config["num_links"]      =  3;//floor($choice);

        //config for bootstrap pagination class integration
        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link']     = 'First';
        $config['last_link']      = 'Last';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close']= '</li>';
        $config['prev_link']      = '&laquo';
        $config['prev_tag_open']  = '<li class="prev">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link']      = '&raquo'; 
        $config['next_tag_open']  = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open']  = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open']   = '<li class="active"><a href="#">';
        $config['cur_tag_close']  = '</a></li>';
        $config['num_tag_open']   = '<li>';
        $config['num_tag_close']  = '</li>';

        $this->pagination->initialize($config);
        $pages = $_GET['offset'];
        $postlist['page'] = ($pages != "") ? $pages : 0;

        return array('per_page'=>$config['per_page'] ,'page'=>$postlist['page']);	
	   
 }



}
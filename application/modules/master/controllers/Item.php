<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class Item extends my_controller {


function __construct(){
   parent::__construct(); 
    $this->load->model('model_master');	
}

public function addItem(){
	if($this->session->userdata('is_logged_in')){
		$this->load->view('/Item/add-item');
	}
	else
	{
	redirect('index');
	}
}

public function sameitemequal(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Item/same-msg-item',$data);
	}
	else
	{
	redirect('index');
	}
}


public function updateItem(){
	if($this->session->userdata('is_logged_in')){
	 $data['ID'] = $_GET['ID'];
		$this->load->view('/Item/edit-item',$data);
	}
	else
	{
	redirect('index');
	}
}

public function manage_item(){
	 $table_name = 'tbl_product_stock';
	if($this->session->userdata('is_logged_in')){
    ////Pagination start ///
	  $url   = site_url('/master/Item/manage_item?');
	  $sgmnt = "4";
	  $showEntries =10;
       $totalData  = $this->model_master->count_all($this->input->get());
      //$showEntries= $_GET['entries']?$_GET['entries']:'12';

      if($_GET['entries']!=""){
         $showEntries = $_GET['entries'];
         $url   = site_url('/master/Item/manage_item?entries='.$_GET['entries']);
      }
         $pagination = $this->ciPagination($url,$totalData,$sgmnt,$showEntries);

      //////Pagination end ///
	$data=$this->user_function();// call permission fnctn
	$data['dataConfig'] = array('total'=>$totalData,'perPage'=>$pagination['per_page'],'page'=>$pagination['page']);
	$data['pagination'] = $this->pagination->create_links();
	$data['per_page'] = $pagination['per_page'];
	$data['page']=$pagination['page'];	
	$this->load->view('Item/manage-item',$data);
	}
	else
	{
	redirect('index');
	}
		
}

public function test_3(){
	
	if($this->session->userdata('is_logged_in')){
	$this->load->view('Item/test_3');
	}
	else
	{
	redirect('index');
	}
		
}

public function item_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A')
           -> get('tbl_product_stock');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{		 
		  
		  $compQuery1 = $this -> db
           -> select('*')
           -> where('serial_number',$row->usageunit)
           -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
		  
		
			$info[$i]['1']=$row->Product_id;
			$info[$i]['2']=$row->category;
			$info[$i]['3']=$row->productname;
			$info[$i]['4']=$row->unitprice_purchase;
			$info[$i]['5']=$row->unitprice_sale;
			$info[$i]['6']=$row->mrp;
			$info[$i]['7']=$row->Product_id;		
			$info[$i]['8']=$keyvalue1->keyvalue;
			$info[$i]['9']=$row->product_image;
				
				$i++;
			
		}
		return $info;
	
	}
	
public function get_cid(){
	//$data=$this->user_function();// call permission function
	
		$this->load->view('get_cid');
	
	}

public function add_item(){
//echo "";die;
	if($this->session->userdata('is_logged_in')){
		$this->load->view('Item/add-item');
}
	else
	{
	redirect('index');
	}
}
//=========================================================================================

public function update_item(){

		@extract($_POST);

		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$mdate=$dt->format('d/m/Y H:i:s');	

		$table_name ='tbl_product_stock';
		$pri_col ='Product_id';
		$table_name_log ='tbl_all_activity_product_stock_log';
		$id= $this->input->post('Product_id');
		$Product_typeid= $this->input->post('Product_type');
		
		$countsizesumup=$sizerow;
		$out = array();
		$outweight = array();
		$countsize=$countsizesumup;
		for($i=0;$i<=$countsize;$i++){
				
				$sizeid=$this->input->post('size')[$i];
				$weightnameid=$this->input->post('weightname')[$i];
							
			if($sizeid!=''){					
					 array_push($out, $sizeid);
					 array_push($outweight, $weightnameid);					
				}					
			}
		
	    $totalsize=implode(' ', $out);
		$totalweight=implode(' ', $outweight);
		
		$this->load->model('Model_admin_login');
	
	/*@$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
		$branchFetch2 = $branchQuery2->row();
	
		
				if($_FILES['image_name']['name']!='')
				{
						$target = "assets/image_data/"; 
						$target1 =$target . @date(U)."_".( $_FILES['image_name']['name']);
						$image_name=@date(U)."_".( $_FILES['image_name']['name']);
						move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
				}
				else
				{
					$image_name=$branchFetch2->product_image;
					
				}		*/
					$dataarr= array(
										
							'productname' => $this->input->post('item_name'),
							'Product_type' => $Product_typeid,
							'category' => $this->input->post('category'),
							'price_range' => $this->input->post('price_range'),
							'stockpid' => $this->input->post('stockpid'),
							//'product_image' => $image_name,
							'size' => $totalsize,
							'weight_name' => $totalweight,
							'Product_typeid' => $Product_typeid,
							'sku_no' => $this->input->post('sku_no'),
							'min_re_order_level' => $this->input->post('min_re_order_level'),
							'usageunit' => '22',
							'pic_per_box' => $this->input->post('pic_per_box'),
				
		      	);
					//$idE=$Product_id[$i];
				$statusdata=array(
					'action_status' => 'update',
					'item_id' => $id,
					);

				$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> $mdate
					);
		
			$dataupdate = array_merge($dataarr,$sesio);

			$dataupst = array_merge($dataarr,$statusdata,$sesio);		
				
				$this->Model_admin_login->update_user($pri_col,$table_name,$id,$dataarr);
				$this->Model_admin_login->insert_user($table_name_log,$dataupst);
		 $this->load->view('master/Item/second-manage-page');
					
}

//============================================================================================

public function insert_item(){
			
		@extract($_POST);

		date_default_timezone_set('Asia/Kolkata');
		$dt = new DateTime();
		$mdate=$dt->format('d/m/Y H:i:s');	
		
		$table_name ='tbl_product_stock';
		$pri_col ='Product_id';
		$table_name_log ='tbl_all_activity_product_stock_log';
	 	$id= $this->input->post('Product_id');
		$addpro= $this->input->post('add_new_product');
	
		$countsizesum=$sizerow;
		$out = array();
		$outweight = array();
		$countsize=$countsizesum+1;
		for($i=0;$i<=$countsize;$i++){
				
				$sizeid=$this->input->post('size')[$i];
				$weightnameid=$this->input->post('weightname')[$i];
							
			if($sizeid!=''){					
					 array_push($out, $sizeid);
					 array_push($outweight, $weightnameid);					
				}	
				
			}
		
		$totalsize=implode(' ', $out);
		$totalweight=implode(' ', $outweight);
			
	
		/* @$branchQuery2 = $this->db->query("SELECT * FROM $table_name where status='A' and Product_id='$id'");
					$branchFetch2 = $branchQuery2->row();
		
				if($_FILES['image_name']['name']!='')
					{
						$target = "assets/image_data/"; 
						$target1 =$target . @date(U)."_".( $_FILES['image_name']['name']);
						$image_name=@date(U)."_".( $_FILES['image_name']['name']);
						move_uploaded_file($_FILES['image_name']['tmp_name'], $target1);
					}
					else
					
					{
					$image_name=$branchFetch2->product_image;
					
					}		*/
					
					$this->load->model('Model_admin_login');
					
					$data= array(
					'productname' => $item_name,
					'Product_type' => $this->input->post('Product_type'),
					'category' => $this->input->post('category'),
					'price_range' => $this->input->post('price_range'),
					'stockpid' => $this->input->post('stockpid'),
					//'product_image' => $image_name,
					'size' => $totalsize,
					'weight_name' => $totalweight,
					'Product_typeid' => $Product_typeid,
					'sku_no' => $this->input->post('sku_no'),
					'min_re_order_level' => $this->input->post('min_re_order_level'),
					'usageunit' => '22',
					'pic_per_box' => $this->input->post('pic_per_box'),
					
					
					
		      	);
	
	$sesio = array(
					
					'comp_id' => $this->session->userdata('comp_id'),
					'divn_id' => $this->session->userdata('divn_id'),
					'zone_id' => $this->session->userdata('zone_id'),
					'brnh_id' => $this->session->userdata('brnh_id'),
					'maker_date'=> date('y-m-d'),
					'author_date'=> $mdate
					);
		
		$dataall = array_merge($data,$sesio);
		$this->Model_admin_login->insert_user($table_name,$dataall);
		$lastHdrId=$this->db->insert_id();	

		$statusdata=array(
					'action_status' => 'insert',
					'item_id' => $lastHdrId,

					);

		$datact = array_merge($data,$statusdata,$sesio);					
		
		$this->Model_admin_login->insert_user($table_name_log,$datact);
		 $this->load->view('Item/second-manage-page');
	}


	private function set_barcode($code)
	{
		//load library
		$this->load->library('zend');
		//load in folder Zend
		$this->zend->load('Zend/Barcode');
		//generate barcode
		Zend_Barcode::render('code128', 'image', array('text'=>$code), array());
	}
	
	
	public function bar()
	{
		//I'm just using rand() function for data example
		$temp = rand(10000, 99999);
		$this->set_barcode($temp);
	}

	
public function import_product(){
	
	if($this->session->userdata('is_logged_in')){
	
		$this->load->view('Item/import-product');
}

else{
redirect('index');

}

}


public function import_item(){
 @extract($_POST);
 $filename=$_FILES["file"]["tmp_name"];
 
 
		 if($_FILES["file"]["size"] > 0)
		 {
 
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
 
//select id of category
 $catId=$this->db->query("select *from tbl_prodcatg_mst where prodcatg_id!='121' and prodcatg_name='".$getData[2]."'");
 $catRow=$catId->row();
 
//select id of unit id
 $unitId=$this->db->query("select *from tbl_master_data where param_id='24' and keyvalue='".$getData[1]."'");
 $unitRow=$unitId->row();
	         
if($getData[0]!='')
{
	
	
			   $this->db->query("insert into tbl_product_stock set productname='".$getData[0]."',category='".$catRow->prodcatg_id."',Product_type='".$unitRow->serial_number."',min_re_order_level='".$getData[4]."',price_range='".$getData[5]."',size='".$getData[6]."',weight_name='".$getData[7]."',comp_id='".$this->session->userdata('comp_id')."',divn_id='".$this->session->userdata('divn_id')."',zone_id='".$this->session->userdata('zone_id')."',brnh_id='".$this->session->userdata('brnh_id')."',maker_date='".date('y-m-d')."',author_date='".date('y-m-d')."'");
			   
}		
	         }
			 fclose($file);
		
		 }
	         //fclose($file);
echo "<script>
alert('Product Imported Successfully');

window.location.href = 'manage_item';


</script>";
			 
	 
//redirect('/master/manage_item');
	
}


}

?>
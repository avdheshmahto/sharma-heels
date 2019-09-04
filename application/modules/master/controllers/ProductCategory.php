<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting (E_ALL ^ E_NOTICE);
class ProductCategory extends my_controller {
function __construct(){
   parent::__construct(); 
$this->load->model('model_master');
}

public function pcategory_list()
	{
		$info=array();
		
		$res = $this -> db
           -> select('*')
           -> where('status','A','comp_id',$this->session->userdata('comp_id'))
           -> get('tbl_prodcatg_mst');
		   
		$i='0';
		
		foreach($res->result() as $row)
		{
	
		  $compQuery = $this -> db
           -> select('*')
           -> where('status','A','prodcatg_id',$row->main_prodcatg_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();
		
		  if($row->main_prodcatg_id==1){$Primary="Y";}else{$Primary="N";}
				
			$info[$i]['1']=$row->prodcatg_name;
			$info[$i]['2']=$Primary;
			 if($row->main_prodcatg_id!='1'){
			$info[$i]['3']=$compRow->prodcatg_name;
			}
			$info[$i]['4']=$row->prodcatg_id;				
				$i++;
			
		}
		return $info;
	
	}

	public function insert_itemctg(){	
			extract($_POST);
			$count= count($prodcatg_id);
			//echo $count;die;
			$table_name ='tbl_prodcatg_mst';
		 	$pri_col ='prodcatg_id';
	 		$id= $this->input->post('prodcatg_id');
			//echo $id;die;
			$this->load->model('Model_admin_login');
			
			if($id==''){
			
			$categ=$this->input->post('prodcatg_name');
			$capcate=strtoupper($categ);
			$urllinkss='ViewOrder/ViewOrder/viewOrderNat?id='.$categ;
			$this->db->query("insert into tbl_module_function set function_url='$urllinkss',function_name='$capcate',function_group='VIEW ORDER', module_name='45'");
			$lastHdrId=$this->db->insert_id();	
			
			$data=array(
					
					'prodcatg_name' => $this->input->post('prodcatg_name'),
					'printname' => $this->input->post('printname'),
					'alias' => $this->input->post('alias'),
					'Description' => $this->input->post('description'),
					'module_funid' => $lastHdrId,
					'main_prodcatg_id' => $midd1
					
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
					redirect('/master/ProductCategory/manage_itemctg');
										
					}
				else
				{
				for($i=1;$i<=$count;$i++){
				//echo $prodcatg_id[$i];die;
				 $idE=$prodcatg_id[$i];
				$dataarr=array(
				
					'main_prodcatg_id' => $midd1[$i],
					'prodcatg_name' => $prodcatg_name[$i],
					'printname' => $printname[$i],
					'alias' => $alias[$i],
					'Description' => $description[$i]
				);
				
				$this->Model_admin_login->update_user($pri_col,$table_name,$idE,$dataarr);
		
			$qurr=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$idE'");	
			$fetchqrr=$qurr->row();
			$funidds=$fetchqrr->module_funid;
			if($funidds!=''){			
			
			$categ=$prodcatg_name[$i];
			$capcate=strtoupper($categ);
			$urllinkss='ViewOrder/ViewOrder/viewOrderNat?id='.$categ;
			$this->db->query("update tbl_module_function set function_url='$urllinkss',function_name='$capcate', function_group='VIEW ORDER' where func_id='$funidds'");	
				
				}
			}
					$this->session->set_flashdata('flash_msg', 'Record Updated Successfully.');
				
					redirect('/master/ProductCategory/manage_itemctg');
				
				}
				
			}	
			
	

public function add_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
		$this->load->view('ProductCategory/add-itemctg');
	}
	else
	{
	redirect('index');
	}
	
	
}
	
	public function manage_itemctg(){
	
	if($this->session->userdata('is_logged_in')){
	$data=$this->user_function();// call permission fnctn
	$data['result'] = $this->model_master->productCatg_data();
	$this->load->view('ProductCategory/manage-itemctg',$data);
	}
	else
	{
	redirect('index');
	}
	
	
}

	
public function aliesfunction(){
	
		$data['alias_idd']=$_GET['alias_idd'];
		$this->load->view('get-alies-itemctg',$data);
	
	}

	public function prodcatefunction(){
	
		$data['prodcatg_id']=$_GET['prodcatg_id'];
		$this->load->view('get-alies-itemctg',$data);
	
	}
	
}
?>
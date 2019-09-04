<?php
class model_admin extends CI_Model {

function master_data(){
	
	  $this->db->select("*");
	  $this->db->order_by("serial_number","desc");
      $this->db->from('tbl_master_data');  
      $query = $this->db->get();
      
	  return $result=$query->result();  
}	

function product_get(){
	
	  
	  $query=$this->db->query("select * from tbl_product_stock where status='A'");
      
	  return $result=$query->result();  
}

	
}

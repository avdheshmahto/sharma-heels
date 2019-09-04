<?php
class model_stock_manage extends CI_Model {
	
function stock_datas(){
	  $query=$this->db->query("select * from tbl_product_serial where status='A' Order by serial_number desc ");
	 
	  return $result=$query->result();  
}

}

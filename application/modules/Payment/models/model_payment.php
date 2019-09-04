<?php
class model_payment extends CI_Model {
	
function productCatg_data(){
	
	  $this->db->select("*");
	  // $this->db->order_by("prodcatg_id","desc");
      $this->db->from('tbl_prodcatg_mst');  
      $query = $this->db->get();
      
	  return $result=$query->result();  
}	

function contact_get_bapa(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='BapaNagar'");
      
	  return $result=$query->result();  
}

function contact_get_mum(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='Mumbai'");
      
	  return $result=$query->result();  
}

function contact_get_seel(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='Seelampur'");
      
	  return $result=$query->result();  
}


function contact_get_mad(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='Madipur'");
      
	  return $result=$query->result();  
}

function contact_get_rega(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='Ragarpura'");
      
	  return $result=$query->result();  
}

function product_get_gst(){
	
	  
	  $query=$this->db->query("select * from tbl_payment_gst where status='A' order by invoice_gstid desc");
      
	  return $result=$query->result();  
}

function count_all($get){
  $qry ="select count(*) as countval from tbl_contact_m where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}



}

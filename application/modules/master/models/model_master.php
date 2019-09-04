<?php
class model_master extends CI_Model {
	
function productCatg_data(){
	
	  $this->db->select("*");
	  // $this->db->order_by("prodcatg_id","desc");
      $this->db->from('tbl_prodcatg_mst');  
      $query = $this->db->get();
      
	  return $result=$query->result();  
}	

function contact_get(){
	
	  
	  $query=$this->db->query("select * from tbl_contact_m where status='A'");
      
	  return $result=$query->result();  
}

function product_get(){
	
	  
	  $query=$this->db->query("select * from tbl_product_stock where status='A' order by Product_id desc");
      
	  return $result=$query->result();  
}

function count_all($get){
  $qry ="select count(*) as countval from tbl_product_stock where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function count_all_stockpointandvendor($get){
  $qry ="select count(*) as countval from tbl_stockpoint_and_vendor where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function count_all_customernat($get){
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

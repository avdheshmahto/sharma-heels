<?php
class model_salesorder extends CI_Model {
	
function salesorder_data(){
$query=$this->db->query("select * from tbl_order_hdr where status='A' Order by order_id desc ");
return $result=$query->result();  
}

function count_all($get){
  $qry ="select count(*) as countval from tbl_order_hdr where status= ?";
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

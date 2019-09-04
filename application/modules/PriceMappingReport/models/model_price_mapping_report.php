<?php
class model_price_mapping_report extends CI_Model {
	
function count_all($get){
  $qry ="select count(*) as countval from tbl_contact_product_price_mapping where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function total_qtys($get){
  $qry ="select sum(price) as sumval from tbl_contact_product_price_mapping where status= 'A'";
  $query=$this->db->query($qry)->result_array();
   return $query[0]['sumval'];
}

}

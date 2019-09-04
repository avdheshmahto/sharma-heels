<?php
class model_order_report extends CI_Model {
	
function count_all($get){
  $qry ="select count(*) as countval from tbl_order_dtl where status= ?";
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
  $qry ="select sum(total_qty) as sumval from tbl_order_dtl where status= 'A'";
  $query=$this->db->query($qry)->result_array();
   return $query[0]['sumval'];
}

}

<?php
class model_pricemapping extends CI_Model {
	


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

//========================Close Report ===========================================

}

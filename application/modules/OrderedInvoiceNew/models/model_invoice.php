<?php
class model_invoice extends CI_Model {
	
function stock_datas(){
	  $query=$this->db->query("select * from tbl_product_serial where status='A' Order by serial_number desc ");
	 
	  return $result=$query->result();  
}

function count_all($get){
  $qry ="select count(*) as countval from tbl_ordered_invoice_hdr where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function count_all_report_log($get){
  $qry ="select count(*) as countval from tbl_ordered_invoice_dtl where status= ?";
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
?>
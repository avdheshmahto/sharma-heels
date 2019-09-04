<?php
class model_stock_manage extends CI_Model {
	
function stock_datas(){
	  $query=$this->db->query("select * from tbl_product_serial where status='A' Order by serial_number desc ");
	 
	  return $result=$query->result();  
}

function count_all($get){
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


function count_all_inward($get){
  $qry ="select count(*) as countval from tbl_product_serial where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function count_all_tbllog($get){
  $qry ="select count(*) as countval from tbl_product_stock_log where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}

function count_all_tbl_history_log($get){
  $qry ="select count(*) as countval from tbl_stock_point_history_log where status= ?";
    if($get['filtername']!="" || $get['filterdate']!="" ){
      if($get['filtername']!="")
         $qry .= " AND name LIKE '%".$get['filtername']."%'";

      if($get['filterdate']!="")
         $qry .= " AND create_on ='".$get['filterdate']."'";
  }

   $query=$this->db->query($qry,array('A'))->result_array();
   return $query[0]['countval'];
}
//=====================Report ====================================================

function count_all_tbllogrrr($get){
  $qry ="select count(*) as countval from tbl_product_stock_log where status= ?";
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


//=====================Total inward and outward Qty ====================================================

function inwarqtys($get){
  	
	$totalinwdamount=0;
   $query=$this->db->query("select * from tbl_product_serial");
   foreach($query->result() as $data_list){
   
   		$sizeval=$data_list->size;
		$qtyyval=$data_list->quantity;		
		$sizecount=sizeof(explode(' | ', $sizeval));

		$sizearr=explode(' | ', $sizeval);
		$qtyarr=explode(' ', $qtyyval);
   		
			$actqtyto='';
		for($j=1;$j<$sizecount;$j++){ $jk=$j-1; 
						
						$actqtyto +=$qtyarr[$jk];
			}	
		$totamt=$actqtyto;
		$totalinwdamount +=$totamt;
   }
   return $totalinwdamount;
}

function outwardqtys($get){
  $qry ="select sum(total_qty) as sumval from tbl_ordered_invoice_dtl";
  $query=$this->db->query($qry)->result_array();
   return $query[0]['sumval'];
}
//========================Close total inward and outward Qty ===========================================

}

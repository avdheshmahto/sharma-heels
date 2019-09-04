<?php  
	$custandlocid=$_GET['id'];
	$ex=explode("^",$custandlocid);
	$custid=$ex[0];
	$locname=$ex[1];
	$invdate=$ex[2];

if($locname=='National'){		
			$ordhdrqry =$this->db->query("Select * from tbl_contact_m where status='A' and contact_id='$custid'");  
	}else{
			$ordhdrqry =$this->db->query("Select * from tbl_location where STATUS='A' and id='$custid'");    
	}	
	
	$numq=$ordhdrqry->row();
if($numq->credit_limit!=''){
echo $numq->credit_limit;
?>			
<input type="hidden" name="credit_name" value="<?php echo $numq->credit_limit; ?>" />
<?php } ?>
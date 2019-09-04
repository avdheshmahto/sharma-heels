<?php  
	$custandlocid=$_GET['id'];
	$ex=explode("^",$custandlocid);
	$custid=$ex[0];
	$locname=$ex[1];
	$invdate=$ex[2];
    $proidss=$ex[3];	

if($locname=='National'){		
			$ordhdrqry =$this->db->query("Select * from tbl_contact_m where status='A' and contact_id='$custid'");  
	}else{
			$ordhdrqry =$this->db->query("Select * from tbl_location where STATUS='A' and id='$custid'");    
	}	
	
	$numq=$ordhdrqry->row();
if($numq->term!=''){
echo $numq->term."&nbsp;Day";
?>			
<input type="hidden" name="term_name" value="<?php echo $numq->term; ?>" />
<?php } ?>
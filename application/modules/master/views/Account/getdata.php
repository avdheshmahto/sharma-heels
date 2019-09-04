<?php
 	 $contactid=$id;
	 $ex=explode("^",$contactid);
	 $contact_id=$ex[0];
	 $location_code=$ex[1];
	$Query=$this->db->query("select * from tbl_contact_m where location_id='$contactid'");
    foreach($Query->result() as $fetchlist){
	 $fetchlist->contact_code;
	}
	if($fetchlist->contact_code!=''){
	$sh=$fetchlist->contact_code;
	 $var = str_pad(++$sh,1,'0',STR_PAD_LEFT);
	}else{
	
	$number =1; 
	$numbercase = sprintf('%03d',$number);
	
	$countdata=$location_code;
	 $var=$countdata.$numbercase;
	}

 ?>
<input type="text" name="contact_code" readonly class="form-control" value="<?php echo $var; ?>" />

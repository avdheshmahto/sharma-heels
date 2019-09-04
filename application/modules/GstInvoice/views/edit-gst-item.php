<?php 
$a=$_GET['eid'];
$epid=explode('^',$a);
$upid=$epid[1];
$eid=$epid[0];

   
	$EditQry=$this->db->query("select * from tbl_gst_invoice_hdr where gst_inv_id='$upid' AND status='A'");
   	$editResult =  $EditQry->row();
   	
	$ItemEditQry=$this->db->query("select * from tbl_gst_invoice_dtl where status= 'A' and p_id='$eid'");
   	$ItemEditResult =  $ItemEditQry->row();
 
?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Edit Item Gst Invoice</h4>
</div>
<div class="modal-body overflow">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr class="gradeA">
<th>Firm</th>
        <th> <select  name="myfirmid" id="" class="form-control">
            <option value="">----Select ----</option>
			<?php 
		$query1=$this->db->query("select * from tbl_master_data where param_id=25");
		$que=$query1->row();
			
			?>
			<option <?php if($editResult->firm_id==$que->serial_number){?> value="<?=$editResult->firm_id?>" selected="selected" <?php }?>><?=$que->keyvalue;?></option>
			
          </select>
        </th>
<th><input type="hidden" name="upid" value="<?=$upid?>"/>
<input type="hidden" name="eid" value="<?=$eid?>"/></th>
        <th>Date</th>
        <th style="width:140px;"><input type="text" name="mycurrentdate_id" id="" class="form-control datepicker" width="215"  value="<?php echo $editResult->inv_date; ?>"/></th>
        <th>Invoice No.</th>
        <th style="width:150px;" id="termidd"><input type="text" name="myinvoice_id" id="invoice_id" class="form-control" value="<?=$editResult->invoice_no;?>"/></th>
</tr>
<th>
<input type="hidden" name="customer_id" value="<?php echo $ID; ?>" class="form-control" style="width:100px;"  />
<input type="hidden" name="location_name" id="location_name" value="<?php echo $locname; ?>" class="form-control" style="width:100px;"  />
</th>

<tr class="gradeA">
<th>Customer Name</th>
<th>
<select  name="mycustomer_id" id="customer_id" class="form-control" value="">
						<option value="">----Select ----</option>
<?php
$query=$this->db->query("select * from tbl_contact_m");
$qu=$query->row();
?>
<option <?php if($editResult->customer_name==$qu->contact_id){?> value="<?=$editResult->customer_name;?>" selected="selected" <?php }?>/><?=$qu->first_name?></option>

</select>
</th>				

<th style="width:100px" colspan="4">&nbsp;</th>
	
</tr>

</tbody>
</table>
</div>	
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<tbody>
<tr class="gradeA">
<th>Category</th>
<th>Qty</th>
<th>Rate</th>
<th>GST Percent</th>
<th>Amount</th>
<th>GST</th>
</tr>

<tr class="gradeA">
<th style="width:280px;">
<select  name="mycatid" id="mycatid" class="form-control">	
            <option value="">----Select ----</option>
			<?php 
			$query1=$this->db->query("select * from tbl_prodcatg_mst");
			foreach($query1->result() as $que){
			
			?>
			<option value="<?=$que->prodcatg_id;?>" <?php if($ItemEditResult->category_id==$que->prodcatg_id){?>  selected="selected" <?php }?>><?=$que->prodcatg_name;?></option>
			<?php } ?>
       </select>
</th>
<th>
<input type="number" id="myqty" name="myqty" style="width:100px;" class="form-control" value="<?=$ItemEditResult->qty;?>" onkeyup="autoamtedit()"></th>

<th><input type="number" id="myrate" name="myrate" min="1" style="width:100px;"   class="form-control" value="<?=$ItemEditResult->rate;?>" onkeyup="autoamtedit()"></th>

<th><input type="number" id="mygst_percent" name="mygst_percent" style="width:100px;" class="form-control" value="<?=$ItemEditResult->gstp;?>" onkeyup="autogstedit()"/> </th>

<th><input type="number" id="myamount" name="myamount" style="width:100px;" class="form-control" value="<?=$ItemEditResult->amt;?>" readonly="true"> </th>

<th><input type="number" id="mygst" name="mygst" style="width:100px;" class="form-control" value="<?=$ItemEditResult->gst;?>" readonly="true"/> </th>
</tr>

<input type="hidden" id="amtid" value="<?=$ItemEditResult->amt;?>" />
<input type="hidden" id="gstid" value="<?=$ItemEditResult->gst;?>" />
<input type="hidden" id="totid" value="<?=$ItemEditResult->total;?>" />
<input type="hidden" id="gsttotid" value="<?=$ItemEditResult->gst_amt;?>" />

<input type="hidden" id="to_totid" name="to_totid" value="<?=$ItemEditResult->total;?>" />
<input type="hidden" id="to_gsttotid" name="to_gsttot" value="<?=$ItemEditResult->gst_amt;?>" />
<input type="hidden" id="to_gtotid" name="to_gtot" value="<?=$ItemEditResult->grand_total;?>" />
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

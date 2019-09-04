<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update Payment</h4>
</div>
<div class="modal-body overflow">
<table class="table table-striped table-bordered table-hover dataTables-example">
<thead>
<tr>
<th>Firm Name</th>
<th>Date</th>
<th>Paid Amount</th>
<th>Remarks</th>
</tr>
</thead>
<?php
	 $ItemQuery=$this->db->query("select * from tbl_payment_gst where invoice_gstid='".$_GET['ID']."'");
         $fetch_list=$ItemQuery->row();

?>
<tr>
<th><select name="firm" required class="form-control" id="firm" onchange="check1(this.value)">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_master_data where param_id='25'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->serial_number;?>"<?php if($fetch_protype->serial_number==$fetch_list->firm){?>selected<?php }?>><?php echo $fetch_protype->keyvalue; ?></option>
					<?php } ?>

</select></th>
<input name="payment_id"  type="hidden" value="<?=$fetch_list->invoice_gstid;?>" class="form-control" required>
<th><input name="date"  type="date" value="<?=$fetch_list->date;?>" class="form-control" required></th>
<th><input name="amt"  type="number" value="<?=$fetch_list->total_billamt;?>" onkeyup="calculation(this.value)" class="form-control" required></th>
<th><textarea name="remarks" class="form-control" required><?=$fetch_list->remarks;?></textarea></th>
</tr>
</table>
<?php 
$ItemQuery111=$this->db->query("select * from tbl_payment_cash where invoice_rid='".$_GET['ID']."'");
         $fetch_list111=$ItemQuery111->row();
?>
<input name="payment_cash"  type="hidden" value="<?php echo $fetch_list111->invoice_rid;?>" class="form-control" required>
<div class="form-group">
</div> 
<div class="form-group">
<?php if($fetch_list->status=='Invoice'){?>
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>Amount</th>
<th>CGST</th>
<th>SGST</th>
<th>IGST</th>
</tr>
</thead>
<tbody>
<tr>
<?php 
$contactqry=$this->db->query("select * from tbl_contact_m where contact_id='".$fetch_list->contact_id."'");
         $fetchcontact=$contactqry->row();
?>
<th><input name="contact_id"  type="hidden" value="<?php echo $fetch_list->contact_id;?>" id="contact_id" class="form-control" >
<input name="type"  type="hidden" value="<?php echo $fetch_list->status;?>" id="type" class="form-control" >
<input name="gst"  type="hidden" value="<?=$fetchcontact->gst;?>" id="gst" class="form-control" >
<input name="state"  type="hidden" value="<?=$fetchcontact->state;?>" id="state" class="form-control" >
<input name="paidamt"  type="hidden" value="<?=$fetch_list111->total_billamt;?>" id="paidamt" class="form-control" >
<?php 
$totgstamt=$fetch_list->cgst+$fetch_list->sgst+$fetch_list->igst;
$totval=$fetch_list->total_billamt-$totgstamt;
?>
<input name="priAmt"  type="text" readonly="" value="<?=$totval;?>" id="priAmt" class="form-control" >
</th>
<th><input name="cgst"  type="text" readonly="" value="<?php echo $fetch_list->cgst;?>" id="cgst" class="form-control" ></th>
<th><input name="sgst"  type="text" readonly="" value="<?php echo $fetch_list->sgst;?>" id="sgst" class="form-control" > </th>
<th><input name="igst"  type="text" readonly="" value="<?php echo $fetch_list->igst;?>" id="igst" class="form-control" ></th>
</tr>
</tbody>
</table>
<?php }?>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" data-dismiss="modal1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
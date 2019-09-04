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
<th>Date</th>
<th>Paid Amount</th>
<th>Remarks</th>
</tr>
</thead>
<?php
	 $ItemQuery=$this->db->query("select * from tbl_payment_cash where invoice_rid='".$_GET['ID']."'");
         $fetch_list=$ItemQuery->row();

?>
<tr>
<input name="payment_id"  type="hidden" value="<?=$fetch_list->invoice_rid;?>" class="form-control" required>
<th><input name="date"  type="date" value="<?=$fetch_list->date;?>" class="form-control" required></th>
<th><input name="amt"  type="number" value="<?=$fetch_list->total_billamt;?>" class="form-control" required></th>
<th><textarea name="remarks" class="form-control" required><?=$fetch_list->remarks;?></textarea></th>
</tr>
</table>
<?php 
$contactqry=$this->db->query("select * from tbl_contact_m where contact_id='".$fetch_list->contact_id."'");
         $fetchcontact=$contactqry->row();
?>
<input name="contact_id"  type="hidden" value="<?php echo $fetch_list->contact_id;?>" id="contact_id" class="form-control" >
<div class="form-group"> 
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" data-dismiss="modal1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
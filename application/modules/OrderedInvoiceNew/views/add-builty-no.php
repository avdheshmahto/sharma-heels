<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Builty No.</h4>
</div>
<div class="modal-body overflow">

<?php
	 $ContactQuery=$this->db->query("select * from tbl_ordered_invoice_hdr where ordered_invoiceid='$ID'");
         $branchFetch=$ContactQuery->row();
//echo $ID;
?>

<div class="form-group"> 
<label class="col-sm-4 control-label">*Builty No.:</label> 
<div class="col-sm-4"> 			
<input type="hidden" name="inv_id" value="<?php echo $ID; ?>" class="form-control">
<input type="text" name="builty_no" value="<?php echo $branchFetch->builty_no; ?>" class="form-control" required>
</div> 
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

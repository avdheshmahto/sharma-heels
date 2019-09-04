<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update StockPoint</h4>
</div>
<div class="modal-body overflow">

<?php
 $ContactQuery=$this->db->query("select * from tbl_stockpoint_and_vendor where stockpid='$ID'");
         $branchFetch=$ContactQuery->row();

?>

<div class="form-group"> 
<label class="col-sm-2 control-label">*Name:</label> 
<div class="col-sm-4"> 				
<input type="hidden" id="vendorid" name="vendorid" class="form-control" value="<?php echo $branchFetch->stockpid; ?>">
<input type="text" id="stockpoint" name="stockpoint" class="form-control" value="<?php echo  $branchFetch->stockpointname; ?>">
</div> 

<label class="col-sm-2 control-label">Type:</label> 
<div class="col-sm-4"> 
<select id="pointtype" name="pointtype" class="form-control">
	<option value="">--select--</option>
	<option value="StockPoint" <?php if($branchFetch->type=='StockPoint'){ ?> selected="selected" <?php } ?>>StockPoint</option>
	<option value="Vendor" <?php if($branchFetch->type=='Vendor'){ ?> selected="selected" <?php } ?>>Vendor</option>
</select>
</div> 
</div>
<div class="form-group">  
<label class="col-sm-2 control-label">Phone No.:</label> 
<div class="col-sm-4"> 
<input type="tel" minlength="10" maxlength="10" id="mobileid" name="mobile" title="Enter 10 digit mobile number"  value="<?php echo  $branchFetch->phone_no; ?>" class="form-control" >
</div> 
<label class="col-sm-2 control-label">GST%:</label> 
<div class="col-sm-4"> 
<input type="number" id="gst" name="gst" value="<?php echo  $branchFetch->gst_per; ?>" class="form-control">
</div>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Address:</label> 
<div class="col-sm-4" id="regid"> 
<textarea  id="addressidds" name="addressidds" class="form-control"><?php echo $branchFetch->address; ?></textarea>
</div>  
</div>

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

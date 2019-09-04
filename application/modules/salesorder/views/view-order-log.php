<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add and View Order Log</h4>
      </div>
      <div class="modal-body">	  
<table class="table table-striped table-bordered table-hover" >
<tbody>

<div class="form-group" > 
<label class="col-sm-4 control-label" >Note:</label> 
<div class="col-sm-4" > 
<textarea  name="note" class="form-control"><?php //echo $branchFetch->note; ?></textarea>
</div>  
<label class="col-sm-4 control-label" style="display:none">Order Id:</label> 
<div class="col-sm-4" > 
<input type="hidden" name="orderid" class="form-control" value="<?php echo $ID; ?>" />
</div>  
<?php
$sqlQInvoice=$this->db->query("Select * from tbl_ordered_invoice_dtl where order_id='$ID'");
$InvoiceValid=$sqlQInvoice->num_rows();


$query=$this->db->query("select * from tbl_order_hdr where status='A' and order_id='$ID'");	       
  $resultrow=$query->row();
     ?>
<input type="hidden" name="" id="invidval" class="form-control" value="<?php echo $InvoiceValid; ?>" />	 
</div>
</tbody>
</table>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Date</th>
<th>Note</th>
</tr>
<?php 
	
	$orderdtlquert=$this->db->query("select * from tbl_order_note_log where order_id='$ID' Order by log_id desc");
		  
	foreach($orderdtlquert->result() as $fetch_list){	  

?>
<tr>
<th><?php echo  $fetch_list->maker_date; ?></th>
<th><?php echo  $fetch_list->note_msg; ?></th>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

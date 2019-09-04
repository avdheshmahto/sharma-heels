<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Invoice</h4>
      </div>
      <div class="modal-body">	  
	  <div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<?php
   $orderhdrquert=$this->db->query("select * from tbl_ordered_invoice_hdr_reg where ordered_invoiceid_reg='$ID'");
	$fetchOrderHdr=$orderhdrquert->row();
?>
<tr class="gradeA">
<th>Customer Name</th>
<th>
<input type="hidden" name="Customer_id" value="<?php echo $fetchOrderHdr->customer_id; ?>" />
<?php
		$contactQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetchOrderHdr->customer_id)
           -> get('tbl_contact_m');
		  $contactRow = $contactQuery->row();

echo $contactRow->first_name;

?>
</th>
<th>Date</th>
<th><?php echo $fetchOrderHdr->invoice_date; ?></th>
</tr>
</tbody>
</table>
</div>

<div class="table-responsive2">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Item Name</th>
<th>Category</th>
<th>Total Quantity</th>
</tr>
<?php 
				$rowi=1;
	$orderdtlquert=$this->db->query("select * from tbl_ordered_invoice_dtl_reg where ordered_invoiceid_reg='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  

?>
<tr>
<td>
<input type="hidden" name="item_id[]" value="<?php echo $fetch_list_orderdtl->item_id; ?>" />
<input type="hidden" name="order_idd[]" value="<?php echo $fetch_list_orderdtl->ordered_invoiceid_dtl_reg; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id_reg',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock_regarpura');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?></td>

<td>
<input type="hidden" name="category_id[]" value="<?php echo $fetch_list_orderdtl->category_id; ?>" />
<?php
$compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->category_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;		

?></td>
<td><?php echo $fetch_list_orderdtl->total_qty; ?></td>
</tr>
<?php $rowi++; } ?>
<input type="hidden" name="rows" id="rowsid" class="form-control" value="<?php echo $rowi; ?>"  />
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

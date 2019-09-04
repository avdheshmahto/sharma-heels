<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View Order</h4>
      </div>
      <div class="modal-body">	  
	  <div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<?php
   $orderhdrquert=$this->db->query("select * from tbl_order_hdr_seel where order_id_seel='$ID'");
	$fetchOrderHdr=$orderhdrquert->row();
?>
<tr class="gradeA">
<th>Type</th>
<th><?php 

if($fetchOrderHdr->customer_id!=''){
		
		$contactQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetchOrderHdr->customer_id)
           -> get('tbl_contact_m');
		  $contactRow = $contactQuery->row();

echo $contactRow->first_name;

		
}else{

/*
	$locQuery = $this -> db
           -> select('*')
           -> where('id',$fetchOrderHdr->store_id)
           -> get('tbl_location');
		  $locRow = $locQuery->row();

echo $locRow->location_name;	
*/
}

 ?></th>
<th>Date</th>
<th><?php echo $fetchOrderHdr->order_date; ?></th>
</tr>
</tbody>
</table>
</div>

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Quantity</th>
</tr>
<?php 
	
	$orderdtlquert=$this->db->query("select * from tbl_order_dtl_seel where order_id_seel='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  


$stockQuery = $this -> db
           -> select('*')
           -> where('Product_id_seel',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock_seelampur');
		  $stock_list = $stockQuery->row();

$catQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->category_id)
           -> get('tbl_prodcatg_mst');
		  $category_list = $catQuery->row();

 $sizeval=$fetch_list_orderdtl->size_name;
 $qtyyval=$fetch_list_orderdtl->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
?>
<tr>
<td><?php echo  $stock_list->productname; ?></td>
<td><?php echo  $category_list->prodcatg_name; ?></td>
<td style="width: 200px;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><strong>Size</strong></th>
<?php for($i=1;$i<$sizecount;$i++){ ?>
<th style="text-align:center"><?php echo $sizearr[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php for($j=1;$j<$sizecount;$j++){ ?>
<th style="text-align:center"><?php echo $qtyarr[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</td>
<td><?php echo  $fetch_list_orderdtl->total_qty; ?></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

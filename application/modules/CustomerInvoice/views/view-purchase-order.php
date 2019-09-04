<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">View</h4>
      </div>
      <div class="modal-body">	  
	  <div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<?php
   $orderhdrquert=$this->db->query("select * from tbl_order_hdr where order_id='$ID'");
	$fetchOrderHdr=$orderhdrquert->row();
?>
<tr class="gradeA">
<th>Store Name</th>
<th><?php 

if($fetchOrderHdr->customer_id!=''){
		
		$contactQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetchOrderHdr->customer_id)
           -> get('tbl_contact_m');
		  $contactRow = $contactQuery->row();

echo $contactRow->first_name;

		
}else{

	$locQuery = $this -> db
           -> select('*')
           -> where('id',$fetchOrderHdr->store_id)
           -> get('tbl_location');
		  $locRow = $locQuery->row();

echo $locRow->location_name;	
}

 ?></th>
<th>Date</th>
<th><?php echo $fetchOrderHdr->order_date; ?></th>
</tr>
</tbody>
</table>
</div>
<h6>&nbsp;</h6>
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Item Name</th>
<th>Description</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Quantity</th>
</tr>
<?php 
	
	$orderdtlquert=$this->db->query("select * from tbl_order_dtl where order_id='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  


$stockQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
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
<td><?php echo  $stock_list->productname; ?>

<br />
<?php  $taxoncount=sizeof(explode(',', $fetch_list_orderdtl->category_type)); 
			$taxexp=explode(',', $fetch_list_orderdtl->category_type);
			
		for($it=0;$it<$taxoncount;$it++){
		  $taxid=$taxexp[$it];
		
		$taxonQuery=$this->db->query("select * from tbl_product_stock where Product_id='$taxid'");
		$taxonnamelist=$taxonQuery->row();
		
?>
	
	<p style="padding: 0px 0px 0px 66px; margin: 0em 0em 0em;"><?php echo  $taxonnamelist->productname; ?></p>
<?php } ?>
</td>
<td style="width: 150px;"><?php echo  $fetch_list_orderdtl->desc_name; ?></td>
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
<td style="width: 200px;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td style="text-align:center;width:60px;" class="qty-size"><strong>Total Qty</strong></td>
<td style="text-align:center"><?php echo $fetch_list_orderdtl->total_qty; ?></td>
</tr>
</tbody>
</table>
</div>
</td>
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

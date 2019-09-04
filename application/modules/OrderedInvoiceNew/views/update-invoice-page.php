<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Add Invoice</h4>
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
<th>Type</th>
<th><?php 

if($fetchOrderHdr->customer_id!=''){
		
?>
<input type="hidden" name="Customer_id" value="<?php echo $fetchOrderHdr->customer_id; ?>" />
<?php
		$contactQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetchOrderHdr->customer_id)
           -> get('tbl_contact_m');
		  $contactRow = $contactQuery->row();

echo $contactRow->first_name;

		
}else{
?>
<input type="hidden" name="location_id" value="<?php echo $fetchOrderHdr->store_id; ?>" />
<?php
	$locQuery = $this -> db
           -> select('*')
           -> where('id',$fetchOrderHdr->store_id)
           -> get('tbl_location');
		  $locRow = $locQuery->row();

echo $locRow->location_name;	
}

 ?></th>
<th>Date</th>
<input type="hidden" name="order_idd" value="<?php echo $ID; ?>" />
<th><input type="date" name="order_date" class="form-control" value="<?php echo $fetchOrderHdr->order_date; ?>" /></th>
</tr>
</tbody>
</table>
</div>

<div class="table-responsive2">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Check</th>
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Quantity</th>
<th>&nbsp;</th>
</tr>
<?php 
				$rowi=1;
	$orderdtlquert=$this->db->query("select * from tbl_order_dtl where order_id='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  

?>
<tr>
<td><input type="checkbox" id="myCheck<?php  echo $rowi; ?>" name="myCheck[]" onclick="myCheckFunction('<?php  echo $rowi; ?>')"></td>
<td>
<input type="hidden" name="item_id[]" value="<?php echo $fetch_list_orderdtl->item_id; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;
?>

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
<td style="width:450px;">
<div class="table-responsive2" style="width:500px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><div class="qty-size"><strong>Size</strong></div></th>
<input type="hidden" name="size_val[]" value="<?php echo $fetch_list_orderdtl->size_name; ?>" />
<?php 
 $sizeval=$fetch_list_orderdtl->size_name;
 $qtyyval=$fetch_list_orderdtl->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
?>
<input type="hidden" id="countsizeid<?php echo $rowi;?>" value="<?php echo $sizecount; ?>" />
<input type="hidden" name="cutmrandlocname" value="<?php echo $cutmrandlocid; ?>" />
<?php for($k=1;$k<$sizecount;$k++){ ?>
<th style="text-align:center"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>

<tr class="gradeX">
<td><strong>Ordered Qty</strong></td>
<?php
 for($cj=1;$cj<$sizecount;$cj++){
 ?>
<input type="hidden" value="<?php echo $qtyarr[$cj]; ?>" id="checkorderedqtyidd<?php echo $cj; ?><?php  echo $rowi; ?>" class="form-control" />
<th style="text-align:center"><?php echo $qtyarr[$cj]; ?></th>
<?php } ?>	

</tr>

<tr class="gradeX">
<td><strong>Enter Qty</strong></td>

<?php
$out = array();
$orout = array();
 for($j=1;$j<$sizecount;$j++){
   array_push($out, 0);
   array_push($orout, $qtyarr[$j]);
 ?>

<th style="text-align:center"><input type="number" value="0" style="width:80px;" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" class="form-control" onkeyup="orderedqtyfun(this.id,'<?php  echo $rowi; ?>')" /></th>
<?php } $qtyvl=implode(',', $out); $orqtyvl=implode(',', $orout); ?>	
<input type="hidden" id="orqtyid<?php echo $rowi;?>" name="qty_val[]" value="<?php echo $qtyvl; ?>" />
<input type="hidden" name="ordered_qty_val[]" value="<?php echo $orqtyvl; ?>" />					
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
<td style="text-align:center" class="qty-size"><strong>Total Qty</strong></td>
<td style="text-align:center"><?php echo $fetch_list_orderdtl->total_qty; ?></td>
</tr>
<tr class="gradeX">
<td style="text-align:center" class="qty-size"><strong>Entered Qty</strong></td>
<th style="text-align:center"><input type="text" name="total_qty[]" id="totalorid<?php echo $rowi; ?>" class="form-control" value="0" readonly />
<input type="hidden" name="ordered_total_qty[]" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
</th>
</tr>
</tbody>
</table>
</div>
</td>
<?php
		$sqlpricemapping=$this->db->query("select * from tbl_product_stock where Product_id='$fetch_list_orderdtl->item_id'");
							
		$fetchpricemapping=$sqlpricemapping->row();
			
		$multprice=$fetchpricemapping->item_price*$fetch_list_orderdtl->total_qty; 
?>

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
<td style="text-align:center" class="qty-size"><strong>Total Price</strong></td>
<td style="text-align:center"><?php echo $multprice; ?></td>
</tr>
<tr class="gradeX">
<td style="text-align:center" class="qty-size"><strong>Entered Price</strong></td>
<th style="text-align:center"><input type="hidden" id="priceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo  $fetchpricemapping->item_price; ?>" readonly />
<input type="text" name="total_price[]" id="finalpriceorid<?php echo $rowi; ?>" class="form-control" value="0" readonly /></th>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<?php $rowi++; } ?>
<input type="hidden" name="rows" id="rowsid" class="form-control" value="<?php echo $rowi; ?>"  />
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Update Invoice</h4>
      </div>
      <div class="modal-body">	  
	  <div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<?php
   $orderhdrquert=$this->db->query("select * from tbl_ordered_invoice_hdr where ordered_invoiceid='$ID'");
	$fetchOrderHdr=$orderhdrquert->row();
?>
<tr class="gradeA">
<?php 
if($fetchOrderHdr->customer_id!='0'){		
?>
<th>Customer Name</th>
<?php }else{ ?>
<th>Store</th>
<?php } ?>
<th><?php 

if($fetchOrderHdr->customer_id!='0'){
		
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
<input type="hidden" name="invoiceid" value="<?php echo $ID; ?>" />
<th><?php echo $fetchOrderHdr->invoice_date; ?></th>
</tr>
</tbody>
</table>
</div>

<div class="table-responsive2">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th style="display:none">Check</th>
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Qty</th>
<th>Price</th>
<th>Total Price</th>
</tr>
<?php 
				$rowi=1;
	$orderdtlquert=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  

?>
<tr>
<th style="display:none">
<?php if($fetch_list_orderdtl->ordered_total_qty==$fetch_list_orderdtl->total_qty){  }else{ ?>
<input type="checkbox" id="myCheck<?php  echo $rowi; ?>" name="myCheck[]" onclick="myCheckFunction('<?php  echo $rowi; ?>')"></th>
<?php } ?>
<th>
<input type="hidden" name="order_idd[]" value="<?php echo $fetch_list_orderdtl->ordered_invoiceid_dtl; ?>" />
<input type="hidden" name="item_id[]" value="<?php echo $fetch_list_orderdtl->item_id; ?>" />

<input type="hidden" name="sub_item_id[]" value="<?php echo $fetch_list_orderdtl->sub_item_id; ?>" />

<input type="hidden" name="category_type[]" value="<?php echo $fetch_list_orderdtl->category_type; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?>
</th>

<th>
<input type="hidden" name="category_id[]" value="<?php echo $fetch_list_orderdtl->category_id; ?>" />
<?php
$compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->category_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;		

?></th>
<td style="width:450px;">
<div class="table-responsive2" style="width:500px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><div class="qty-size"><strong>Size</strong></div></th>
<input type="hidden" name="size_val[]" value="<?php echo $fetch_list_orderdtl->size_val; ?>" />
<?php 
 $sizeval=$fetch_list_orderdtl->size_val;
 $qtyyval=$fetch_list_orderdtl->qty_val;
 $orderedqtyval=$fetch_list_orderdtl->ordered_qty_val;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(',', $qtyyval);
	$oredqtyarr=explode(' | ', $orderedqtyval);
?>
<input type="hidden" id="countsizeid<?php echo $rowi;?>" value="<?php echo $sizecount; ?>" />
<input type="hidden" name="cutmrandlocname" value="<?php echo $cutmrandlocid; ?>" />
<?php for($k=1;$k<$sizecount;$k++){ ?>
<th style="text-align:center"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>

<tr class="gradeX" style="display:none">
<td><strong>Ord Qty</strong></td>
<?php
 for($cj=1;$cj<$sizecount;$cj++){
 		$orcj=$cj;
		if($oredqtyarr[$orcj]==$qtyarr[$orcj]){
			$subvalqty=$oredqtyarr[$orcj];
		}else{
	 		
			$subvalqty=$oredqtyarr[$orcj]-$qtyarr[$orcj-1];
		}
 ?>
<input type="hidden" value="<?php echo $oredqtyarr[$orcj]; ?>" id="checkorderedqtyidd<?php echo $cj; ?><?php  echo $rowi; ?>" class="form-control" />
<th style="text-align:center"><?php echo $oredqtyarr[$orcj]; ?></th>
<?php } ?>	

</tr>

<tr class="gradeX">
<td><strong>Ent Qty</strong></td>

<?php
$out = array();
 for($j=1;$j<$sizecount;$j++){
 
 $enj=$j;
   array_push($out, $qtyarr[$enj-1]);
   
 ?>
		
<?php
$subvalqtyent=$qtyarr[$enj-1];

?>
<th style="text-align:center; width:100px;">
<input type="text" name="qty_valord[][]" value="<?php echo $subvalqtyent; ?>" style="text-align:center" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" class="form-control" onkeyup="editandupdateorderedqtyfun(this.id,'<?php  echo $rowi; ?>')" />
<input type="hidden" id="validorqtyid<?php echo $j; ?><?php  echo $rowi; ?>" name="" value="<?php echo  $qtyarr[$enj-1]; ?>" />	
</th>
<?php } $qtyvl=implode(',', $out); ?>	
<input type="hidden" id="orqtyid<?php echo $rowi;?>" name="qty_val[]" value="<?php echo $qtyvl; ?>" />	
<input type="hidden" name="ordered_qty_val[]" value="<?php echo $fetch_list_orderdtl->ordered_qty_val; ?>" />
<input type="hidden" name="ordered_total_qty[]" class="form-control" value="<?php echo $fetch_list_orderdtl->ordered_total_qty; ?>" readonly />									
</tr>
</tbody>
</table>
</div>
</td>
<td style="width:10px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX" style="display:none">
<td style="text-align:center"><?php echo $fetch_list_orderdtl->ordered_total_qty; ?></td>
</tr>
<tr class="gradeX">
<th style="text-align:center">
<?php if($fetch_list_orderdtl->ordered_total_qty==$fetch_list_orderdtl->total_qty){ ?> 
<input type="hidden" name="total_qty[]" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<?php echo $fetch_list_orderdtl->total_qty;  }else{ ?>
<input type="text" name="total_qty[]" id="totalorid<?php echo $rowi; ?>" class="form-control" style="width:60px; text-align:center;" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<input type="hidden" name="" id="totaloridtwo<?php echo $rowi; ?>" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<?php } ?>
</th>
</tr>
</tbody>
</table>
</div>
</td>
<?php

		$totalqmultprice=$fetch_list_orderdtl->one_item_price*$fetch_list_orderdtl->ordered_total_qty; 
		$multprice=$fetch_list_orderdtl->one_item_price*$fetch_list_orderdtl->total_qty; 

?>
<th><?php echo $fetch_list_orderdtl->one_item_price; ?></th>
<td style="width:10px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>&nbsp;</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX" style="display:none">
<td style="text-align:center"><?php echo $totalqmultprice; ?></td>
</tr>
<tr class="gradeX">
<th style="text-align:center"><input type="hidden" name="priceoneitemname[]" id="priceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo  $fetch_list_orderdtl->one_item_price; ?>" readonly />
<input type="text" name="total_price[]" id="finalpriceorid<?php echo $rowi; ?>" class="form-control" style="width:90px; text-align:center;" value="<?php echo $fetch_list_orderdtl->total_price; ?>" readonly /></th>
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
<input type="submit" class="btn btn-sm"  id="sv1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

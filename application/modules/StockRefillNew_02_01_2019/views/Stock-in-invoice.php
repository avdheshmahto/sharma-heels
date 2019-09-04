<?
 $ID=$_GET['ID'];
?>
<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Stock In</h4>
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
<th>Type</th>
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
<input type="hidden" name="orderid" value="<?php echo $fetchOrderHdr->order_id; ?>" />
<th>
<?php echo $fetchOrderHdr->invoice_date; ?>
<input type="hidden" name="order_date" class="form-control" value="<?php echo $fetchOrderHdr->invoice_date; ?>" readonly /></th>
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
<th>Total Quantity</th>
</tr>
<?php 
				$rowi=1;
	$orderdtlquert=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  

?>
<tr>
<td style="display:none">
<?php if($fetch_list_orderdtl->ordered_qty_val==$fetch_list_orderdtl->qty_val){  }else{ ?>
<input type="checkbox" id="myCheck<?php  echo $rowi; ?>" name="myCheck[]" onclick="myCheckFunction('<?php  echo $rowi; ?>')"></td>
<?php } ?>
<td>
<input type="hidden" name="order_idd[]" value="<?php echo $fetch_list_orderdtl->ordered_invoiceid_dtl; ?>" />
<input type="hidden" name="item_id[]" value="<?php echo $fetch_list_orderdtl->item_id; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?>
<input type="hidden" name="productname[]" value="<?php echo $ItemRow->productname; ?>" />
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

<tr class="gradeX">
<td><strong>Ordered Qty</strong></td>
<?php
 for($cj=1;$cj<$sizecount;$cj++){
 		$orcj=$cj-1;
		if($oredqtyarr[$orcj]==$qtyarr[$orcj]){
			$subvalqty=$oredqtyarr[$orcj];
		}else{
	 		
			$subvalqty=$oredqtyarr[$orcj]-$qtyarr[$orcj];
		}
 ?>
<input type="hidden" value="<?php echo $subvalqty; ?>" id="checkorderedqtyidd<?php echo $cj; ?><?php  echo $rowi; ?>" class="form-control" />
<th style="text-align:center"><?php echo $oredqtyarr[$cj]; ?></th>
<?php } ?>	

</tr>

<tr class="gradeX">
<td><strong>Enter Qty</strong></td>

<?php
$out = array();
 for($j=1;$j<$sizecount;$j++){
 
 $enj=$j-1;
   array_push($out, $qtyarr[$enj]);
   
 ?>

<?php 

if($oredqtyarr[$j]==$qtyarr[$enj]){
?>
<th style="text-align:center">

<?php echo $oredqtyarr[$j];?>
<input type="hidden" value="<?php echo $oredqtyarr[$j]; ?>" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" class="form-control" onkeyup="orderedqtyfun(this.id,'<?php  echo $rowi; ?>')" />
<input type="hidden" id="validorqtyid<?php echo $j; ?><?php  echo $rowi; ?>" name="" value="<?php echo  $oredqtyarr[$enj]; ?>" />	
</th>		
<?php }else{ 
$subvalqtyent=$oredqtyarr[$enj]-$qtyarr[$enj];
?>
<th style="text-align:center; width:100px;">
<input type="hidden" value="<?php echo $subvalqtyent; ?>" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" class="form-control" onkeyup="orderedqtyfun(this.id,'<?php  echo $rowi; ?>')" />
<input type="hidden" id="validorqtyid<?php echo $j; ?><?php  echo $rowi; ?>" name="" value="<?php echo  $qtyarr[$enj]; ?>" />	
</th>
<?php } ?>
<?php } $qtyvl=implode(',', $out); ?>	
<input type="hidden" id="orqtyid<?php echo $rowi;?>" name="qty_val[]" value="<?php echo $qtyvl; ?>" />	
<input type="hidden" name="ordered_qty_val[]" value="<?php echo $fetch_list_orderdtl->ordered_qty_val; ?>" />
<input type="hidden" name="ordered_total_qty[]" class="form-control" value="<?php echo $fetch_list_orderdtl->ordered_total_qty; ?>" readonly />									
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
<td style="text-align:center"><?php echo $fetch_list_orderdtl->ordered_total_qty; ?></td>
</tr>
<tr class="gradeX">
<td style="text-align:center" class="qty-size"><strong>Entered Qty</strong></td>
<th style="text-align:center">
<?php if($fetch_list_orderdtl->ordered_qty_val==$fetch_list_orderdtl->qty_val){ ?> 
<input type="hidden" name="total_qty[]" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<?php echo $fetch_list_orderdtl->total_qty;  }else{ ?>
<?php echo $fetch_list_orderdtl->total_qty; ?>
<input type="hidden" name="total_qty[]" id="totalorid<?php echo $rowi; ?>" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<input type="hidden" name="" id="totaloridtwo<?php echo $rowi; ?>" class="form-control" value="<?php echo $fetch_list_orderdtl->total_qty; ?>" readonly />
<?php } ?>
</th>
</tr>
<?php
		$sqlpricemapping=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$fetch_list_orderdtl->item_id'");
							
		$fetchpricemapping=$sqlpricemapping->row();
			
		$multprice=$fetchpricemapping->price*$fetch_list_orderdtl->total_qty; 
?>
<tr class="gradeX" style="display:none">
<td style="text-align:center" class="qty-size"><strong>Total Price</strong></td>
<th style="text-align:center"><input type="hidden" id="priceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo  $fetchpricemapping->price; ?>" readonly />
<input type="text" name="total_price[]" id="finalpriceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo $fetch_list_orderdtl->total_price; ?>" readonly /></th>
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

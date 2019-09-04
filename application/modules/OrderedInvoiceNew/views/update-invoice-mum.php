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
   $orderhdrquert=$this->db->query("select * from tbl_order_hdr_mum where order_id_mum='$ID'");
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
</tr>
<?php 
				$rowi=1;
	$orderdtlquert=$this->db->query("select * from tbl_order_dtl_mum where order_id_mum='$ID'");
		  
	foreach($orderdtlquert->result() as $fetch_list_orderdtl){	  

?>
<tr>
<td><input type="checkbox" id="myCheck<?php  echo $rowi; ?>" name="myCheck[]" onclick="myCheckFunction('<?php  echo $rowi; ?>')"></td>
<td>
<input type="hidden" name="item_id[]" value="<?php echo $fetch_list_orderdtl->item_id; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id_mum',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock_mumbai');
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

<th style="text-align:center"><input type="number" value="0" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" class="form-control" onkeyup="orderedqtyfun(this.id,'<?php  echo $rowi; ?>')" /></th>
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
<?php
		$sqlpricemapping=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$fetch_list_orderdtl->item_id'");
							
		$fetchpricemapping=$sqlpricemapping->row();
			
		$multprice=$fetchpricemapping->price*$fetch_list_orderdtl->total_qty; 
?>
<tr class="gradeX" style="display:none">
<td style="text-align:center" class="qty-size"><strong>Total Price</strong></td>
<th style="text-align:center"><input type="hidden" id="priceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo  $fetchpricemapping->price; ?>" readonly />
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

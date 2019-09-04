<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Invoice</h4>
</div>
<div class="modal-body overflow">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Item Name</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Qty</th>
</tr>
<?php 
 $getidall=$_GET['ID'];
	
$allidarr=explode("~",$getidall);
 $idd=$allidarr[0];
 $cutmrandlocid=$allidarr[1];

			
			$rowi=1;
				
	$sqlorderdtl=$this->db->query("select * from tbl_order_dtl where order_dtl_id='$idd'");
							
		foreach($sqlorderdtl->result() as $fetchordersdtl){
								
?>
<tr class="gradeA">
<th>
<input type="hidden" name="item_id[]" value="<?php echo $fetchordersdtl->item_id; ?>" />
<input type="hidden" name="order_idd[]" value="<?php echo $fetchordersdtl->order_dtl_id; ?>" />
<?php

$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetchordersdtl->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?></th>
<th>
<input type="hidden" name="category_id[]" value="<?php echo $fetchordersdtl->category_id; ?>" />
<?php
$compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetchordersdtl->category_id)
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
<input type="hidden" name="size_val[]" value="<?php echo $fetchordersdtl->size_name; ?>" />
<?php 
 $sizeval=$fetchordersdtl->size_name;
 $qtyyval=$fetchordersdtl->qty_name;

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
$out = array();
 for($j=1;$j<$sizecount;$j++){
   array_push($out, $qtyarr[$j]);
 ?>

<th style="text-align:center"><input type="number" value="<?php echo $qtyarr[$j]; ?>" id="orderedqtyidd<?php echo $j; ?>" class="form-control" onkeyup="orderedqtyfun(this.id,'<?php  echo $rowi; ?>')" /></th>
<?php } $qtyvl=implode(',', $out); ?>	
<input type="hidden" id="orqtyid<?php echo $rowi;?>" name="qty_val[]" value="<?php echo $qtyvl; ?>" />					
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
<th style="text-align:center"><input type="text" name="total_qty[]" id="totalorid<?php echo $rowi; ?>" class="form-control" value="<?php echo $fetchordersdtl->total_qty; ?>" readonly /></th>
</tr>
<?php
		$sqlpricemapping=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$fetchordersdtl->item_id'");
							
		$fetchpricemapping=$sqlpricemapping->row();
			
		$multprice=$fetchpricemapping->price*$fetchordersdtl->total_qty; 
?>
<tr class="gradeX" style="display:none">
<td style="text-align:center" class="qty-size"><strong>Total Price</strong></td>
<th style="text-align:center"><input type="hidden" id="priceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo  $fetchpricemapping->price; ?>" readonly />
<input type="text" name="total_price[]" id="finalpriceorid<?php echo $rowi; ?>" class="form-control" value="<?php echo $multprice; ?>" readonly /></th>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<?php $rowi++; } ?>
<input type="hidden" name="rows" class="form-control" value="<?php echo $rowi; ?>"  />
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

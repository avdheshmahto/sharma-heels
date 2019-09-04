<?
 $ID=$_GET['ID'];
?>


<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<?php
   $orderhdrquert=$this->db->query("select * from tbl_order_hdr where order_id='$ID'");
	$fetchOrderHdr=$orderhdrquert->row();
?>
<tr class="gradeA">
<?php
if($fetchOrderHdr->customer_id!=''){
?>
<th>Customer Name</th>
<?php }else{ ?>
<th>Store Name</th>
<?php } ?>
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
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Item Name</th>
<th>Description</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Quantity</th>
<th>Remarks</th>
<th>Action</th>
</tr>
<?php 

	$rowi=0;
//echo "select * from tbl_order_dtl where order_id='$ID'";
	$orderdtlquert=$this->db->query("select * from tbl_order_dtl where cancel_status='A' and order_id='$ID'");
		  
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
    //echo $qtyyval;
	$sizearr   = explode(' | ', $sizeval);
	$qtyarr    = explode(' | ', $qtyyval);
	//print_r($qtyarr);
?>
<tr>

<input type="hidden" name="" id="countsizeid<?php echo $rowi; ?>" value="<?php echo $sizecount; ?>">

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
<td style="width:150px;"><?php echo  $fetch_list_orderdtl->desc_name; ?></td>
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
<th>
	<input type="text" onkeypress="return /\d/.test(String.fromCharCode(((event||window.event).which||(event||window.event).which)));" class = "enterValClass<?=$rowi;?>" name="arr[<?=$rowi;?>][enterval][<?=$j;?>]" style="width: 50px;text-align:center;" id="orderedqtyidd<?php echo $j; ?><?php  echo $rowi; ?>" onchange="enterqty(this.id,'<?php  echo $rowi; ?>');" onkeyup="enterqty(this.id,'<?php  echo $rowi; ?>')" value="<?php echo $qtyarr[$j]; ?>"></th>
	<input type="hidden" name="arr[<?=$rowi;?>][oldValue][<?=$j;?>]" value="<?php echo $qtyarr[$j];?>"></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</td>
<td>
<input type="hidden" name="arr[<?=$rowi;?>][productId]"  class="form-control"  value="<?php  echo  $fetch_list_orderdtl->item_id; ?>" >	
<input type="hidden" name="arr[<?=$rowi;?>][orderHdrId]"  class="form-control"  value="<?php echo  $ID; ?>" >
<input type="hidden" name="arr[<?=$rowi;?>][orderDtlId]"  class="form-control"  value="<?php echo  $fetch_list_orderdtl->order_dtl_id; ?>" >
<input type="text" name="arr[<?=$rowi;?>][total]" id="totqtyidd_<?=$rowi;?>" class="form-control" style="width: 100px; text-align:center;" value="<?php echo  $fetch_list_orderdtl->total_qty; ?>" readonly></td>
<td>
<textarea  id="rmksid<?php echo $fetch_list_orderdtl->order_dtl_id;?>" class="form-control" style="width: 100px;"></textarea>
</td>
<td>
<button class="btn btn-sm btn-secondary" data-a="<?php echo $fetch_list_orderdtl->order_dtl_id;?>" onclick="ordercancel('<?php echo $fetch_list_orderdtl->order_dtl_id;?>')" href='#updateorder' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-cancel"></i>Item Cancel</button>
</td>
</tr>
<?php  $rowi++; } ?>
</tbody>
</table>
</div>



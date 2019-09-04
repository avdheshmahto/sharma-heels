<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">View Invoice</h4>
</div>
<div class="modal-body overflow">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" >
<thead>
<tr>
		<th>Date</th>
	   <th>Invoice No.</th>
	   <th>Customer Name</th>
	   <th>Product Name</th>		
	   <th>Description</th>       
       <th>Category</th>
       <th>Size / Qty</th>
       <th>Total Qty</th>
       <th>Price</th>
       <th>Total Price</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php  
$i=1;
$sqlorder=$this->db->query("select * from tbl_ordered_invoice_dtl where status='A' and ordered_invoiceid='$ID'");
	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid_dtl; ?>">
<th><?php echo $fetch_list->maker_date;?></th>
<th><?php 
$nextyear=date("y");
$ss=$fetch_list->ordered_invoiceid;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<th><?php
		
$customerQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list->customer_id)
           -> get('tbl_contact_m');
		  $custRow = $customerQuery->row();

echo $custRow->first_name;

?></th>
<th>
<?php	
$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?>
</th>
<th><?php echo $fetch_list->description; ?></th>
<th>
<?php 
$sqlQrycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$fetch_list->category_id'");
$qryCateFetch=$sqlQrycate->row();
echo $qryCateFetch->prodcatg_name;?>
</th>

<th style="width:285px;">
<div class="table-responsive2" style="width:300px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  
$countsizesub=sizeof(explode(' | ', $fetch_list->size_val));
$expsize=explode(' | ', $fetch_list->size_val);
$countsize=$countsizesub-1;
for($i=1;$i<=$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php
$expweight=explode(',', $fetch_list->qty_val);
for($j=0;$j<$countsize;$j++){
 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>

<th><?php echo $fetch_list->total_qty; ?></th>
<th><?php echo $fetch_list->one_item_price; ?></th>
<th><?php echo $fetch_list->total_price; ?></th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

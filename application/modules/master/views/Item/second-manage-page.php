<table class="table table-striped table-bordered table-hover" id="userTbl">
<thead>
<tr>

        <th>Product Name</th>
		<th>Category</th>
    <th>StockPoint</th>
		<th>Usages Unit</th>
		<th>Price</th>
        <th style="width:200px!important;">Size/Weight</th>
		  <th>Image</th>
		 <th>Action</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php  
$i=1;
$nquery=$this->db->query("select * from `tbl_product_stock` ORDER BY Product_id DESC limit 10");
  foreach($nquery->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id; ?>">
<th style="display:none"><input type="checkbox"  /></th>
<th><?=$fetch_list->productname;?></th>
<th>
<?php 
 $compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list->category)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;
?>

 </th>
 <th>
<?php 
//echo $fetch_list->stockpid.'dsd';
 $stQuery = $this -> db
           -> select('*')
           -> where('stockpid',$fetch_list->stockpid)
           -> get('tbl_stockpoint_and_vendor');
      $stRow = $stQuery->row();

echo $stRow->stockpointname;
?>

 </th>
<th><?php
$compQuery1 = $this -> db
           -> select('*')
           -> where('serial_number',$fetch_list->usageunit)
           -> get('tbl_master_data');
		  $keyvalue1 = $compQuery1->row();
echo $keyvalue1->keyvalue;		  

?></th>
<th><?=$fetch_list->price_range;?></th>
<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

$countsize=sizeof(explode(' ', $fetch_list->size));
$expsize=explode(' ', $fetch_list->size);

for($i=0;$i<$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Weight</strong></td>
<?php
$expweight=explode(' ', $fetch_list->weight_name);
for($j=0;$j<$countsize;$j++){

 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php if($fetch_list->product_image!=''){?><img src="<?php echo base_url().'assets/image_data/'.$fetch_list->product_image;?>" height="38" width="50" /> <?php } else {?><img src="<?php echo base_url()?>assets/images/no_image.png" height="38" width="50" /><?php }?> </th>
<th class="bs-example">
<!--
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i;?>" data-backdrop='static' data-keyboard='false'> <i class="fa fa-eye"></i> </button>-->

<button class="btn btn-default modalEditItem" data-a="<?php echo $fetch_list->Product_id;?>" href='#editItem' onclick="EditcontactPriceLoc('<?php echo $fetch_list->Product_id;?>')" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="icon-pencil"></i></button>

<?php 
$pri_col='Product_id';
$table_name='tbl_product_stock';

$pserial=$this->db->query("select * from tbl_product_serial where product_id='$fetch_list->Product_id'");
$pcount=$pserial->num_rows();

$ordrdtl=$this->db->query("select * from tbl_order_dtl where item_id='$fetch_list->Product_id'");
$ordrcount=$ordrdtl->num_rows();

$maping=$this->db->query("select * from tbl_contact_product_price_mapping where product_id='$fetch_list->Product_id'");
$mapingcount=$maping->num_rows();

$invdtl=$this->db->query("select * from tbl_ordered_invoice_dtl where item_id='$fetch_list->Product_id'");
$invcount=$invdtl->num_rows();

//echo $invcount;

$idddds = $pcount + $ordrcount + $mapingcount + $invcount;
//echo $idddds;

if($idddds=='0')
{
?>
<!--<button class="btn btn-default delbutton" id="<?php echo $fetch_list->Product_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>			-->
<?php } ?>

</th>
</tr>
<!-- /.modal -->
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
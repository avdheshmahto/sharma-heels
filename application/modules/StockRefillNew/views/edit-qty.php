<div class="modal-content">	
      <div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php 
			$ID=$_GET['ID'];
		?>
        <h4 class="modal-title">Update Qty</h4>
      </div>
      <div class="modal-body">	  

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example">
<tr>
<th>Item Name</th>
<th>Category Name</th>
<th>Size/Qty</th>
<th>Total Qty</th>
</tr>
<input type="hidden"  name="updateid" id="updateid" class="form-control" value="<?php echo $ID;?>" />
 
 <tr>
<?php 

$productQprice=$this->db->query("select * from tbl_product_stock_log where p_logid='$ID'");
$fetchlistPrice=$productQprice->row();


$productserial=$this->db->query("select * from tbl_product_serial where serial_number='$fetchlistPrice->serial_number'");
$fetchlistserialqty=$productserial->row();

$ItemQuerypro=$this->db->query("select * from tbl_product_stock where Product_id='$fetchlistPrice->product_id'");
         $fetch_listpro=$ItemQuerypro->row();


$ItemQuery11=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$fetchlistPrice->category'");
         $fetch_list11=$ItemQuery11->row();?>

<input type="hidden"  name="proid" id="proid" class="form-control" value="<?php echo $fetchlistPrice->product_id;?>" />
<th><?php echo $fetch_listpro->productname;?></th>
<th><?php echo $fetch_list11->prodcatg_name;?></th>
<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  
//echo $fetch_listpro->size;
 $countsizesub=sizeof(explode(' ', $fetch_listpro->size));
$expsize=explode(' ', $fetch_listpro->size);
$countsize=$countsizesub-1;
$sizearry = array();
for($i=0;$i<=$countsize;$i++){

   array_push($sizearry,  $expsize[$i]);
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } 

 $implodesizedata=implode(' | ', $sizearry);

 $var_implode_size=" | ".$implodesizedata;
?>
</tr>
<input type="hidden" id="sizedata" value="<?php echo $var_implode_size; ?>">
<input type="hidden" id="sizerow" class="form-control" value="<?php echo $countsize;?>" />
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Edit Qty</strong></td>
<?php
$sumtotqty='';
$expweight=explode(' ', $fetchlistPrice->quantity);

$expserialweight=explode(' ', $fetchlistserialqty->quantity);

for($j=0;$j<=$countsize;$j++){
  $m=$j+1;
 $sumtotqty +=$expweight[$m];
 //echo $expweight[$j];
 ?>
 <input type="hidden" style="width: 50px;" id="entqtyviewid<?php echo $j; ?>" value="<?php echo $expweight[$m]; ?>">

<input type="hidden" id="entserialids<?php echo $j; ?>" value="<?php echo $expserialweight[$j]; ?>" />

<th style="text-align:center"><input type="text" style="width: 50px;" id="entqtyid<?php echo $j; ?>" onkeyup="entedqtyfun();newentedqtyfun()" value="<?php echo $expweight[$m]; ?>"></th>
<?php } ?>
</tr>
<!-- ====================================================== new ent qtys ============================ -->
<tr class="gradeX">
<td><strong>New Qty</strong></td>
<?php

for($n=0;$n<=$countsize;$n++){

 ?>
 
<th style="text-align:center"><input type="text" style="width: 50px;" id="new_ent_qtyid<?php echo $n; ?>" onkeyup="newentedqtyfun()" value=""></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<!-- <th><input type="text" id="totid" value="<?php echo $sumtotqty;?>" readonly="readonly" /></th>  -->

<td style="width: 100px;">
<div class="table-responsive2">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">

<th><input type="text" id="totid" style="text-align:center" value="<?php echo $sumtotqty;?>" readonly="readonly" /></th>
</tr>
<tr class="gradeX">
<th style="text-align:center"><input type="text" id="new_qty_tot_id" style="text-align:center" value="" readonly="readonly" /></th>
</tr>

</tbody>
</table>
</div>
</td>
</tr>
 <input type="hidden" id="serialids" value="<?php echo $fetchlistPrice->serial_number;?>" /> 
 <input type="hidden" id="serisingalqtyids" value="<?php echo $fetchlistserialqty->quantity;?>" /> 
 <input type="hidden" id="seritotids" value="<?php echo $fetchlistserialqty->total_qty;?>" />
<!--===================================================================================-->
<input type="hidden" id="new_ent_stock_qtys" value="<?php echo $fetchlistserialqty->quantity;?>" /> 
<input type="hidden" id="new_seri_totids" value="<?php echo $fetchlistserialqty->total_qty;?>" /> 
 <!--===================================================================================--> 
</table>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-sm" data-dismiss="modal" onclick="editqtyitemby()">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

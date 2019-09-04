<?
$ID=$_GET['ID'];
?>
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Update Product</h4>
</div>
<div class="modal-body overflow">
<?php
	 $ItemQuery=$this->db->query("select * from tbl_product_stock where Product_id='$ID'");
         $fetch_list=$ItemQuery->row();

?>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Product Name:</label> 
<div class="col-sm-4"> 
<input type="hidden"  id="Product_id" name="Product_id" class="form-control" readonly="" value="<?php echo $fetch_list->Product_id; ?>" />
<input id="item_name" name="item_name"  type="text" value="<?php echo $fetch_list->productname; ?>" class="form-control" required> 
</div> 
<label class="col-sm-2 control-label">*Product Type:</label> 
<div class="col-sm-4"> 
<select id="Product_type" name="Product_type" required class="form-control">
						<option value="">----Select ----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_master_data where param_id='24'");
						foreach($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->serial_number;?>" <?php if($fetch_protype->serial_number==$fetch_list->Product_type){ ?> selected <?php }?>><?php echo $fetch_protype->keyvalue; ?></option>
					<?php } ?>

					</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Category:</label> 
<div class="col-sm-4"> 
<select id="category" name="category" class="form-control ui fluid search dropdown email1">
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id!='121'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"<?php if($fetchgroup->prodcatg_id==$fetch_list->category){?>selected<?php }?>><?php echo $fetchgroup->prodcatg_name ; ?></option>

    <?php } ?></select>
</div> 
<label class="col-sm-2 control-label">*StockPoint:</label> 
<div class="col-sm-4" > 
<input type="hidden" name="stockpid" value="<?php echo $fetch_list->stockpid; ?>">
<select id="unit" name="unit" class="form-control" disabled="disabled">
				<option value="">--Select--</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_stockpoint_and_vendor where type='StockPoint'");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
				<option value="<?php echo $fetchunit->stockpid;?>" <?php if($fetchunit->stockpid==$fetch_list->stockpid){ ?> selected <?php }?>><?php echo $fetchunit->stockpointname; ?></option>
					<?php } ?>
			</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Minimum Reorder Level:</label> 
<div class="col-sm-4" id="regid"> 
<input type="number" id="min_re_order_level" name="min_re_order_level" value="<?php echo $fetch_list->min_re_order_level; ?>" class="form-control">
</div>  
<label class="col-sm-2 control-label">Price</label> 
<div class="col-sm-4"> 
<input type="text" id="price_range" name="price_range" class="form-control" value="<?php echo $fetch_list->price_range; ?>" />
</div> 
</div>

<div class="form-group" style="display: none;"> 
<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4" id="regid"> 
<input type="file" name="image_name" id="fileid" accept="image/*" onChange="GetFileSizeto()" /><?php if($fetch_list->product_image!=''){ ?> <img id="output" src="<?php echo base_url().'assets/image_data/'.$fetch_list->product_image; ?>"  height="38" width="50"/><?php } else { ?><img src="<?php echo base_url()?>assets/images/no_image.png" height="38" width="50" /><?php }?>
<p id="error1" style="display:none">*Image Size Should Not be Greater Than 12 KB</p>
</div> 
</div>
<div class="table-responsive">
<INPUT type="button" value="Add Row" class="btn btn-sm" onclick="rowAddform('dataTableedit')" />

<!-- 	<INPUT type="button" class="btn btn-secondary btn-sm" value="Delete Row" onclick="editDeleteRow('dataTableedit')" /> -->
<h6></h6>	
<table class="table table-striped table-bordered table-hover" id="dataTableedit" >
<tbody>
<tr class="gradeA">
<th>Check</th>
<th >Size</th>
<th >Weight</th>
</tr>
<?php  

$countsize=sizeof(explode(' ', $fetch_list->size));
$expsize=explode(' ', $fetch_list->size);
$expweight=explode(' ', $fetch_list->weight_name);
for($i=0;$i<$countsize;$i++){
		$ri=$i+1;
 ?>
<tr class="gradeA">
<th><input type="checkbox" id="chkbox<?php echo $ri;?>" /></th>

<th><input type="text" id="size<?php echo $ri;?>" name="size[]" style="width:100px;"  class="form-control" value="<?php echo $expsize[$i]; ?>"></th>

<th><input type="number" step="any" style="width:100px;" id="weightname<?php echo $ri;?>" name="weightname[]"   class="form-control" value="<?php echo $expweight[$i]; ?>"></th>

</tr>
<?php } ?>
</tbody>
<input type="hidden" id="sizerow" name="sizerow" style="width:100px;"  class="form-control" value="<?php echo $countsize; ?>">
</table>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
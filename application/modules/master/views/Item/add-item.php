
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Product</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Product Name:</label> 
<div class="col-sm-4"> 
<input id="item_name" name="item_name"  type="text" value="<?php echo $branchFetch->productname; ?>" class="form-control" onkeyup="samepro(this.value);" <?php if($_GET['view']!='') {?> readonly="" <?php }?> > 
<div id="item_msg"></div>
</div> 
<label class="col-sm-2 control-label">*Product Type:</label> 
<div class="col-sm-4"> 
<select id="Product_type" name="Product_type" required class="form-control">
						<option value="">----Select ----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_master_data where param_id=24");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
					<?php } ?>

					</select>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">*Category:</label> 
<div class="col-sm-4"> 
<select id="category" name="category"  class="form-control" required>
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id!='121'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"><?php echo $fetchgroup->prodcatg_name ; ?></option>

    <?php } ?></select>
</div> 
<label class="col-sm-2 control-label">*StockPoint:</label> 
<div class="col-sm-4"> 
		  <select id="stockpid" name="stockpid"  class="form-control" required >
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_stockpoint_and_vendor where type='StockPoint'");
						foreach ($sqlgroup->result() as $fetchgroup){						
					?>					
    <option value="<?php echo $fetchgroup->stockpid; ?>"><?php echo $fetchgroup->stockpointname; ?></option>

    <?php } ?></select>
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Minimum Reorder Level:</label> 
<div class="col-sm-4"> 
<input type="number" id="min_re_order_level" name="min_re_order_level"  step="any" value="<?php echo $branchFetch->min_re_order_level; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" >
</div> 
<label class="col-sm-2 control-label">Price</label> 
<div class="col-sm-4"> 
<input type="number" id="price_range" name="price_range" class="form-control"/>
</div> 
</div>

<div class="form-group" style="display: none;"> 
<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4"> 
<input type="file" name="image_name" id="file" accept="image/*" onChange="GetFileSize()" /><img src="<?php echo base_url()?>assets/images/no_image.png" height="38" width="50" />
<p id="error" style="display:none">*Image Size Should Not be Greater Than 12 KB</p>
</div> 
</div>
<div class="table-responsive">
<INPUT type="button" value="Add Row" class="btn btn-sm" onclick="addRow('dataTable')" />

	<INPUT type="button" class="btn btn-secondary btn-sm" value="Delete Row" onclick="deleteRow('dataTable')" />
<h6></h6>	
<table class="table table-striped table-bordered table-hover" id="dataTable" >
<tbody>
<tr class="gradeA">
<th>Check</th>
<th >Size</th>
<th >Weight</th>
</tr>
<input type="hidden" id="sizerow" name="sizerow" style="width:100px;"  class="form-control" value="1">
<tr class="gradeA">
<th><input type="checkbox" id="chkbox1" /></th>

<th><input type="text" id="size1" name="size[]" style="width:100px;"  class="form-control"></th>

<th><input type="number" step="any" style="width:100px;"   id="weightname1" name="weightname[]"   class="form-control"></th>

</tr>
</tbody>
</table>
</div>	
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-sm">Save</button>
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>

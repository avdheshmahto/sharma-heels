<?php
$this->load->view("header.php");
$tableName='tbl_product_stock';
$location='manage_item';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('Product_id',$_GET['id'])
		   -> or_where('Product_id',$_GET['view'])
           -> get('tbl_product_stock');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		<?php if($_GET['id']!=''){ ?>
		<h1 class="page-title">Update Product Details</h1>
		<?php }elseif($_GET['view']!=''){ ?>
		<h1 class="page-title">View Product Details</h1>
		<?php }else{ ?> 
		<h1 class="page-title">Add Product Details</h1>
		<?php } ?>
		<!-- Breadcrumb -->
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a href="<?=base_url();?>master/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
			<li><a href="<?=base_url();?>master/Item/manage_item">Product Details</a></li> 
			<li class="active"><strong><a href="<?=base_url();?>master/Item/add_item">Add Product</a></strong></li> 
		</ol>
		<?php }?>
		
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">Product Details</h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="insert_item" enctype="multipart/form-data">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Product Code:</label> 
<div class="col-sm-4"> 
	<?php 
					$query=$this->db->query("select * from tbl_product_stock order by Product_id desc");
					$fetchR=$query->row();
					
					$productId=$fetchR->Product_id+1;
	?>
			
<input type="hidden"  name="Product_id" value="<?php echo $branchFetch->Product_id; ?>" />
<input type="text" class="form-control" name="sku_no" value="<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo $branchFetch->sku_no;}else{ echo $productId;} ?>" readonly> 
</div> 
<label class="col-sm-2 control-label">*Product Name:</label> 
<div class="col-sm-4"> 
<input name="item_name"  type="text" value="<?php echo $branchFetch->productname; ?>" class="form-control" <?php if($_GET['view']!='') {?> readonly="" <?php }?> required> 
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Category:</label> 
<div class="col-sm-4"> 
<select name="category" id="contact_id_copy" class="form-control"  required <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?> >
						<option value="">----Select ----</option>
					<?php 
						$sqlgroup=$this->db->query("select * from tbl_prodcatg_mst where main_prodcatg_id='121'");
						foreach ($sqlgroup->result() as $fetchgroup){
						
					?>
					
					
    <option value="<?php echo $fetchgroup->prodcatg_id; ?>"<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchgroup->prodcatg_id==$branchFetch->category){ ?> selected <?php } }?>><?php echo $fetchgroup->prodcatg_name ; ?></option>

    <?php } ?></select>
</div> 
<label class="col-sm-2 control-label">*Unit:</label> 
<div class="col-sm-4" id="regid"> 
<select name="unit" id="contact_id_copy1" class="form-control"  <?php if(@$_GET['view']!=''){ ?> disabled="disabled" <?php }?>>
					<option value="" selected disabled>----Select Unit----</option>
				<?php 
						$sqlunit=$this->db->query("select * from tbl_master_data where param_id=16");
						foreach ($sqlunit->result() as $fetchunit){
						
					?>
				<option value="<?php echo $fetchunit->serial_number;?>" <?php if(@$_GET['id']!='' || @$_GET['view']!=''){ if($fetchunit->serial_number==$branchFetch->usageunit){ ?> selected <?php } }?>><?php echo $fetchunit->keyvalue; ?></option>
					<?php } ?>
			</select>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Piece Per Box:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="pic_per_box" step="any" value="<?php echo $branchFetch->pic_per_box?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 

<label class="col-sm-2 control-label">*Unit Price Sale:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="unitprice_sale" step="any" value="<?php echo $branchFetch->unitprice_sale; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">*Unit Price Purchase:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="unitprice_purchase" step="any" value="<?php echo $branchFetch->unitprice_purchase; ?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
<label class="col-sm-2 control-label">*Mrp:</label> 
<div class="col-sm-4" id="regid"> 
<input type="text" name="mrp" step="any" value="<?php echo $branchFetch->mrp?>" <?php if($_GET['view']!='') {?> readonly="" <?php }?> class="form-control" required>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Image:</label> 
<div class="col-sm-4" id="regid"> 
<input type="file" name="image_name" id="imgInp" /><?php if(@$_GET['id']!='' || @$_GET['view']!=''){ ?> <img id="blah" src="<?php if(@$_GET['id']!='' || @$_GET['view']!=''){ echo base_url().'assets/image_data/'.$row->product_image; }?>" alt="your image" width = "100" height = "100"/><?php } ?>
</div> 
</div>
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!=''){
?>
<input type="submit" class="btn btn-primary" value="Save">
<?php } ?>
<a href="" onclick="popupclose(this.value)"  title="Cancel" class="btn btn-primary"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary" value="Save">
       <a href="<?=base_url();?>master/Item/manage_item" class="btn btn-primary">Cancel</a>

       <?php } ?>

</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");

?>
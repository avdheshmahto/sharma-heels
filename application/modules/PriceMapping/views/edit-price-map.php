<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php 
			$ID=$_GET['ID'];
		?>
        <h4 class="modal-title">Update Price</h4>
      </div>
      <div class="modal-body">	  

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example">
<tr>
<th>Item Name</th>
<th>Category Name</th>
<th>Old Price</th>
<th>Set Price</th>
</tr>
<input type="hidden"  name="updateid" class="form-control" value="<?php echo $ID;?>" />
 
 <tr>
<?php 

$productQprice=$this->db->query("select * from tbl_contact_product_price_mapping where id='$ID'");
$fetchlistPrice=$productQprice->row();

$ItemQuerypro=$this->db->query("select * from tbl_product_stock where Product_id='$fetchlistPrice->product_id'");
         $fetch_listpro=$ItemQuerypro->row();


$ItemQuery11=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$fetchlistPrice->catg_id'");
         $fetch_list11=$ItemQuery11->row();?>

		 
<th><?php echo $fetch_listpro->productname;?></th>
<th><?php echo $fetch_list11->prodcatg_name;?></th>
<th><?php echo $fetchlistPrice->price;?></th>
<th width="250px"> 	
<input type="hidden"  name="contact_id" class="form-control" value="<?php echo $fetchlistPrice->contact_id;?>" />
<input type="hidden"  name="location_name" class="form-control" value="<?php echo $fetchlistPrice->location_name;?>" />

<input type="text"  name="price" class="form-control" value="" />

</th> 
</tr>
 
</table>
</div>
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" data-dismiss="modal1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>

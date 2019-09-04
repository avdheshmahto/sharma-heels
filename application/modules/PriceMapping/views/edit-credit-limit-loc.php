<div class="modal-content">	
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<?php 
			 $exp=explode('^',$_GET['ID']);
			 $custid=$exp[0];
			 $locid=$exp[1];
		?>
        <h4 class="modal-title">Update Credit Limit</h4>
      </div>
      <div class="modal-body">	  

<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example">
<tr>
<th>Customer Name</th>
<th>Old Credit Limit</th>
<th>Set Credit Limit</th>
</tr>
 
 <tr>
<?php 

$productQprice=$this->db->query("select * from tbl_location where id='$custid' and location_code='$locid'");
$fetchlistPrice=$productQprice->row();

?>
		 
<th><?php echo $fetchlistPrice->location_name;?></th>
<th><?php echo $fetchlistPrice->credit_limit;?></th>
<th width="250px"> 	
<input type="hidden"  name="contact_id" class="form-control" value="<?php echo $fetchlistPrice->id;?>" />
<input type="hidden"  name="location_name" class="form-control" value="<?php echo $fetchlistPrice->location_name;?>" />

<input type="number"  name="creditlimit" class="form-control" value="" />

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

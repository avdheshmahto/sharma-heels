<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/master/controllers/ProductCategory.php');
$objj=new ProductCategory();
$CI =& get_instance();

$list='';

$list=$objj->pcategory_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_prodcatg_mst';

?>
	 <!-- Main content -->


<div class="main-content">
<form class="form-horizontal" method="post" action="<?=base_url();?>master/ProductCategory/insert_itemctg">		
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Master</a></li> 
<li class="active"><strong>Add Product</strong></li>
<div class="pull-right">
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0"><i class="fa fa-plus" aria-hidden="true"></i>Add Product Category</button>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Product Category</h4>
</div>
<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Category Name:</label> 
<div class="col-sm-4"> 				

<input type="hidden" name="midd1" value="121">

		
<input type="hidden" name="prodcatg_id" value="" />
<input type="text" class="form-control" name="prodcatg_name" required value="<?php echo $branchFetch->prodcatg_name;?>"> 
</div> 
<?php 
 $ugroup=$this->db->query("SELECT * FROM tbl_prodcatg_mst where prodcatg_id='121'" );
		$ungroup=$ugroup->row();
	
 ?>
<label class="col-sm-2 control-label"><?php $az=0; if(@$ungroup->prodcatg_name!='' or (@$branchFetch->main_prodcatg_id!='1') ){ $az=1; echo "* Under Group:";}?></label> 
<div class="col-sm-4"> 
<input name="undergroup"  type="<?php if($az==1){ echo "text";}else{echo"hidden";} ?>" value="<?php if(@$ungroup->prodcatg_name!='') { echo $ungroup->prodcatg_name;}else{ 

@$ugrou="select * from $tableName where status='A' and prodcatg_id='".$branchFetch->main_prodcatg_id."'"; 
   
$ung = $this->db->query($ugrou);
$row = $ung->row();

echo @$row->prodcatg_name;} ?>" class="form-control" required> 
<input name="mid1" type="hidden"  class="span6" size="22"  aria-required='true'  value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->main_prodcatg_id; }?>"/>
</div> 
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Description:</label> 
<div class="col-sm-4"> 
<textarea class="form-control" name="description"><?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->Description; }?></textarea>
</div>  
</div>

</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" data-dismiss="modal1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--
<a href="#/" class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i>Delete all</a>-->
</div>
</ol>
</form>
<?php
            if($this->session->flashdata('flash_msg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>	
<?php }?>		
			
<div class="row">
				<div class="col-lg-12">
				<div class="panel-body">
				
							<div class="table-responsive">
				<form class="form-horizontal" method="post" action="<?=base_url();?>master/ProductCategory/insert_itemctg">
								<table class="table table-striped table-bordered table-hover dataTables-example" >
									<thead>
										<tr>
	<!--	<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>-->
	   <th>Group Name</th>
		<th style="display:none">Primary</th>
        <th style="display:none">Under Group</th>
		 <th>Action</th>
</tr>
									</thead>
									<tbody>

<?php
$i=1;
	foreach($result as $fetch_list){
?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->prodcatg_id; ?>">
<?php
if($list[$i]['4']!='121')
{
?>
<!--<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->prodcatg_id; ?>" value="<?php echo $fetch_list->prodcatg_id; ?>" /></th>-->
<?php } else { ?>
<!--<th>*</th>-->
<?php } ?>
<th><?=$fetch_list->prodcatg_name;?></th>
<th style="display:none"><?=$list[$i]['2'];?></th>
<th style="display:none"><?=$list[$i]['3'];?></th>
<th>
<div class="bs-example">
<?php
if($fetch_list->prodcatg_id=='121')
{
?>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-0"> <i class="icon-pencil"></i></button>
<?php } else { ?>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="fa fa-eye"></i> </button>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>

	
<?php

if($list[$i]['4']!='121')
{
 if($delete!=''){
$pri_col='prodcatg_id';
$table_name='tbl_prodcatg_mst';
	?>
	<button class="btn btn-default delbutton" id="<?=$fetch_list->prodcatg_id."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
	<?php }} 
	
	}
	?>
</div>
</th>
</tr>


<div id="modal-<?php echo $i;?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Product Category</h4>
</div>
<div class="modal-body overflow">

<div class="form-group form-group-to"> 
<label class="col-sm-2 control-label">*Category Name:</label> 
<div class="col-sm-4"> 				

<input type="hidden" name="midd1" value="121">

		
<input type="hidden" name="prodcatg_id[]" value="<?php echo $fetch_list->prodcatg_id; ?>" />
<input type="text" class="form-control" name="prodcatg_name[]" required value="<?=$fetch_list->prodcatg_name;?>"> 
</div> 
<?php 
 $ugroup=$this->db->query("SELECT * FROM tbl_prodcatg_mst where prodcatg_id='121'" );
		$ungroup=$ugroup->row();
	
 ?>
<label class="col-sm-2 control-label"><?php $az=0; if(@$ungroup->prodcatg_name!='' or (@$fetch_list->main_prodcatg_id!='1') ){ $az=1; echo "* Under Group:";}?></label> 
<div class="col-sm-4"> 
<input name="undergroup[]"  type="<?php if($az==1){ echo "text";}else{echo"hidden";} ?>" value="<?php if(@$ungroup->prodcatg_name!='') { echo $ungroup->prodcatg_name;}else{ 

@$ugrou="select * from $tableName where status='A' and prodcatg_id='".$fetch_list->main_prodcatg_id."'"; 
   
$ung = $this->db->query($ugrou);
$row = $ung->row();

echo @$row->prodcatg_name;} ?>" class="form-control" required> 
<input name="mid1" type="hidden"  class="span6" size="22"  aria-required='true' value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $fetch_list->main_prodcatg_id; }?>"/>
</div> 
</div>
<div class="form-group form-group-to"> 
<label class="col-sm-2 control-label">Description:</label> 
<div class="col-sm-4"> 
<textarea class="form-control" name="description[]"><?php echo $fetch_list->Description; ?></textarea>
</div>  
</div>
<div class="modal-footer">
<input type="submit" class="btn btn-sm" data-dismiss="modal1" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<?php 
$i++;
} ?>



<input type="text" style="display:none;" id="table_name" value="tbl_prodcatg_mst">  
<input type="text" style="display:none;" id="pri_col" value="prodcatg_id">
										
										
										
										
										
</tbody>
</table>
</form>
							</div>
						</div>	
                    
				</div>
			</div>
            </div>

<?php

$this->load->view("footer.php");
?>
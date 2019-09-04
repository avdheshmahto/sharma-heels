<?php
$this->load->view("header.php");
$this->load->view("javascriptPage.php");
require_once(APPPATH.'modules/admin/controllers/enterprise.php');
$objj=new Enterprise();
$CI =& get_instance();

	

$list='';

$list=$objj->enterprice_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_enterprise_mst';

?>
	 <!-- Main content -->
	 <div class="main-content">
		<form class="form-horizontal" method="post" action="insert_enterprise">
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Admin Setup</a></li> 
				<li><a href="#">Enterprise</a></li> 
				<li class="active"><strong><a href="#">Manage Enterprise</a></strong></li> 
			<div class="pull-right">
			<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-01"><i class="fa fa-plus" aria-hidden="true"></i>Add Enterprise</button>
			<div id="modal-01" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Add Enterprise</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Enterprise Code:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="comp_id" value="" />
<input name="code"  type="text" value="" class="form-control" required> 
</div> 

<label class="col-sm-2 control-label">*Enterprise Name:</label> 
<div class="col-sm-4"> 
<input name="comp_name"  type="text" value="" placeholder="placeholder" class="form-control" required> 
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
<a href="#/" class="btn btn-secondary btn-sm delete_all"><i class="fa fa-trash-o"></i>Delete all</a>
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
					<form class="form-horizontal" method="post" action="insert_enterprise">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
 		<th>Company ID</th>
        <th>Enterprise Code</th>
		<th>Enterprise Name</th>
        <th>Action</th>
</tr>
</thead>

<tbody>
<?php
	for($i=0,$j=1;$i<count($list);$i++,$j++)
	{
		$compId= $list[$i]['1'];
		$checkEnterPrice= $obj->enterPriceCheck($compId);
  ?>

<tr class="gradeC record" data-row-id="<?=$list[$i]['1'];?>">
<th>
<?php
if($checkUser= $obj->userCheck($compId)=='1')
		{
		?>
   <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?=$list[$i]['1'];?>" value="<?=$list[$i]['1'];?>" />
    <?php } else{
	?>
	<spam data-id="" title="User Role already created for this User.you can not delete ?"   />*</spam>
	
<?php } ?>
</th> 
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
<th><?=$list[$i]['3'];?></th>
<th>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>
<?php 
	if($checkUser=='1')
	{
	$pri_col='comp_id';
	$table_name='tbl_enterprise_mst';
	?>
	&nbsp;&nbsp;&nbsp;&nbsp;
	<button class="btn btn-default delbutton" id="<?=$list[$i]['1']."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button> 
	<?php
	}
	else
	{?>
		<button class="btn btn-default delbutton" onclick="return confirm('Region already Created for this Enterprice.you can not delete ?');" type="button"><i class="icon-trash"></i></button>
	<?php 
	} 
 ?>

</th>
</tr>
<div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Edit Enterprise</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Enterprise Code:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="comp_id[]" value="<?=$list[$i]['1'];?>" />
<input name="code[]"  type="text" value="<?=$list[$i]['2'];?>" class="form-control" required> 
</div> 

<label class="col-sm-2 control-label">*Enterprise Name:</label> 
<div class="col-sm-4"> 
<input name="comp_name[]"  type="text" value="<?=$list[$i]['3'];?>" placeholder="placeholder" class="form-control" required> 
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
<?php } ?>

<input type="text" style="display:none;" id="table_name" value="tbl_enterprise_mst">  
<input type="text" style="display:none;" id="pri_col" value="comp_id">  
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>
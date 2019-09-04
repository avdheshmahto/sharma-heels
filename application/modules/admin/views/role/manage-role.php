<?php
$this->load->view("header.php");
$this->load->view("javascriptPage.php");
require_once(APPPATH.'modules/admin/controllers/branch.php');
$objj=new Role();
$CI =& get_instance();

$list='';

$list=$objj->role_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_role_mst';

?>
	 <!-- Main content -->
	 <div class="main-content">
			<form class="form-horizontal" method="post" action="insert_role">
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Role</a></li> 
				
				<li class="active"><strong><a href="#">Manage Role</a></strong></li> 
			<div class="pull-right">
			<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-01"><i class="fa fa-plus" aria-hidden="true"></i>Add Role</button>
			<div id="modal-01" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Add Role</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Role Code:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="role_id" value="" />
<input name="code"  type="text" value="" class="form-control" required> 
</div> 

<label class="col-sm-2 control-label">*Role Name:</label> 
<div class="col-sm-4"> 
<input name="role_name"  type="text" value="" placeholder="placeholder" class="form-control" required> 
</div> 
</div>
<div class="form-group" style="display:none"> 
<label class="col-sm-2 control-label">*Role Function:</label> 
<div class="col-sm-4">
<?php
$actionData=explode("-",$branchFetch->action);
$edit=$actionData[0];
$view=$actionData[1];
$add=$actionData[2];
$delete=$actionData[3];

?>
 Edit <input type="checkbox" value="edit" <?php if($edit=='edit') { ?> checked="checked"<?php }?> name="action1" />&nbsp;View <input type="checkbox" name="action2" <?php if($view=='view') { ?> checked="checked"<?php }?> value="view" />&nbsp;Add <input type="checkbox"  <?php if($add=='add') { ?> checked="checked"<?php }?> name="action3" value="add" /> &nbsp;Delete <input type="checkbox"  <?php if($delete=='delete') { ?> checked="checked"<?php }?> name="action4" value="delete" />
</div> 
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4"> 
&nbsp;
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
					<form class="form-horizontal" method="post" action="insert_role">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
 		<th>Role Code</th>
		<th>Role Name</th>
        <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $list[$i]['3']; ?>">
<td> 
    <?php
										$roleid= $list[$i]['3'];

										$checkRole= $obj->roleCheck($roleid);
   if($checkRole=='1')
		{
		?>
   <input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['3']; ?>" value="<?php echo $list[$i]['3'];?>" />
   <?php } else{
	?>
	<spam data-id="" title="Role Function Action already created for this Role.you can not delete ?"   />*</spam>
	
<?php } ?>   
   </td>
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
  
<th>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>
<?php 
if($checkRole=='1')
{
	$pri_col='role_id';
	$table_name='tbl_role_mst';
	?>
	&nbsp;&nbsp;&nbsp;
	<button class="btn btn-default delbutton" id="<?=$list[$i]['3']."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button>
	<?php
	}
	else
	{
	?>
	<button class="btn btn-default" onclick="return confirm('Role Function Action already Created for this Role.you can not delete ?');" type="button"><i class="icon-trash"></i></button>
	<?php } 
?>
</th>
</tr>
<div id="modal-<?php echo $i;?>" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Add Role</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*Role Code:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="role_id[]" value="<?=$list[$i]['3'];?>" />
<input name="code[]"  type="text" value="<?=$list[$i]['1'];?>" class="form-control" required> 
</div> 

<label class="col-sm-2 control-label">*Role Name:</label> 
<div class="col-sm-4"> 
<input name="role_name[]"  type="text" value="<?=$list[$i]['2'];?>" placeholder="placeholder" class="form-control" required> 
</div> 
</div>
<div class="form-group"  style="display:none"> 
<label class="col-sm-2 control-label">*Role Function:</label> 
<div class="col-sm-4">
<?php
$actionData=explode("-",$list[$i]['4']);
$edit=$actionData[0];
$view=$actionData[1];
$add=$actionData[2];
$delete=$actionData[3];
//echo $list[$i]['4']."abc";
?>
 Edit <input type="checkbox" value="edit" <?php if($edit=='edit') { ?> checked="checked"<?php }?> name="action1" />&nbsp;View <input type="checkbox" name="action2" <?php if($view=='view') { ?> checked="checked"<?php }?> value="view" />&nbsp;Add <input type="checkbox"  <?php if($add=='add') { ?> checked="checked"<?php }?> name="action3" value="add" /> &nbsp;Delete <input type="checkbox"  <?php if($delete=='delete') { ?> checked="checked"<?php }?> name="action4" value="delete" />
</div> 
<label class="col-sm-2 control-label">&nbsp;</label> 
<div class="col-sm-4"> 
&nbsp;
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
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_role_mst">  
<input type="text" style="display:none;" id="pri_col" value="role_id">
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
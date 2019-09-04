<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/admin/controllers/mapuser.php');
$objj=new Mapuser();
$CI =& get_instance();

$list='';

$list=$objj->userroll_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_user_role_mst';

?>
	 <!-- Main content -->
	 <div class="main-content">
		<form class="form-horizontal" method="post" action="insert_user_role">
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Admin Setup</a></li> 
				 <li><a href="#">User Role</a></li> 
				<li class="active"><strong><a href="#">Manage User Role</a></strong></li> 
			<div class="pull-right">
			<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-01"><i class="fa fa-plus" aria-hidden="true"></i>Add User Role</button>
			<div id="modal-01" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Add User Role</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*User Name:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="user_role_id" value="" />
<select  placeholder="Enter text" class="form-control" name="user_id" required>

<option value="">--Select--</option>
<?php
 $user=$this->db->query("select * from tbl_user_mst");

foreach ($user->result() as $user_add){
?>
<option value="<?php echo $user_add->user_id;?>" <?php if($user_add->user_id==$branchFetch->user_id){ ?> selected <?php }?>><?php echo $user_add->user_name;?>(<?php echo $user_add->user_id ?>)</option>
<?php }?>
</select> 
</div> 

<label class="col-sm-2 control-label">*Role Name:</label> 
<div class="col-sm-4"> 
<select  placeholder="Enter text" class="form-control" name="role_id" required>

<option value="">--Select--</option>
<?php
$ro= $this->db->query("select * from tbl_role_mst");
	foreach ($ro->result() as $role){
?>
<option value="<?php echo $role->role_id;?>" <?php if($role->role_id==$branchFetch->role_id){ ?> selected <?php }?>><?php echo $role->role_name;?>(<?php echo $role->role_id;?>)</option>
<?php }?>
</select>
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

<a href="<?=base_url();?>admin/mapuser/map_user_role" class="btn btn-secondary btn-sm"><i class="fa fa-home"></i>Dashboard</a>
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
					<form class="form-horizontal" method="post" action="insert_user_role">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th>User Name</th>
		<th>Role Name</th>
        <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record">
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>

<th>
<button class="btn btn-default" type="button" data-toggle="modal" data-target="#modal-<?php echo $i; ?>"> <i class="icon-pencil"></i></button>
<?php
$pri_col='user_role_id';
$table_name='tbl_user_role_mst';
	?>
	<button class="btn btn-default delbutton" id="<?=$list[$i]['3']."^".$table_name."^".$pri_col ; ?>" type="button"><i class="icon-trash"></i></button> 
	
</th>
</tr>
<div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
			<div class="modal-dialog modal-lg">
			<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Edit User Role</h4>
			</div>
			<div class="modal-body overflow">

<div class="form-group"> 
<label class="col-sm-2 control-label">*User Name:</label> 
<div class="col-sm-4"> 				
		
<input type="hidden" name="user_role_id" value="<?php echo $list[$i]['3'];?>" />
<select  placeholder="Enter text" class="form-control" name="user_id" required>

<option value="">--Select--</option>
<?php
 $user=$this->db->query("select * from tbl_user_mst");

foreach ($user->result() as $user_add){
?>
<option value="<?php echo $user_add->user_id;?>" <?php if($user_add->user_name==$list[$i]['1']){ ?> selected <?php }?>><?php echo $user_add->user_name;?>(<?php echo $user_add->user_id ?>)</option>
<?php }?>
</select> 
</div> 

<label class="col-sm-2 control-label">*Role Name:</label> 
<div class="col-sm-4"> 
<select  placeholder="Enter text" class="form-control" name="role_id" required>

<option value="">--Select--</option>
<?php
$ro= $this->db->query("select * from tbl_role_mst");
	foreach ($ro->result() as $role){
?>
<option value="<?php echo $role->role_id;?>" <?php if($role->role_name==$list[$i]['2']){ ?> selected <?php }?>><?php echo $role->role_name;?>(<?php echo $role->role_id;?>)</option>
<?php }?>
</select>
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
<input type="text" style="display:none;" id="table_name" value="tbl_user_role_mst">  
<input type="text" style="display:none;" id="pri_col" value="divn_id">
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
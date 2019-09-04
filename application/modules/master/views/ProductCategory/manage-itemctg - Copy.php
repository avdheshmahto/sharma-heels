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
			
			<!-- Breadcrumb -->
			<ol class="breadcrumb breadcrumb-2"> 
				
				<?php 
				if($add!='')
				{ ?>
				<li><a onClick="openpopup('add_itemctg',1200,500,'mid',121)" class="btn btn-success">Add Product Category</a></li> 
				<?php }?>
			<li>
				<a type="button" class="btn btn-danger delete_all">Delete Selected</a>
			</li>	
			</ol>
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Master</a></li> 
				<li><a href="#">Product Group</a></li> 
				<li class="active"><strong><a href="#">Manage Product Category</a></strong></li> 
			</ol>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Manage Product Category</strong></h4>
							<ul class="panel-tool-options"> 
								
								<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
								
							</ul>
						</div>
						<div class="panel-body">
							<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>
	   <th>Group Name</th>
		<th>Primary</th>
        <th>Under Group</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $list[$i]['4']; ?>">
<?php
if($list[$i]['4']!='121')
{
?>
<th><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['4']; ?>" value="<?php echo $list[$i]['4'];?>" /></th>
<?php } else { ?>
<th>*</th>
<?php } ?>
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
<th><?=$list[$i]['3'];?></th>
<th>
<?php
if($list[$i]['4']=='121')
{
?>
<a href="#" onClick="openpopup('add_itemctg',1200,500,'mid',<?=$list[$i]['4'];?>)"><i class="fa fa-plus-square"></i></a>
<?php } else { ?>
<?php }?>
&nbsp;&nbsp;&nbsp;<a href="#" onClick="openpopup('add_itemctg',1200,500,'id',<?=$list[$i]['4'];?>)"><i class="glyphicon glyphicon-pencil"></i>


<?php

if($list[$i]['4']!='121')
{



 if($delete!=''){
$pri_col='prodcatg_id';
$table_name='tbl_prodcatg_mst';
	?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $list[$i]['4']."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
	<?php }} 
	else {}
	?>
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_prodcatg_mst">  
<input type="text" style="display:none;" id="pri_col" value="prodcatg_id">
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>
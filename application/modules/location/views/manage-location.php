<?php
$this->load->view("header.php");
require_once(APPPATH.'modules/location/controllers/Location.php');
$objj=new Location();
$CI =& get_instance();

$list='';

$list=$objj->location_list();	
require_once(APPPATH.'core/my_controller.php');
$obj=new my_controller();
$CI =& get_instance();
$tableName='tbl_product_stock';

?>
	 <!-- Main content -->
	 <div class="main-content">
			
			<ol class="breadcrumb breadcrumb-2"> 
				 <li> <a type="button" class="btn btn-danger delete_all">Delete Selected</a></li>
				<?php 
				if($add!='')
				{ ?>
				<li><a class="btn btn-success" href="<?=base_url();?>location/Location/addLocation">Add Location</a></li> 
				<?php }?>
				
			</ol>
			
			<ol class="breadcrumb breadcrumb-2"> 
				<li><a href="<?=base_url();?>master/Item/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
				<li><a href="#">Location</a></li> 
				<li class="active"><strong><a href="#">Manage Location</a></strong></li> 
			</ol>
			
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading clearfix">
							<h4 class="panel-title"><strong>Manage Location</strong></h4>
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
	   <th>Location Name</th>
		<th>Branch Name</th>
		 <th>Action</th>
</tr>
</thead>

<tbody>
<?php
  for($i=0,$j=1;$i<count($list);$i++,$j++)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $list[$i]['3']; ?>">
<th>
<?php
										$productId= $list[$i]['3'];

										//$checkProduct= $obj->product_check($productId);
 /*  if($checkProduct=='1')
{
	*/
?><input name="cid[]" type="checkbox" id="cid[]" class="sub_chk" data-id="<?php echo $list[$i]['3']; ?>" value="<?php echo $list[$i]['7'];?>" />
</th>
<th><?=$list[$i]['1'];?></th>
<th><?=$list[$i]['2'];?></th>
<th>
<?php if($view!=''){ ?>
<a href="#" onClick="openpopup('addLocation',1200,500,'view',<?=$list[$i]['3'];?>)"><i class="glyphicon glyphicon-zoom-in"></i></a>&nbsp;&nbsp;&nbsp;
<?php } if($edit!=''){ ?>
<a href="#" onClick="openpopup('addLocation',1200,500,'id',<?=$list[$i]['3'];?>)"><i class="glyphicon glyphicon-pencil"></i>
<?php }
$pri_col='id';
$table_name='tbl_location';
if($delete!=''){ 
if($checkProduct=='1')
{
?>
	&nbsp;&nbsp;&nbsp;<a href="#" id="<?php echo $list[$i]['3']."^".$table_name."^".$pri_col ; ?>" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a> 
<?php
}
else

{
?>
<a href="#" id="<?php echo $list[$i]['3']."^".$table_name."^".$pri_col ; ?>" onclick="return confirm('Invoice already ctrated for this product.you can not delete ?');" class="delbutton icon"><i class="glyphicon glyphicon-remove"></i></a>
<?php

}

 } ?>
</th>
</tr>
<?php } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_location">  
<input type="text" style="display:none;" id="pri_col" value="id">
</table>
</div>
</div>
</div>
</div>
</div>
<?php

$this->load->view("footer.php");
?>
<?php
$this->load->view("header.php");
$tableName='tbl_prodcatg_mst';
$location='manage_itemctg';
		
		$userQuery = $this -> db
           -> select('*')
		   -> where('prodcatg_id',$_GET['id'])
		   -> or_where('prodcatg_id',$_GET['mid'])
           -> get('tbl_prodcatg_mst');
		  $branchFetch = $userQuery->row();

?>
	<!-- Main content -->
	<div class="main-content">
		
		<?php if(@$_GET['popup'] == 'True') {} else {?>
		<ol class="breadcrumb breadcrumb-2"> 
			<li><a class="btn btn-success" href="<?=base_url();?>master/dashboar"><i class="fa fa-home"></i>Dashboard</a></li> 
			<li><a class="btn btn-success" href="<?=base_url();?>master/ProductCategory/manage_itemctg">Manage Product Category </a></li> 
			
		</ol>
		<?php }?>
		
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<?php if($_GET['id']!=''){ ?>
		<h4 class="panel-title"><strong>Update Product Category</strong></h4>
		<?php }elseif($_GET['view']!=''){ ?>
		<h4 class="panel-title"><strong>View Product Category</strong></h4>
		<?php }else{ ?> 
		<h4 class="panel-title"><strong>Add Product Category</strong></h4>
		<?php } ?>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="insert_itemctg">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Category Name:</label> 
<div class="col-sm-4"> 
<?php if($_GET['mid1']==1) { ?>
<input type="hidden" name="midd1" value="<?php  echo $mid=2;?>">
<?php }else { ?>
<input type="hidden" name="mid" value="<?php if(@$_GET['mid']==''){ echo $mid=1;}else{echo $midd=@$_GET['mid'];}?>">
<?php }

if(@$_GET['id']!='' ){
 ?>	
		
<input type="hidden" name="prodcatg_id" value="<?php echo $branchFetch->prodcatg_id; ?>" />
<?php } ?>
<input type="text" class="form-control" name="prodcatg_name" required value="<?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->prodcatg_name;  } ?>"> 
</div> 
<?php if(@$_GET['mid']!='' or (@$branchFetch->main_prodcatg_id!='') ){
 $ugroup=$this->db->query("SELECT * FROM tbl_prodcatg_mst where prodcatg_id='".@$_GET['mid']."'" );
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
<?php } ?>
</div>
<div class="form-group"> 
<label class="col-sm-2 control-label">Description:</label> 
<div class="col-sm-4"> 
<textarea class="form-control" name="description"><?php if(@$_GET['mid']=='' && @$_GET['id']!=''){ echo $branchFetch->Description; }?></textarea>
</div> 

</div>
<div class="form-group">
<div class="col-sm-4 col-sm-offset-2">
<?php if(@$_GET['popup'] == 'True') {
if($_GET['id']!='' || $_GET['mid']!=''){
?>
<input type="submit" class="btn btn-primary" value="Save">
<?php } ?>
<a href="" onclick="popupclose(this.value)"  title="Cancel" class="btn btn-blue"> Cancel</a>

	   	 <?php }else {  ?>
		 
		<input type="submit" class="btn btn-primary" value="Save">
       <a href="<?=base_url();?>master/ProductCategory/manage_itemctg" class="btn btn-blue">Cancel</a>

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
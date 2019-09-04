<?php
$this->load->view("header.php");
?>
	 <!-- Main content -->
	 <div class="main-content">
	 
<form class="form-horizontal" role="form" method="post" action="#" enctype="multipart/form-data">	
	<div class="row">
<div class="col-sm-4">		
<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Master</a></li> 
<li class="active"><strong>Manage Sale Return</strong></li>
</ol>
</div>

<div class="col-sm-6 breadcrumb breadcrumb-2">
<?php
            if($this->session->flashdata('flash_msg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert" style="float:left; width:400px; text-align:center;margin:0 150px 0 0px; font-size:14px; color: #a94442;"><strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>

<?php } ?>
</div>

<div class="col-sm-2">
<div class="table-responsive">
<div class="pull-right">
<a href="<?=base_url();?>SaleReturn/addSaleReturn">
<button type="button" class="btn btn-sm">Add Sale Return</button>
</a>
</div>
<table class="table table-striped table-bordered table-hover">
<tbody>
</tbody>
</table>
</div>        
</div>
</div> 
</ol>
</form>	

			<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="update_item"  enctype="multipart/form-data">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th>Customer Name/Store</th>
		<th>Date</th>
        <th>Product Name</th>
		<th>Category</th>
        <th style="width:200px!important;">Size/Weight</th>
		<th>Total Qty</th>
		<th>Price</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;
$query=$this->db->query("select * from tbl_sale_return_dtl where status='A' order by sale_return_dtl_id desc");
  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php //echo $fetch_list->Product_id; ?>">
<th>
<?php
$cust=$fetch_list->customer_id;
if($cust!=''){
	$custhdr=$this->db->query("select * from tbl_contact_m where contact_id='$cust'");
	$CustQfetch=$custhdr->row();
	echo $CustQfetch->first_name;
}else{
	$Lochdr=$this->db->query("select * from tbl_location where id='$fetch_list->store_id'");
	$LocQfetch=$Lochdr->row();
	echo $LocQfetch->location_name;
}
?>
</th>
<th><?=$fetch_list->return_date;?></th>
<th><?=$fetch_list->productname;?></th>
<th>
<?php 
 $compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list->category_id)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;
?>

 </th>

<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

$countsize=sizeof(explode(' | ', $fetch_list->size_val));
$expsize=explode(' | ', $fetch_list->size_val);

for($i=1;$i<$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php
$expweight=explode(' ', $fetch_list->qty_val);
for($j=1;$j<$countsize;$j++){

 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php echo $fetch_list->total_qty; ?></th>
<th><?php echo $fetch_list->one_item_price; ?></th>
</tr>
<!-- /.modal -->
<?php $i++; } ?>
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
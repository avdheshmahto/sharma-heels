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
		<th>S No.</th>
		<th>Customer Name/Store</th>
		<th>Date</th>
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
<th><?php echo $i; ?></th>
<th>
<?php
$cust=$fetch_list->customer_id;
if($cust!=''){
	$custhdr=$this->db->query("select * from tbl_contact_m where contact_id='$cust'");
	$CustQfetch=$custhdr->row();
?>	
<a href="viewSaleReturn?id=<?php echo $fetch_list->customer_id.'^'.'Customer';?>" target="_blank" ><?php echo $CustQfetch->first_name; ?></a>
<?php
}else{
	$Lochdr=$this->db->query("select * from tbl_location where id='$fetch_list->store_id'");
	$LocQfetch=$Lochdr->row();
?>
<a href="viewSaleReturn?id=<?php echo $fetch_list->store_id.'^'.'Store';?>" target="_blank" ><?php echo $LocQfetch->location_name; ?></a>
<?php	
}
?>
</th>
<th><?=$fetch_list->return_date;?></th>
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
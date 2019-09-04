<?php
$this->load->view("header.php");
?>
	 <!-- Main content -->
	 <div class="main-content">
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Mumbai</a></li> 
<li class="active"><strong>Manage Order</strong></li>
<div class="pull-right">
<a href="<?=base_url();?>salesorder/SalesOrder/addOrderMum">
<button type="button" class="btn btn-sm">Add Order</button>
</a>
</div>
</ol>
</form>	
<?php
            if($this->session->flashdata('flashmsg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flashmsg');?></strong> 
</div>	
<?php }?>
	
			<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
		<th>Order No.</th>
	    <th>Customer Name / Store</th>
        <th>Order Date</th>
        <th>Total Qty</th>
		<th>Status</th>
		<th>Action</th>
</tr>
</thead>

<tbody>
<?php  
$i=1;

$sqlorderReg=$this->db->query("select * from tbl_order_hdr_mum where status='A' ORDER BY order_id_mum DESC");
	
  foreach($sqlorderReg->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->order_id_mum; ?>">
<th><?php
$nextyear=date("y");
$ss=$fetch_list->order_id_mum;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "SPM"."/".$nextyear."/".$numbercase;
 ?></th>

<th>
<?php
		
	if($fetch_list->customer_id!=''){	
$itemQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list->customer_id)
           -> get('tbl_contact_m');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->first_name;
 }else{

$compQuery = $this -> db
           -> select('*')
           -> where('id',$fetch_list->store_id)
           -> get('tbl_location');
		  $compRow = $compQuery->row();

echo $compRow->location_name;		   
 
 }
?></th>
<th>
<?php 
 $orderdtl = $this -> db
           -> select('*')
           -> where('order_id_mum',$fetch_list->order_id_mum)
           -> get('tbl_order_dtl_mum');
		  $orderdtl_list = $orderdtl->row();


echo $fetch_list->order_date;

?>
</th>
<th><?=$orderdtl_list->total_qty;?></th>
<th><?php
echo $fetch_list->invoice_status;
?></th>
<th class="bs-example">

<button class="btn btn-default modalEditcontact" data-a="<?php echo $fetch_list->order_id_mum;?>" href='#editcontact' type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><i class="fa fa-eye"></i></button>
 
</th>
</tr>
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
</div>
</div>
</div>
</div>
</div>
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-contenttt">

        </div>
    </div>	 
</div>
</form>
<script>
    $('.modalEditcontact').click(function(){
        var ID=$(this).attr('data-a');
	    $.ajax({url:"viewOrderMum?ID="+ID,cache:true,success:function(result){
            $(".modal-contenttt").html(result);
        }});
    });
</script>	
<?php

$this->load->view("footer.php");
?>
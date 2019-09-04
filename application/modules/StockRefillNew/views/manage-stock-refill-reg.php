<?php
$this->load->view("header.php");
?>
	 <!-- Main content -->
	 <div class="main-content">
<form class="form-horizontal" role="form" method="post" action="" enctype="multipart/form-data">			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Regarpura</a></li> 
<li class="active"><strong>Manage Stock</strong></li>
<div class="pull-right">
<!--<a href="<?=base_url();?>StockRefillNew/add_multiple_qty">
<button type="button" class="btn btn-sm">Add Quantity</button>
</a>-->
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
	
<!--=================================================================================================================================-->
	
	<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
<form class="form-horizontal" method="post" action="insertStockIn"  enctype="multipart/form-data">											
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th>Order Id</th>
	   <th>Customer Name / Store</th>
        <th>Invoice Date</th>
		<th>Pending Qty</th>
        <th>Completed Qty</th>		
		 <th>Action</th>
</tr>
</thead>

<tbody>

<?php

$i=1;

//$brnhid=$this->session->userdata('brnh_id');

$sqlorder=$this->db->query("select * from tbl_ordered_invoice_hdr where stock_in_status='A' and store_id='1'");
	
	foreach($sqlorder->result() as $fetch_list){
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid; ?>">
<th><?php
$nextyear=date("y");
 $ss=$fetch_list->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
 $numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<th><?php
		
	if($fetch_list->customer_id!='0'){	
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

echo $fetch_list->invoice_date;

$sqlinv=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$fetch_list->ordered_invoiceid'");
			
			$sumqtys=0;
	foreach($sqlinv->result() as $fetch_invoiced){	
			
				$sumqtys +=$fetch_invoiced->total_qty;
				
			}

?>
</th>
<th><?php 
$sqlinvdd=$this->db->query("select * from tbl_ordered_invoice_dtl where ordered_invoiceid='$fetch_list->ordered_invoiceid'");
			
	foreach($sqlinvdd->result() as $fetch_invoicedssd){	
							
					$sizecount=sizeof(explode(' | ',$fetch_invoicedssd->size_val));
					$pending=$fetch_invoicedssd->qty_val;
					$orededqty=$fetch_invoicedssd->ordered_qty_val;
			if($fetch_invoicedssd->ordered_qty_val==$fetch_invoicedssd->qty_val){
					
			}else{
					$orqtyarrrt=0;
				for($ik=1;$ik<=$sizecount;$ik++){
						
						$orqtyarr=explode(',',$orededqty);
					 $orqtyarrrt +=$orqtyarr[$ik];
				}	
			}	
					
			}
		echo $orqtyarrrt;	

?></th>
<th><?php echo $sumqtys; ?></th>
<th class="bs-example">

<button class="btn btn-sm modalEditcontact" href="#editcontact" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false" onclick="updateInvoice('<?php echo $fetch_list->ordered_invoiceid;?>')"><i>Stock In</i></button>			
 
</th>
</tr>

<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_contact_m">  
<input type="text" style="display:none;" id="pri_col" value="contact_id">
</table>
</form>
</div>
</div>
</div>
</div>

<!--=================================================================================================================================-->
	
			<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
	   <th style="width:25%;">Item Name</th>
		<th style="width:25%;">Category</th>
        <th style="width:25%; display:none;">Size / Qty</th>
        <th style="width:25%;">Total Qty</th>
		
</tr>
</thead>

<tbody>
<?php  
$i=1;
   
   $brnhid=$this->session->userdata('brnh_id');


$stockRegQuery=$this->db->query("select * from tbl_product_stock_regarpura where status='A' Order by Product_id_reg desc ");
     
  foreach($stockRegQuery->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->Product_id_reg; ?>">

<th><?php
$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?></th>
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
<th style="display:none">
<div class="table-responsive2" style="width:222px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<?php 
 $sizeval=$fetch_list->size_val;
 $qtyyval=$fetch_list->qty_val;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(',', $qtyyval);
?>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>
<?php for($k=1;$k<$sizecount;$k++){ ?>
<th style="text-align:center;width: 10px;"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Actual Qty</strong></td>
<?php for($j=1;$j<$sizecount;$j++){ $jk=$j-1; ?>

<th style="text-align:center"><?php echo $qtyarr[$jk]; ?></th>
<?php } ?>
</tr>
<tr class="gradeX">
<td><strong>Ordered Qty</strong></td>
<?php
		 
	 $orderqty=$fetch_list->qtyinstock;
	 
	 $orderqtyarr=explode(' ', $orderqty);
			
			$sumorderedqty=0;
 for($j=1;$j<$sizecount;$j++){ $jk=$j-1; 
 				
			$sumorderedqty +=$orderqtyarr[$jk];	
 ?>
						
<th style="text-align:center"><?php echo $orderqtyarr[$jk]; ?></th>
<?php } ?>
</tr>
<tr class="gradeX">
<td><strong>Effective Qty</strong></td>
<?php 
		$sumeffectiveqty=0;
for($ef=1;$ef<$sizecount;$ef++){ $eff=$ef-1; 
  $qtyor=$qtyarr[$eff]-$orderqtyarr[$eff];
  		
		$sumeffectiveqty +=$qtyor;
?>
<th style="text-align:center"><?php echo $qtyor; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php echo $fetch_list->total_qty; ?></th>
<td style="width: 200px; display:none;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td style="text-align:center"><strong>Total Actual Qty</strong></td>

<th style="text-align:center"><?php echo $fetch_list->total_qty; ?></th>
</tr>
<tr class="gradeX">
<td style="text-align:center"><strong>Total  Ordered Qty</strong></td>

<th style="text-align:center"><?php echo $sumorderedqty; ?></th>
</tr>
<tr class="gradeX">
<td style="text-align:center"><strong>Total Effective Qty</strong></td>

<th style="text-align:center"><?php echo $sumeffectiveqty; ?></th>
</tr>
</tbody>
</table>
</div>
</td>
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
<form class="form-horizontal"  id="f1" name="f1" role="form" method="post" action="insertStockIn" enctype="multipart/form-data">			
<div id="editcontact" class="modal fade modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div id="divupdateid">

        </div>
    </div>	 
</div>
</form>
<script>
function updateInvoice(v){

var pro=v;
 var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "updateStockIn?ID="+pro, false);
  xhttp.send();
  document.getElementById("divupdateid").innerHTML = xhttp.responseText;
 } 
</script>
<?php
$this->load->view("footer.php");
?>
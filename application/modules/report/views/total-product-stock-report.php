<?php
$this->load->view("header.php");
?>
	<!-- Main content -->
	<div class="main-content">
	
<?php
$this->load->view("reportheader");
?>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading clearfix">
<h4 class="panel-title">TOTAL PRODUCT STOCK REPORT </h4>
<ul class="panel-tool-options"> 
<li><a data-rel="reload" href="#"><i class="icon-arrows-ccw"></i></a></li>
</ul>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" action="totalsearchStock">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<input type="text" name="p_name" class="form-control" value="" />
</div>
<label class="col-sm-2 control-label">Product Code</label> 
<div class="col-sm-3"> 
<input type="text" name="p_code" class="form-control" value="" /> 
</div>
<label class="col-sm-2 control-label"><button type="submit" name="Show" class="btn btn-info" value="Show">Show</button></label>  
</div>
</form>
</div>

<div class="panel-body">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
 		<th>Serial No.</th>
        <th>Product Name</th>
		<th>Product Code</th>   
		<th>Category</th>
		<th>Unit</th>
		<th>Unit Price Purchase</th>
		<th>Unit Price Sale</th>
		<th>Total Qty</th>
		<th>Purchase Qty</th>
		<th>Sale Qty</th>
		<th>Qty In Stock</th>
</tr>
</thead>
<tbody>
<?php
$yy=1;
if(!empty($totalSearchStock)) {
foreach($totalSearchStock as $rows) {
?>
<tr class="gradeC record">
<th><?php echo $yy++; ?></th>
<th><?php echo $rows->productname; ?></th>
<th><?php echo $rows->sku_no; ?></th>
<th><?php 

	$sql1 = $this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='".$rows->category."' ");
			$sql2 = $sql1->row();
			echo $sql2->prodcatg_name;
			
			//this query for total sum of qty
			$qtySumQuery = $this->db->query("select SUM(quantity) as qty from tbl_product_serial_log where product_id='".$rows->Product_id."' ");
			$getQtySum=$qtySumQuery->row();
			
			
			//
			
			
			
			//this query for total sum of qty of po
			$qtySumOfPoQuery = $this->db->query("select SUM(qty) as qty from tbl_po_stock_in where pid='".$rows->Product_id."' ");
			$getQtySumOfPo=$qtySumOfPoQuery->row();
			
			
			//
			//
			
			//this query for total sum of qty of so
			$qtySumOfSoQuery = $this->db->query("select SUM(quantity) as qty from tbl_sales_order_dtl where product_id='".$rows->Product_id."' ");
			$getQtySumOfSo=$qtySumOfSoQuery->row();
			$qtySumOfSoRQuery = $this->db->query("select SUM(quantity) as qty from tbl_sales_order_return_log where product_id='".$rows->Product_id."' ");
			$getQtySumOfSoR=$qtySumOfSoRQuery->row();
			
			//
			
		?></th>
<th>
<?php
		$proQ1=$this->db->query("select * from tbl_master_data where serial_number='$rows->usageunit'");
		$fProQ12=$proQ1->row();
 echo $fProQ12->keyvalue;
 ?>
</th>	
<th><?php echo $rows->unitprice_purchase;?></th>	
<th><?php echo $rows->unitprice_sale;?></th>
<th><?php echo $getQtySum->qty; ?></th>
<th><?php echo $getQtySumOfPo->qty; ?></th>
<th><?php echo $getQtySumOfSo->qty-$getQtySumOfSoR->qty; ?></th>
<th><?php echo round($rows->quantity,2); ?></th>
</tr>
<?php } } ?>
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
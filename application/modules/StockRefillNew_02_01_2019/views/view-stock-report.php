<?php
$this->load->view("header.php");
?>
<body>	
<?php 

$gid=$_GET['id'];
$ex=explode('^',$gid);
$pid=$ex[0];
$spid=$ex[1];
$invoiceQuery=$this->db->query("select *from tbl_stockpoint_and_vendor where stockpid='$gid'");
$getInv=$invoiceQuery->row();

?>
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 360px;font-size: 20px;">STOCK POINT BY HISTORY  &nbsp;(<?php echo $getInv->stockpointname; ?>)</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-body panel-center">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-2 control-label">Product Name</label> 
<div class="col-sm-3"> 
<select name="product_idd" class="form-control ui fluid search dropdown location" id="product_idd" onchange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlstock=$this->db->query("select * from tbl_product_stock where status='A'");
						foreach ($sqlstock->result() as $fetchStock){						
					?>					
    <option value="<?php echo $fetchStock->Product_id; ?>"><?php echo $fetchStock->productname; ?></option>

    <?php } ?></select>
</div>  
</div>
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">From Date</label> 
<div class="col-sm-3"> 
<input type="text" name="fdate" class="form-control datepicker" value="<?php //echo date('d/m/Y'); ?>" />
</div>
<label class="col-sm-2 control-label">To Date</label> 
<div class="col-sm-3"> 
<input type="text" name="tdate" class="form-control datepicker2" value="<?php //echo date('d/m/Y'); ?>" /> 
</div> 
</div>
<div class="form-group panel-body-to"> 
<div class="col-sm-3">
</div>
<div class="col-sm-3">
</div>
<label class="col-sm-2 control-label"></label>
<label class="col-sm-2 control-label"><input type="submit" name="search" class="btn btn-sm" value="Search"></label> 
</div>
</form>
</div>

<div class="panel-body">

							<div class="row">
							<div class="col-sm-12">
							<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							<div class="html5buttons">
							<div class="dt-buttons">
							<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
							<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
							
							</div>
							</div>

							<div class="dataTables_length" id="DataTables_Table_0_length">
							<label>Show
							<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-control input-sm">
							<option value="10">10</option>
							</select>
							entries</label>
							</div>

							<div id="DataTables_Table_0_filter" class="dataTables_filter">
							<label>Search:
							<input type="text" class="form-control input-sm search" placeholder="What you looking for?">
							</label>
							</div>
							</div>
							</div>
							</div>	
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover" id="userTbl">
<thead>

	<tr> 
		<th>Date</th>
		<th>Vendor Name</th>
		<th>Product Name</th>
		<th>Category</th>
		<th>Size / Qty</th>
        <th>Total Qty</th>
	</tr> 

</thead> 
<?php
	@extract($_POST);
	if($search!='')
	{
	
		$queryy="select * from tbl_product_stock_log where stock_point='$gid'";
				
		if($product_idd!='')
		{				
			$queryy.=" and product_id like '%$product_idd%'";	  
		}
		
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("/",$tdate);
			
			$fdate=explode("/",$fdate);

			$todate1=$tdate[0]."/".$tdate[1]."/".$tdate[2];
	        $fdate1=$fdate[0]."/".$fdate[1]."/".$fdate[2];
			$queryy .="and maker_date >='$fdate1' and maker_date <='$todate1'";
		}
}else{
$queryy="select * from tbl_product_stock_log where stock_point='$gid'";
}

$result11=$this->db->query($queryy);
?>
<tbody> 

<?php
foreach($result11->result() as $line) {

 $dd=$line->maker_date;
?>
<tr class="gradeC record">

<th><?php echo $dd; ?></th>
<th><?php 

$spquery=$this->db->query("select * from tbl_stockpoint_and_vendor where type='Vendor' and stockpid='$line->vendor_id'");
$sprowslist=$spquery->row();
echo $sprowslist->stockpointname; 

?>	
</th>
<th><!--<a href="repinwdandoutwd">--><?php 
$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='$line->product_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->productname;?><!--</a>--></th>
<th>
<?php 
$sqlQrycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$line->category'");
$qryCateFetch=$sqlQrycate->row();
echo $qryCateFetch->prodcatg_name;?>
</th>

<th style="width:250px;">
<div class="table-responsive2" style="width:420px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

 $countsizesub=sizeof(explode(' | ', $line->size));
$expsize=explode(' | ', $line->size);
$countsize=$countsizesub-1;
for($i=1;$i<=$countsize;$i++){
 ?>
<th style="text-align:center;width: 10px;"><?php echo $expsize[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php
$expweight=explode(' ', $line->quantity);
for($j=1;$j<=$countsize;$j++){
 ?>
<th style="text-align:center"><?php echo $expweight[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<th><?php echo $line->total_qty; ?></th>
</tr>
<?php } ?>
</tbody> 
</table>
</div>
</div>
</div>
</div>
</div>
</body>
<?php $this->load->view("footer.php");?>
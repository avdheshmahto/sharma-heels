<?php
$this->load->view("header.php");

?>
<body>	
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 480px;font-size: 20px;">INWARD REPORT</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-body panel-center" style="background: teal;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-4 control-label" style="font-size: 16px; color: #fff;">Product Name &nbsp;(
<?php 
$result11=$this->db->query("select * from tbl_stock_point_history_log where status='A' and history_update_id='".$_GET['id']."'");
$line=$result11->row();


$q=$this->db->query("select * from tbl_product_stock_log where status='A' and p_logid='$line->p_logid'");
$logrow=$q->row();
$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='$logrow->product_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->productname;?>)
</label> 

<div class="col-sm-3"></div>  

<!--<label class="col-sm-6 control-label"><a href="manageStockFirstNat"><input type="button" name="search" class="btn btn-sm" value="Show All StockPoint"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="repsitembyhistory"><input type="button" name="search" class="btn btn-sm" value="Show All history"></a></label> -->
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
				<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">

					<option value="10">10</option>
				</select>
				entries</label>
			<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -5px;margin-left: 12px;float: right;">Showing 1 to 1 of entries
			</div>
			</div>
			<div id="DataTables_Table_0_filter" class="dataTables_filter">
		     <label>Search:
			<input type="text" id="searchTerm"  class="search_box form-control input-sm" onKeyUp="doSearch()"  placeholder="What you looking for?">
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
		<th>StockPoint</th>
		<th>Vendor Name</th>
		<th>Product Name</th>
		<th>Category</th>
		<th style="width: 285px;">Size / Qty</th>
        <th>Total Qty</th>
       
	</tr> 

</thead> 
<tbody id="getDataTable"> 
<tr class="gradeC record">
<th><?php echo $line->author_date; ?></th>
<th><?php
$spQuery = $this -> db
           -> select('*')
           -> where('stockpid',$logrow->stock_point)
           -> get('tbl_stockpoint_and_vendor');
		  $spRow = $spQuery ->row();

echo $spRow->stockpointname;

?></th>
<th><?php 

$spquery=$this->db->query("select * from tbl_stockpoint_and_vendor where type='Vendor' and stockpid='$logrow->vendor_id'");
$sprowslist=$spquery->row();
echo $sprowslist->stockpointname; 

?>	
</th>
<th><?php 
$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='$logrow->product_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->productname;?></th>
<th>
<?php 
$sqlQrycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$logrow->category'");
$qryCateFetch=$sqlQrycate->row();
echo $qryCateFetch->prodcatg_name;?>
</th>

<th style="width:285px;">
<div class="table-responsive2" style="width:300px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px;"><div class="qty-size"><strong>Size</strong></div></th>

<?php  

 $countsizesub=sizeof(explode(' | ', $logrow->size));
$expsize=explode(' | ', $logrow->size);
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
</tbody> 
</table>
</div>
</div>
</div>
</div>
</div>
</body>
<?php $this->load->view("footer.php");?>
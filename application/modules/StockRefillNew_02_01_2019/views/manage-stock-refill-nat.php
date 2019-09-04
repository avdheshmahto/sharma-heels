<?php
$this->load->view("header.php");
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
<?php 
$gid=$_GET['id'];
$ex=explode('^',$gid);
$pid=$ex[0];
$spid=$ex[1];
$shdrid=$ex[2];
$invoiceQuery=$this->db->query("select *from tbl_stockpoint_and_vendor where stockpid='$gid'");
$getInv=$invoiceQuery->row();

?>
	<?php
@$page0=$_SERVER['REQUEST_URI'];
@$page=explode('&',$page0);
  @$url=@$page[0];
	?>
	 <!-- Main content -->
	 <div class="main-content">	 
<a class="page-title" style="padding: 0 0 0 360px;font-size: 20px;">	
STOCK POINT &nbsp;(<?php echo $getInv->stockpointname; ?>)</a>

			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">					
<div class="panel-body panel-center" style="background: teal;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-2 control-label" style="color: #fff;">Product Name</label> 
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
<label class="col-sm-2 control-label" style="color: #fff;">From Date</label> 
<div class="col-sm-3"> 
<input type="text" name="fdate" class="form-control datepicker" value="<?php //echo date('d/m/Y'); ?>" />
</div>
<label class="col-sm-2 control-label" style="color: #fff;">To Date</label> 
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
							
						<!--	<a href="viewStockReport?id=<?php echo $gid;?>" class="btn btn-sm gr" tabindex="0" aria-controls="DataTables_Table_0"><span>STOCK POINT BY HISTORY</span></a>-->
							</div>
							</div>

						<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" url="<?=$url;?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">

						<option value="10">10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						</select>
						entries</label>
						<div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite" style="    margin-top: -5px;margin-left: 12px;float: right;">Showing <?=$dataConfig['page']+1;?> to 
							<?php
							$m=$dataConfig['page']==0?$dataConfig['perPage']:$dataConfig['page']+$dataConfig['perPage'];
							echo $m >= $dataConfig['total']?$dataConfig['total']:$m;
							?> of <?=$dataConfig['total'];?> entries
						</div>
						</div>

							<div id="DataTables_Table_0_filter" class="dataTables_filter">
							<label>Search:
							<input type="text" id="searchTerm"  class="search_box form-control input-sm" onkeyup="doSearch()"  placeholder="What you looking for?">
							</label>
							</div>
							</div>
							</div>
							</div>

						<div class="table-responsive">
					
<table class="table table-striped table-bordered table-hover" id="userTbl">
<thead>
<tr>

		<th style="width: 290px;">Date</th>
	    <th style="width: 115px;">Vendor Name</th>
	    <th><div style="width: 100px;">Item Name</div></th>
		<th>Category</th>
        <th>Size / Qty</th>
        <th>Total Qtys</th>
		
</tr>
</thead>

<tbody id="getDataTable">

<?php
$i=1;

	@extract($_POST);
	if($search!='')
	{
	
		$queryy="select * from tbl_product_serial where status='A' and stock_point='$gid' ";
				
		if($product_idd!='')
		{				
			echo $product_idd;
			$queryy.=" and product_id='$product_idd'";	  
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
           // $queryy=$this->db->query("select * from tbl_product_serial where status='A' and stock_point='$gid' Order by serial_number desc ");
       	$queryy = "select * from tbl_product_serial where status='A' and stock_point='$gid' Order by serial_number desc ";
      }

         $queryy=$this->db->query($queryy);
?>
<?php  
$sumact='';
  foreach($queryy->result() as $fetch_list)
  {
  	$dd=$fetch_list->maker_date;
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->serial_number; ?>">
<th><?php echo $dd; ?></th>
<th><?php 

$spquery=$this->db->query("select * from tbl_stockpoint_and_vendor where type='Vendor' and stockpid='$fetch_list->vendor_id'");
$sprowslist=$spquery->row();
echo $sprowslist->stockpointname; 

?>	
</th>
<th style="width: 40px;"><?php
$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list->product_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?></th>
<th>
<?php
$compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list->category)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;		  
?>
</th>
<th>
<div class="table-responsive2" style=" width:410px; color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<?php 
 $sizeval = $fetch_list->size;
 $qtyyval = $fetch_list->quantity;

 $sizecount = sizeof(explode(' | ', $sizeval));

 $sizearr   = explode(' | ', $sizeval);
 $qtyarr    = explode(' ', $qtyyval);
?>
<tr>
<th style="width:75px;"><div class="qty-size"><strong>Size</strong></div></th>
<?php for($k=1;$k<$sizecount;$k++){ ?>
<th style="text-align:center;width: 10px;"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Actual Qty</strong></td>
<?php 
		$actqtyto='';
for($j=1;$j<$sizecount;$j++){ $jk=$j-1; 
				
	$actqtyto +=$qtyarr[$jk];
		
?>

<th style="text-align:center"><?php echo $qtyarr[$jk]; ?></th>
<?php } ?>
</tr>
<tr class="gradeX">
<td><strong>Ordered Qty</strong></td>
<?php
	
	 $orderdtlQuery=$this->db->query("select * from tbl_product_stock where status='A' and Product_id='$fetch_list->product_id' and category='$fetch_list->category'");
	 
	$fetch_orderdtlQ=$orderdtlQuery->row();
	 
	 $orderqty=$fetch_orderdtlQ->qtyinstock;
	 
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
<td style="width: 200px;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center" colspan="2"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<?php $sumact +=$actqtyto; ?>
<th style="text-align:center"><?php echo $actqtyto; ?></th>
</tr>
<tr class="gradeX">

<th style="text-align:center"><?php echo $sumorderedqty; ?></th>
</tr>
<tr class="gradeX">

<th style="text-align:center"><?php echo $sumeffectiveqty; ?></th>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
<?php $i++; } ?>
<tr>
	<th colspan="5" style="text-align: right; font-size: 17px;">Total Actual Qty</th>
	<th style="font-size: 17px;"><center><?php echo $sumact; ?></center></th>
</tr>	
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>
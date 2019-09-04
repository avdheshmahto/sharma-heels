<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
	 <!-- Main content -->
	 <div class="main-content"> 
	 	<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">MANAGE STOCK</a>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
<div class="html5buttons">
<div class="dt-buttons">
<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
<!--<a class="btn btn-sm gr" data-a="0" href="<?=base_url();?>StockRefillNew/repinwdandoutwd" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>INWARD & OUTWARD</span>
</a>-->
</div>
</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('StockRefillNew/managestocknational');?>" class="form-control input-sm">

						<option value="10">10</option>
						<option value="25" <?=$entries=='25'?'selected':'';?>>25</option>
						<option value="50" <?=$entries=='50'?'selected':'';?>>50</option>
						<option value="100" <?=$entries=='100'?'selected':'';?>>100</option>
						<option value="500" <?=$entries=='500'?'selected':'';?>>500</option>
						<option value="1000" <?=$entries=='1000'?'selected':'';?>>1000</option>
						<option value="<?=$dataConfig['total'];?>" <?=$entries==$dataConfig['total']?'selected':'';?>>All</option>
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
			<form class="form-horizontal" method="post" action="">					
<table class="table table-striped table-bordered table-hover" >
<thead>
<tbody>
        <tr> 
            <th>Totals</th>
            <th colspan="3">&nbsp;</th>
            <th><center><?php echo $dataConfig['total_inward_qty_sum']; ?></center></th>
        </tr> 
    </tbody>

<tr>
	   <th>StockPoint</th>
	   <th><div style="width:70px;">Item Name</div></th>
		<th style="width:100px;">Category</th>
        <th style=" width:570px">Size / Qty</th>
        <th style="width:75px;">Total Qtys</th>
		
</tr>
</thead>

<tbody id="getDataTable">
<?php  
$i=1;
  $query=$this->db->query("select * from tbl_product_serial where status='A' Order by serial_number desc limit $page,$per_page ");
  
  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->serial_number; ?>">
<th style="display:none"><input type="checkbox"  /></th>
<th><?php
$spQuery = $this -> db
           -> select('*')
           -> where('stockpid',$fetch_list->stock_point)
           -> get('tbl_stockpoint_and_vendor');
		  $spRow = $spQuery ->row();

echo $spRow->stockpointname;

?></th>

<th><?php
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
<div class="table-responsive2" style=" width:580px; color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<?php 
 $sizeval=$ItemRow->size;
 $qtyyval=$fetch_list->quantity;

 $sizecount=sizeof(explode(' ', $sizeval));

	$sizearr=explode(' ', $sizeval);
	$qtyarr=explode(' ', $qtyyval);
?>
<tr>
<th style="width:75px;"><div class="qty-size"><strong>Size</strong></div></th>
<?php for($k=0;$k<$sizecount;$k++){ ?>
<th style="text-align:center;width: 10px;"><?php echo $sizearr[$k]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Act Qty</strong></td>
<?php 
		$actqtyto='';
for($j=0;$j<$sizecount;$j++){  
				
				$actqtyto +=$qtyarr[$j];
		
?>

<th style="text-align:center"><?php echo $qtyarr[$j]; ?></th>
<?php } ?>
</tr>
<tr class="gradeX">
<td><strong>Ord Qty</strong></td>
<?php
	
	 $orderdtlQuery=$this->db->query("select * from tbl_product_stock where status='A' and Product_id='$fetch_list->product_id' and category='$fetch_list->category'");
	 
	$fetch_orderdtlQ=$orderdtlQuery->row();
	 
	 $orderqty=$fetch_orderdtlQ->qtyinstock;
	 
	 $orderqtyarr=explode(' ', $orderqty);
			
			$sumorderedqty=0;
 for($j=0;$j<$sizecount;$j++){  
 				
			$sumorderedqty +=$orderqtyarr[$j];	
 ?>
						
<th style="text-align:center"><?php echo $orderqtyarr[$j]; ?></th>
<?php } ?>
</tr>
<tr class="gradeX">
<td><strong>Eff Qty</strong></td>
<?php 
		$sumeffectiveqty=0;
for($ef=0;$ef<$sizecount;$ef++){  
  $qtyor=$qtyarr[$ef]-$orderqtyarr[$ef];
  		
		$sumeffectiveqty +=$qtyor;
?>
<th style="text-align:center"><?php echo $qtyor; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>
<td style="width: 100px;">
<div class="table-responsive2" style="width: 130px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="text-align:center"><strong>All Sizes</strong></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">

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
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
<div class="row">
<div class="col-md-12 text-right">
<div class="col-md-6 text-left"> 
<!-- <h6>Showing 1 to 10 of <?php echo $totalrow; ?> entries</h6> -->
</div>
<div class="col-md-6"> 
<?php echo $pagination; ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
$this->load->view("footer.php");
?>
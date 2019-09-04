<?php
$this->load->view("header.php");
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
<body>	
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">INWARD & OUTWARD</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-body panel-center" style="background: teal;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-4 control-label" style="font-size: 16px; color: #fff;">Product Name &nbsp;(
<?php 
$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='".$_GET['id']."'");
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
							<select name="DataTables_Table_0_length" url="<?=base_url('StockRefillNew/repinwdandoutwd');?>" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm">

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
		<th>Particulars</th>
		<th>Inward Qty</th>
		<th>Outward Qty</th>
        <th>Closing Qty</th>
	</tr> 

</thead> 
<?php

$logqry=$this->db->query("select * from tbl_product_stock_log where status='A' and product_id='".$_GET['id']."'");
$getpstocklog=$logqry->row();

$queryy="select * from tbl_stock_point_history_log where status='A' and p_logid='$getpstocklog->p_logid'";

$result11=$this->db->query($queryy);

?>
<tbody id="getDataTable"> 

<?php
$suminw=0;
	$sumstockqty=0;
foreach($result11->result() as $line) {

?>
<tr class="gradeC record">
<th><?php echo $line->author_date; ?></th>
<th><?php 
$sqlQrrry=$this->db->query("select * from tbl_product_stock_log where p_logid='$line->p_logid'");
$qryyyFetch=$sqlQrrry->row();

$sqlQry=$this->db->query("select * from tbl_stockpoint_and_vendor where type='Vendor' and stockpid='$qryyyFetch->vendor_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->stockpointname;?></th>
<?php $sumstockqty +=$line->total_qty; ?>
<th><a href="reportinward?id=<?php echo $line->history_update_id; ?>" target="_blank"><?php echo $line->total_qty; ?></a></th>
<th>&nbsp;</th>
<th><?php $suminw +=$line->total_qty; ?></th>
</tr>
<?php } ?>
<!--===============================================================================================================================================-->
<?php
$i=0;
$totinvqty='';
$sqlQryinvdtl=$this->db->query("select * from tbl_ordered_invoice_dtl where item_id='".$_GET['id']."'");
foreach($sqlQryinvdtl->result() as $invlinedtl){ 		
 ?>

<tr class="gradeC record">
<th><?php echo $invlinedtl->maker_date; ?></th>
<th><?php 
$sqlQry=$this->db->query("select * from tbl_contact_m where contact_id='$invlinedtl->customer_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->first_name;?></th>


<th>&nbsp;</th>
<th><a href="<?php echo base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/outwardreports?id=<?php echo $invlinedtl->ordered_invoiceid_dtl; ?>" target="_blank">
<?php	
echo $invlinedtl->total_qty;

$inwq=$suminw;

$totinvqty +=$invlinedtl->total_qty;

$actinw=$inwq-$totinvqty;	
 ?></a>
 </th>
<th><?php 

	echo $actinw;		
 ?></th>
</tr>
<!--===============================================================================================================================================-->
<?php
	$i++;
	}

 $outwdtotqtysum=$outwdtotqtysum+$totinvqty;
 
 ?>
<tr class="gradeC record">
<td>&nbsp;</td>
<td style="text-align: right;font-size: 11px;"><b>TOTAL</b></td>
<td><b><?php echo $sumstockqty; ?></b></td>
<th>Total&nbsp;&nbsp;&nbsp;<?php echo $outwdtotqtysum; ?></th>
<th>&nbsp;</th>
</tr>
</tbody> 
</table>
</div>
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
</body>
<?php $this->load->view("footer.php");?>
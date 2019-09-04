<?php
$this->load->view("header.php");

$entries = "";
  if($this->input->get('entries')!=""){
    $entries = $this->input->get('entries');
  }
?>
<form id="f1" name="f1" method="POST" action="" onSubmit="return checkKeyPressed(a)">
<!-- Main content -->
<div class="main-content">
	<a class="page-title" style="padding: 0 0 0 470px;font-size: 20px;">OUTWARD REPORT</a>
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
					<div class="panel-body">
                 
                 <div class="panel-body panel-center" style="background: teal;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-3 control-label" style="font-size: 16px; color: #fff;">Product Name &nbsp;(
<?php 
$sqlorderdtl=$this->db->query("select * from tbl_ordered_invoice_dtl where status='A' and ordered_invoiceid_dtl='".$_GET['id']."'");
$qryFetchdtl=$sqlorderdtl->row();

$sqlQry=$this->db->query("select * from tbl_product_stock where Product_id='$qryFetchdtl->item_id'");
$qryFetch=$sqlQry->row();
echo $qryFetch->productname;?>)
</label> 
<div class="col-sm-3"></div>  

<!--<label class="col-sm-6 control-label"><a href="manageStockFirstNat"><input type="button" name="search" class="btn btn-sm" value="Show All StockPoint"></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="repsitembyhistory"><input type="button" name="search" class="btn btn-sm" value="Show All history"></a></label> -->
</div>
</form>
</div>
                    
<div class="row">
<div class="col-sm-12">
<div id="DataTables_Table_0_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
	<div class="html5buttons">
	<div class="dt-buttons">
	<a class="dt-button buttons-excel buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>Excel</span></a>
	<a class="dt-button buttons-pdf buttons-html5" tabindex="0" aria-controls="DataTables_Table_0"><span>PDF</span></a>
	<!--<a class="btn btn-sm gr" data-a="0" href="<?=base_url();?>OrderedInvoiceNew/OrderedInvoiceNew/invoiceInNational" type="button" data-toggle="modal" data-backdrop='static' data-keyboard='false'><span>Add Invoice</span>
	</a>-->
	</div>
	</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
            <label>Show
            <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries"  class="form-control input-sm">

            <option value="10">10</option>
           
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
<div id="ordereddataidss">			
<div class="table-responsive">
<form class="form-horizontal" method="post" action="">								
<table class="table table-striped table-bordered table-hover" >
<thead>
<input type="hidden" id="saveval" class="form-control"  />
<tr>
		<th>Date</th>
	   <th>Invoice No.</th>
	   <th>Customer Name</th>
	   <th>Product Name</th>		
	   <th>Description</th>       
       <th>Category</th>
       <th>Size / Qty</th>
       <th>Total Qty</th>
       <th>Price</th>
       <th>Total Price</th>
</tr>
</thead>

<tbody id="getDataTable">

<?php  
$i=1;
$sqlorder=$this->db->query("select * from tbl_ordered_invoice_dtl where status='A' and ordered_invoiceid_dtl='".$_GET['id']."'");
	
	foreach($sqlorder->result() as $fetch_list){	
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->ordered_invoiceid_dtl; ?>">
<th><?php echo $fetch_list->maker_date;?></th>
<th><?php 
$nextyear=date("y");
$ss=$fetch_list->ordered_invoiceid;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
 ?></th>
<th><?php
		
$customerQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list->customer_id)
           -> get('tbl_contact_m');
		  $custRow = $customerQuery->row();

echo $custRow->first_name;

?></th>
<th>
<?php	
$itemQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list->item_id)
           -> get('tbl_product_stock');
		  $ItemRow = $itemQuery ->row();

echo $ItemRow->productname;

?>
</th>
<th><?php echo $fetch_list->description; ?></th>
<th>
<?php 
$sqlQrycate=$this->db->query("select * from tbl_prodcatg_mst where prodcatg_id='$fetch_list->category_id'");
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

 $countsizesub=sizeof(explode(' | ', $fetch_list->size_val));
$expsize=explode(' | ', $fetch_list->size_val);
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
$expweight=explode(',', $fetch_list->qty_val);
for($j=0;$j<$countsize;$j++){
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
<th><?php echo $fetch_list->total_price; ?></th>
</tr>
<?php $i++; } ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
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
<!--main-content close-->
<!-- /.modal -->
</div>
<?php
$this->load->view("footer.php");
?>
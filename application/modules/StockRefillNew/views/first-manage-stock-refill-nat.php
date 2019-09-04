<?php
$this->load->view("header.php");
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
	 <!-- Main content -->
	<div class="main-content">	 
<a class="page-title" style="padding: 0 0 0 425px;font-size: 20px;">ALL STOCKPOINT LIST&nbsp;</a>	
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
		
		</div>
		</div>

		<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" class="form-control input-sm" url="<?=base_url('StockRefillNew/manageStockFirstNat');?>">

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
<table class="table table-striped table-bordered table-hover" id="userTbl">
<thead>
<tr>
		<th style="width: 210px;">Stock Point</th>
	    <th>Phone No.</th>
        <th>GST%</th>	
        <th>Address</th>	
       
</tr>
</thead>

<tbody id="getDataTable">
<?php  
$i=1;

  $query=$this->db->query("select * from tbl_stockpoint_and_vendor where status='A' and type='StockPoint' order by stockpid desc limit $page,$per_page ");
  
  foreach($query->result() as $fetch_list)
  {
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->stockpid; ?>">

<th style="display:none"><input name="cid[]" type="checkbox"  id="cid[]" class="sub_chk" data-id="<?php echo $fetch_list->stockpid; ?>" value="<?php echo $fetch_list->stockpid;?>" /></th>

<th>
<a href="manageStockNat?id=<?php echo $fetch_list->stockpid;?>">
	<?php echo $fetch_list->stockpointname; ?></a></th>

<th onclick="contactDetails('<?php echo $urlvc ?>')"><i class="fa fa-phone" aria-hidden="true"></i>
<a href="tel:9716127292"><?=$fetch_list->phone_no;?></a></th>
<th><?php echo $fetch_list->gst_per; ?></th>
<th><?php echo $fetch_list->address; ?></th>

</tr>
<?php $i++; } ?>
</tbody>
<input type="text" style="display:none;" id="table_name" value="tbl_product_serial_hdr">  
<input type="text" style="display:none;" id="pri_col" value="stockpid">

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
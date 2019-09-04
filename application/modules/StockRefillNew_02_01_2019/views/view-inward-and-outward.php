<?php
$this->load->view("header.php");
$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}
?>
<body>	

<div class="main-content">
<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">Product List</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-body panel-center" style="background: cadetblue;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 

<label class="col-sm-2 control-label" style="color: #fff;">Category Name</label> 
<div class="col-sm-3"> 
<select name="product_idd" class="form-control ui fluid search dropdown location" id="product_idd" onChange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlstock=$this->db->query("select * from tbl_prodcatg_mst where status='A'");
						foreach ($sqlstock->result() as $fetchStock){						
					?>					
    <option value="<?php echo $fetchStock->prodcatg_id; ?>"><?php echo $fetchStock->prodcatg_name; ?></option>

    <?php } ?></select>
</div>  

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
		<th>Product Name</th>
		<th>Category</th>
		<th>Stock Point</th>
	</tr> 

</thead> 
<?php
	@extract($_POST);
	if($search!='')
	{
	
		$queryy="select * from tbl_product_stock where status='A'";
				
		if($product_idd!='')
		{				
			$queryy.=" and category like '%$product_idd%'";	  
		}
		
}else{
$queryy="select * from tbl_product_stock where status='A' ORDER BY Product_id DESC limit $page,$per_page";
}

$result11=$this->db->query($queryy);
?>
<tbody id="getDataTable"> 

<?php
	
foreach($result11->result() as $line) {
?>
<tr class="gradeC record">

<th><a href="repsecinwdandoutwd?id=<?php echo $line->Product_id; ?>"><?php 
echo $line->productname;?></a></th>
<th><?php 
 $compQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$line->category)
           -> get('tbl_prodcatg_mst');
		  $compRow = $compQuery->row();

echo $compRow->prodcatg_name;
?></th>
<th>
<?php 
//echo $fetch_list->stockpid.'dsd';
 $stQuery = $this -> db
           -> select('*')
           -> where('stockpid',$line->stockpid)
           -> get('tbl_stockpoint_and_vendor');
		  $stRow = $stQuery->row();

echo $stRow->stockpointname;
?>

 </th>
</tr>
<?php } ?>
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
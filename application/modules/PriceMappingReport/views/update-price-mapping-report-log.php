<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
<body>	
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 425px;font-size: 20px;">PRICE MAPPING LOG&nbsp;</a>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">

<div class="panel-body panel-center" style="background: cadetblue;">
<form class="form-horizontal" method="post">
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label" style="color: #fff;">Product Name</label> 
<div class="col-sm-3"> 
<select name="product_idd" class="form-control" id="product_idd" onChange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlstock=$this->db->query("select * from tbl_product_stock where status='A' and Product_type='27'");
						foreach ($sqlstock->result() as $fetchStock){						
					?>					
    <option value="<?php echo $fetchStock->Product_id; ?>"><?php echo $fetchStock->productname; ?></option>

    <?php } ?></select>
</div>  
<label class="col-sm-2 control-label" style="color: #fff;">Category</label> 
<div class="col-sm-3"> 
<select name="category_name" class="form-control">
						<option value="">----Select ----</option>
					<?php 
						$sqlcat=$this->db->query("select * from tbl_prodcatg_mst where status='A'");
						foreach ($sqlcat->result() as $fetchCate){						
					?>					
    <option value="<?php echo $fetchCate->prodcatg_id; ?>"><?php echo $fetchCate->prodcatg_name; ?></option>

    <?php } ?></select>
</div>  
</div>

<div class="form-group panel-body-to" style="display: none;"> 
<label class="col-sm-2 control-label" style="color: #fff;">From Date</label> 
<div class="col-sm-3"> 
<input type="text" name="fdate" class="form-control datepicker" value="<?php //echo date('d/m/Y'); ?>" />
</div>
<label class="col-sm-2 control-label" style="color: #fff;">To Date</label> 
<div class="col-sm-3"> 
<input type="text" name="tdate" class="form-control datepicker2"  value="<?php //echo date('d/m/Y'); ?>" /> 
</div> 
</div>

<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label" style="color: #fff;">Customer Name</label> 
<div class="col-sm-3"> 
<select name="customer_name" class="form-control" id="product_idd" onChange="customerfun()" >
						<option value="">----Select ----</option>
					<?php 
						$sqlcust=$this->db->query("select * from tbl_contact_m where status='A'");
						foreach ($sqlcust->result() as $fetchCust){						
					?>					
    <option value="<?php echo $fetchCust->contact_id; ?>"><?php echo $fetchCust->first_name; ?></option>

    <?php } ?></select>
</div>  
<label class="col-sm-2 control-label" style="color: #fff;">&nbsp;</label> 
<div class="col-sm-3">&nbsp;</div>  
</div>

<div class="form-group panel-body-to"> 
<label class="col-sm-4 control-label" style="color: #fff;">&nbsp;</label> 
  
<label class="col-sm-3 control-label"></label>
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
				<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('PriceMappingReport/updatemappingReportlog');?>" class="form-control input-sm">

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
			<input type="text" id="searchTerm"  class="search_box form-control input-sm" onKeyUp="doSearch()"  placeholder="What you looking for?">
			</label>
			</div>	
			</div>
		</div>
	</div>	
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover">
<tbody>
<tr>
<th>Customer Name</th>
<th>Item Name</th>
<th>Category</th>
<th>Old Price</th>
<th>Current Price</th>

</tr>
<?php
	@extract($_POST);
	if($search!='')
	{
	
		$orderdtlquert="select * from tbl_contact_product_price_mapping where status='A'";
				
		if($product_idd!='')
		{				
			$orderdtlquert.=" and product_id ='$product_idd'";	  
		}
		
		//========================================================
		if($category_name!='')
		{				
			$orderdtlquert.=" and catg_id ='$category_name'";	  
		}
		
		if($customer_name!='')
		{				
			$orderdtlquert.=" and contact_id ='$customer_name'";	  
		}
		
		//========================================================
		
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("/",$tdate);
			
			$fdate=explode("/",$fdate);

			$todate1=$tdate[0]."/".$tdate[1]."/".$tdate[2];
	        $fdate1=$fdate[0]."/".$fdate[1]."/".$fdate[2];
			$orderdtlquert.="and maker_date >='$fdate1' and maker_date <='$todate1'";
		}
}else{
$orderdtlquert="select * from tbl_contact_product_price_mapping where status='A' ORDER BY id DESC limit $page,$per_page";
}

$result11=$this->db->query($orderdtlquert);
?>

<?php 
	$sumqty='';
			  
	foreach($result11->result() as $fetch_list_orderdtl){	  


$stockQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->product_id)
           -> get('tbl_product_stock');
		  $stock_list = $stockQuery->row();
		  

$customerQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list_orderdtl->contact_id)
           -> get('tbl_contact_m');
		  $custlist = $customerQuery->row();		  

$catQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->catg_id)
           -> get('tbl_prodcatg_mst');
		  $category_list = $catQuery->row();

 ?>
<tr>
<th><?php echo  $custlist->first_name; ?></th>
<th><?php echo  $stock_list->productname; ?></th>
<th><?php echo  $category_list->prodcatg_name; ?></th>

<th style="width: 170px;">
<div class="table-responsive2" style="color:#000000;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px; display: none;"><div class="qty-size"><strong>Price</strong></div></th>
<?php  
$query = $this->db->query("SELECT * FROM tbl_contact_product_price_mapping_log where status='A' and price_mapping_id='$fetch_list_orderdtl->id' LIMIT 1;");
$row = $query->row();
 ?>
<th style="text-align:center;width: 10px;"><?php echo $row->price; ?></th>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td style="display: none;"><strong>Date</strong></td>
<th style="text-align:center"><?php echo $row->maker_date; ?></th>
</tr>
</tbody>
</table>
</div>
</th>

<th style="width:285px;">
<div class="table-responsive2" style="width:362px;color:#000000;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th style="width:100px; display: none;"><div class="qty-size"><strong>Price</strong></div></th>
<?php  
$qrymplog=$this->db->query("select * from tbl_contact_product_price_mapping_log where status='A' and price_mapping_id='$fetch_list_orderdtl->id' LIMIT 0,5");
foreach($qrymplog->result() as $fetch_log) {
 ?>
<th style="text-align:center;width: 10px;"><?php echo $fetch_log->price; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td style="display: none;"><strong>Date</strong></td>
<?php
foreach($qrymplog->result() as $fetch_log) {
?>
<th style="text-align:center"><?php echo $fetch_log->maker_date; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</th>

</tr>
<?php
$sumqty +=$fetch_list_orderdtl->price;
 } ?>
</tbody>
<tr style="display:none;">
	<td colspan="3"></td>
    <td><b><center>Total price</center></b></td>
    <td><b><?php echo $sumqty; ?></b></td>
</tr>
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
<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
<body>	
<div class="main-content">
<a class="page-title" style="padding: 0 0 0 425px;font-size: 20px;">ALL ORDER HISTORY&nbsp;</a>
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
<label class="col-sm-2 control-label" style="color: #fff;">Status</label> 
<div class="col-sm-3"> 
<select name="status_name" class="form-control">
	<option value="">----Select ----</option>							
    <option value="">Pending</option>
    <option value="">Completed</option>
</select>
</div>  
</div>

<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label" style="color: #fff;">Product Status</label> 
<div class="col-sm-3"> 
<select name="product_status" class="form-control" style="width:75%;">
	<option value="">----Select----</option>									
    <option value="Cancel">Cancel Product</option>
</select>
</div>  

<label class="col-sm-2 control-label" style="color: #fff;">Order No.</label>
<div class="col-sm-3"> 
<select name="order_no" class="form-control">
	<option value="">----Select----</option>									
   <?php 
	$sqlorder=$this->db->query("select * from tbl_order_hdr where status='A'");
	foreach ($sqlorder->result() as $fetchOrder){						
	?>		
    <option value="<?php echo $fetchOrder->order_id; ?>"><?php 
$nextyear=date("y");
$ss=$fetchOrder->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;
?>
    </option>
    <?php } ?>
</select>
</div>  
</div>

<div class="form-group panel-body-to"> 
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
<label class="col-sm-4 control-label" style="color: #fff;"><h2>Total Qtys &nbsp;<?php  echo $dataConfig['totalSum']; ?></h2></label> 
  
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
				<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('OrderReport/OrderReport/orderReportlog');?>" class="form-control input-sm">

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
<th>Date</th>
<th>Customer Name</th>
<th>Order No.</th>
<th>Item Name</th>
<th>Description</th>
<th>Category</th>
<th>Size / Qty</th>
<th>Total Qty</th>
<th style="width:8%;">Status</th>
<th>Remarks</th>
<th>Item Cancelled</th>
</tr>
<?php
	@extract($_POST);
	if($search!='')
	{
	
		$orderdtlquert="select * from tbl_order_dtl where status='A'";
				
		if($product_idd!='')
		{				
			$orderdtlquert.=" and item_id ='$product_idd'";	  
		}
		
		//========================================================
		if($category_name!='')
		{				
			$orderdtlquert.=" and category_id ='$category_name'";	  
		}
		
		if($customer_name!='')
		{				
			$orderdtlquert.=" and customer_id ='$customer_name'";	  
		}
		
		if($status_name!='')
		{				
			$orderdtlquert.=" and invoice_status ='$status_name'";	  
		}
		
		if($product_status!='')
		{				
			$orderdtlquert.=" and cancel_status = '$product_status'";	  
		}
		
		if($order_no!='')
		{				
			$orderdtlquert.=" and order_id ='$order_no'";	  
		}
		//========================================================
		
		if($fdate!='' && $tdate!='')
		{
		
			$tdate=explode("/",$tdate);
			
			$fdate=explode("/",$fdate);

			$todate1=$tdate[0]."/".$tdate[1]."/".$tdate[2];
	        $fdate1=$fdate[0]."/".$fdate[1]."/".$fdate[2];
			$orderdtlquert.="and order_date >='$fdate1' and order_date <='$todate1'";
		}
}else{
$orderdtlquert="select * from tbl_order_dtl where status='A' ORDER BY order_dtl_id DESC limit $page,$per_page";
}

$result11=$this->db->query($orderdtlquert);
?>

<?php 
	$sumqty='';
			  
	foreach($result11->result() as $fetch_list_orderdtl){	  


$stockQuery = $this -> db
           -> select('*')
           -> where('Product_id',$fetch_list_orderdtl->item_id)
           -> get('tbl_product_stock');
		  $stock_list = $stockQuery->row();
		  

$customerQuery = $this -> db
           -> select('*')
           -> where('contact_id',$fetch_list_orderdtl->customer_id)
           -> get('tbl_contact_m');
		  $custlist = $customerQuery->row();		  

$catQuery = $this -> db
           -> select('*')
           -> where('prodcatg_id',$fetch_list_orderdtl->category_id)
           -> get('tbl_prodcatg_mst');
		  $category_list = $catQuery->row();

 $sizeval=$fetch_list_orderdtl->size_name;
 $qtyyval=$fetch_list_orderdtl->qty_name;

 $sizecount=sizeof(explode(' | ', $sizeval));

	$sizearr=explode(' | ', $sizeval);
	$qtyarr=explode(' | ', $qtyyval);
?>
<tr>
<td><?php echo  $fetch_list_orderdtl->order_date; ?></td>
<td><?php echo  $custlist->first_name; ?></td>
<td>
<?php
$nextyear=date("y");

$ss=$fetch_list_orderdtl->order_id;
$var = str_pad($ss,1,'0',STR_PAD_LEFT);
$numbercase = sprintf('%04d',$var);
echo "NAT"."/".$nextyear."/".$numbercase;

 ?>
</td>
<td><?php echo  $stock_list->productname; ?>
<br />
<?php  $taxoncount=sizeof(explode(',', $fetch_list_orderdtl->category_type)); 
			$taxexp=explode(',', $fetch_list_orderdtl->category_type);
			
		for($it=0;$it<$taxoncount;$it++){
		  $taxid=$taxexp[$it];
		
		$taxonQuery=$this->db->query("select * from tbl_product_stock where Product_id='$taxid'");
		$taxonnamelist=$taxonQuery->row();
		
?>
	
	<p style="padding: 0px 0px 0px 66px; margin: 0em 0em 0em;"><?php echo  $taxonnamelist->productname; ?></p>
<?php } ?>
</td>
<td style="width:100px;"><?php echo  $fetch_list_orderdtl->desc_name; ?></td>
<td><?php echo  $category_list->prodcatg_name; ?></td>
<td style="width: 200px;">
<div class="table-responsive2" style="width: 210px;color:#000000;max-height:170px;overflow-y: auto;overflow-x: scroll;">
<table class="table table-striped table-bordered">
<thead>
<tr>
<th><strong>Size</strong></th>
<?php for($i=1;$i<$sizecount;$i++){ ?>
<th style="text-align:center"><?php echo $sizearr[$i]; ?></th>
<?php } ?>
</tr>
</thead>
<tbody>
<tr class="gradeX">
<td><strong>Qty</strong></td>
<?php for($j=1;$j<$sizecount;$j++){ ?>
<th style="text-align:center"><?php echo $qtyarr[$j]; ?></th>
<?php } ?>
</tr>
</tbody>
</table>
</div>
</td>
<td><?php echo  $fetch_list_orderdtl->total_qty; ?></td>
<td><b><?php 
$Queryhdr=$this->db->query("select * from tbl_order_hdr where order_id='$fetch_list_orderdtl->order_id'");
$hdrlist=$Queryhdr->row();
echo $hdrlist->invoice_status; ?></b></td>
<td><?php echo $fetch_list_orderdtl->remarks;?></td>
<td>
<?php
if($fetch_list_orderdtl->cancel_status=='Cancel'){
?>
<center><button class="btn btn-sm btn-secondary" type="button" data-toggle="modal" data-backdrop="static" data-keyboard="false"><i class="icon-cancel"></i></button></center>
<?php }else{ } ?>
</td>
</tr>
<?php
$sumqty +=$fetch_list_orderdtl->total_qty;
 } ?>
</tbody>
<tr>
	<td colspan="6"></td>
    <td><b><center>Total Quantitys</center></b></td>
    <td><b><?php echo $sumqty; ?></b></td><td colspan="3">&nbsp;</td>
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
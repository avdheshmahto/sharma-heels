<?php
$this->load->view("header.php");

$entries = "";
if($this->input->get('entries')!=""){
  $entries = $this->input->get('entries');
}

?>
<body onLoad="showww()">
	 <!-- Main content -->
	 <div class="main-content">
<a class="page-title" style="padding: 0 0 0 440px;font-size: 20px;">CASH PAYMENT</a>	
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
<a class="btn btn-sm gr" data-toggle="modal" data-target="#modal-0"><span>Add Payment</span>
</a>
</div>
</div>
<div class="dataTables_length" id="DataTables_Table_0_length">
						<label>Show
						<select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" id="entries" url="<?=base_url('Payment/manage_paymentNat');?>" class="form-control input-sm">

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
<form class="form-horizontal" method="post" action="update_item"  enctype="multipart/form-data">					
<table class="table table-striped table-bordered txtHint" id="userTbl">
<thead>
 
<tr style="border-bottom:3px solid #000;">
<th>Total</th>
<th></th>
<th id="debit"></th>
<th id="credit"></th>
<th id="close"></th>
</tr> 
<tr>
		<!--<th><input name="check_all" type="checkbox" id="check_all" onClick="checkall(this.checked)" value="check_all" /></th>-->
		<th>S No.</th>
        <th>Customer Name</th>
		<th>Debit</th>
		<th>Credit</th>
		<th>Balance</th>
</tr>
</thead>

<tbody id="getDataTable">
<?php  
$i=1;
 $query=$this->db->query("select * from tbl_contact_m where status='A' and module_status='National' ORDER BY contact_id DESC limit $page,$per_page");
  foreach($query->result() as $fetch_list)
  {
  
   $abc=$this->db->query("select * from tbl_payment_cash where contact_id='$fetch_list->contact_id'");
	
	foreach($abc->result() as $lines){

		if($lines->status=='Invoice'){
		   $c+=$lines->total_billamt; 
		  
			}
				else if($lines->status=='Payment'){
			   $b+=$lines->total_billamt; 
 
			}
 		} 
  
  ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->invoice_rid; ?>">

<th><?php echo $fetch_list->contact_id;?></th>
<th><a href="view_payment_cash?id=<?php echo $fetch_list->contact_id;?>" target="_blank"><?php echo $fetch_list->first_name;?></a></th>
<th><?php 
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_cash where contact_id='$fetch_list->contact_id' and status='Invoice'");
$rowfetch=$sqlqry->row();
echo $debit=$rowfetch->val;?></th>
<th><?php 
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_cash where contact_id='$fetch_list->contact_id' and status='Payment'");
$rowfetch=$sqlqry->row();
echo $credit=$rowfetch->val;?></th>
<th><?php if($debit!=''){ echo $bal=$debit-$credit; }else{ echo $bal=$credit; } ?></th>
</tr>
<div id="modal-<?php echo $i; ?>" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">View Product</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Customer Name:</label> 
<div class="col-sm-4"> 
<select name="customer_name" required class="form-control" disabled="disabled">
						<option value="">----Select ----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"<?php if($fetch_protype->contact_id==$fetch_list->contact_id){?>selected<?php }?>><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>
</div> 
<label class="col-sm-2 control-label">*Amount:</label> 
<div class="col-sm-4"> 
<input name="amt"  type="text" value="<?php echo $fetch_list->total_billamt;?>" readonly="" class="form-control" required> 
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">Remarks:</label> 
<div class="col-sm-4"> 
<textarea name="remarks" class="form-control" readonly="readonly" /><?php echo $fetch_list->remarks;?></textarea>
</div> 
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php $i++; } ?>
</tbody>
<input type="hidden" name="debitres" id="debitres" value="<?php echo $c;?>" />
<input type="hidden" name="creditres" id="creditres" value="<?php echo $b;?>" />
<input type="hidden" name="closres" id="closres" value="<?php if($c!=''){ echo $c-$b; }else{ echo $b; } ?>" />

<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
<form class="form-horizontal" role="form" method="post" action="insert_payment" enctype="multipart/form-data">			
<ol> 
<div class="pull-right">
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content" >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title">Add Payment</h4>
</div>
<div class="modal-body overflow">
<div class="form-group"> 
<label class="col-sm-2 control-label">*Customer Name:</label> 
<div class="col-sm-4"> 
<select name="customer_name" required class="form-control">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='National'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>
</div> 
<label class="col-sm-2 control-label">*Amount:</label> 
<div class="col-sm-4">
<input name="amt"  type="number" value="" class="form-control" required> 
</div> 
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">*Date:</label> 
<div class="col-sm-4">
<input name="date"  type="date" value="" class="form-control" required> 
</div>
<label class="col-sm-2 control-label">Remarks:</label> 
<div class="col-sm-4"> 
<textarea name="remarks" class="form-control" /> </textarea>
</div> 
</div>
</div>

<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
</div>
</div>
</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--<a href="#/" class="btn btn-secondary btn-sm"><i class="fa fa-trash-o"></i> Delete</a>-->
</div>
</ol>
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
<script>
function showww(){
//alert();
var debit=document.getElementById("debitres").value;
var credit=document.getElementById("creditres").value;
var closeee=document.getElementById("closres").value;

document.getElementById("close").innerHTML=closeee;
document.getElementById("credit").innerHTML=credit;
document.getElementById("debit").innerHTML=debit;
} 
</script>	
<?php
$this->load->view("footer.php");
?>
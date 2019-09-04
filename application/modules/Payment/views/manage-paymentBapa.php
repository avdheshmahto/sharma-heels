<?php
$this->load->view("header.php");
?>
<body onLoad="showww()">
	 <!-- Main content -->
	 <div class="main-content">
<form class="form-horizontal" role="form" method="post" action="insert_payment" enctype="multipart/form-data">			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Payment</a></li> 
<li class="active"><strong>Cash Payment</strong></li>
<div class="pull-right">
<button type="button" class="btn btn-sm" data-toggle="modal" data-target="#modal-0">Add Payment</button>
<div id="modal-0" class="modal fade" tabindex="-1" role="dialog">
<div class="modal-dialog modal-lg">
<div class="modal-content">
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
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='BapaNagar'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>
</div> 
<label class="col-sm-2 control-label">*Amount:</label> 
<div class="col-sm-4">
<select name="drcr"  style="width:105px" class="form-control">
<option value="">--Select--</option>
<option value="Dr">Debit</option>
<option value="Cr">Credit</option>
</select> 
<input name="amt"  type="number" style="width:160px" value="" class="form-control" required> 
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
<?php
            if($this->session->flashdata('flash_msg')!='')
{
            ?>
<div class="alert alert-success alert-dismissible" role="alert" id="success-alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
<strong>Well done! &nbsp;<?php echo $this->session->flashdata('flash_msg');?></strong> 
</div>	
<?php }?>		
			<div class="row">
				<div class="col-lg-12">
						<div class="panel-body">
						
							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="update_item"  enctype="multipart/form-data">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
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

<tbody>
<?php  
$i=1;
  foreach($result as $fetch_list)
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

<th><?php echo $i;?></th>
<th><a href="view_payment_cash?id=<?php echo $fetch_list->contact_id;?>" target="_blank"><?php echo $fetch_list->first_name;?></a></th>
<th><?php 
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_cash where contact_id='$fetch_list->contact_id' and status='Invoice'");
$rowfetch=$sqlqry->row();
echo $debit=$rowfetch->val;?></th>
<th><?php 
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_cash where contact_id='$fetch_list->contact_id' and status='Payment'");
$rowfetch=$sqlqry->row();
echo $credit=$rowfetch->val;?></th>
<th><?php echo $bal=$debit-$credit;?></th>
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
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='BapaNagar'");
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
<input type="hidden" name="closres" id="closres" value="<?php echo $c-$b;?>" />

<input type="text" style="display:none;" id="table_name" value="tbl_product_stock">  
<input type="text" style="display:none;" id="pri_col" value="Product_id">
</table>
</form>
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
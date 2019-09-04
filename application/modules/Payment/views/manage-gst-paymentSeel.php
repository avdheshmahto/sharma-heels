
<?php
$this->load->view("header.php");
@extract($_POST);
?>
<body onLoad="showww()">
	 <!-- Main content -->
	 <div class="main-content">
<form class="form-horizontal" role="form" method="post" action="insert_gst_payment" enctype="multipart/form-data">			
			<ol class="breadcrumb breadcrumb-2"> 
<li><a href="index.html"><i class="fa fa-home"></i>Dashboard</a></li> 
<li><a href="form-basic.html">Payment</a></li> 
<li class="active"><strong>Gst Payment</strong></li>
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
<select name="customer_name" id="customer_name" required class="form-control" onChange="gstCalculate(this.value)">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='Seelampur'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->contact_id;?>"><?php echo $fetch_protype->first_name; ?></option>
					<?php } ?>

					</select>

</div> 
<label class="col-sm-2 control-label">C. Firm Name:</label> 
<div class="col-sm-4">
<input name="cf_name"  type="text" id="cf_name" value="" class="form-control"  readonly="">

</div> 
</div>
<div class="form-group">
<label class="col-sm-2 control-label">*Date:</label> 
<div class="col-sm-4"> 
<?php $date=date("m/d/Y");?>
<input name="date" id="date"  type="date" value="<?php echo $date;?>" onClick="check2()" class="form-control" required> 
</div> 
<label class="col-sm-2 control-label">*Firm Name:</label> 
<div class="col-sm-4"> 
<select name="firm" required class="form-control" id="firm" onChange="check1(this.value)">
						<option value="">----Select----</option>
					
					<?php 
					
						$sqlprotype=$this->db->query("select * from tbl_master_data where param_id='25'");
						foreach ($sqlprotype->result() as $fetch_protype){
						
					?>
				<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
					<?php } ?>

					</select>
</div> 
</div>

<div class="form-group">
<label class="col-sm-2 control-label">*Type:</label> 
<div class="col-sm-4"> 
<select name="type" required class="form-control" id="type" onChange="gstInvoicegst(this.value)">
				<option value="">----Select----</option>
				<option value="Invoice">Invoice</option>
				<option value="Payment">Payment</option>

					</select>
</div> 
<div id="showgst" style="display:none">
<label class="col-sm-2 control-label">*GST%:</label>  
<div class="col-sm-4" >
<input name="gst"  type="text" value="" id="gst" class="form-control" >
</div>
</div>
</div>

<div class="form-group"> 
<label class="col-sm-2 control-label">*Amount:</label> 
<div class="col-sm-4"> 
<input name="amt" id="amt"  type="number" min="1" value="" onKeyUp="calculation(this.value)" class="form-control" required> 
</div> 
<label class="col-sm-2 control-label">Remarks:</label> 
<div class="col-sm-4"> 
<textarea name="remarks" class="form-control" /> </textarea>
</div> 
</div>
<div id="check" style="display:none">
<div class="form-group"> 
<table class="table table-striped table-bordered table-hover">
<thead>
<tr>
<th>Amount</th>
<th>CGST</th>
<th>SGST</th>
<th>IGST</th>
</tr>
</thead>
<tbody>
<tr>
<th>
<input name="state"  type="hidden" value="" id="state" class="form-control" >
<input name="paidamt"  type="hidden" value="" id="paidamt" class="form-control" >
<input name="priAmt"  type="text" readonly="" value="" id="priAmt" class="form-control" >
</th>
<th><input name="cgst"  type="text" readonly="" value="" id="cgst" class="form-control" ></th>
<th><input name="sgst"  type="text" readonly="" value="" id="sgst" class="form-control" > </th>
<th><input name="igst"  type="text" readonly="" value="" id="igst" class="form-control" ></th>
</tr>
</tbody>
</table>
</div>
</div>
</div>

<div class="modal-footer">
<input type="submit" class="btn btn-sm" value="Save">
<button type="reset" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
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
						

<form class="form-horizontal" method="post" >
<div class="form-group panel-body-to"> 
<label class="col-sm-2 control-label">Firm Name</label> 
<div class="col-sm-3"> 
<select name="f_name" class="form-control">
<option value="">--Select--</option>
<?php 
$sqlprotype=$this->db->query("select * from tbl_master_data where param_id='25'");
foreach ($sqlprotype->result() as $fetch_protype){
?>
<option value="<?php echo $fetch_protype->serial_number;?>"><?php echo $fetch_protype->keyvalue; ?></option>
<?php }?>
</select>
</div> 
<label class="col-sm-2 control-label"><input type="submit" name="search" class="btn btn-sm" value="Search"></label> 
<div class="col-sm-3"></div>
</div>
</form>
<hr />

							<div class="table-responsive">
			<form class="form-horizontal" method="post" action="update_item"  enctype="multipart/form-data">					
<table class="table table-striped table-bordered table-hover dataTables-example" >
<thead>
<tr>
<th>Selected Firm</th>
<th id="select"><?php if($f_name!=''){
$sqlqry=$this->db->query("select * from tbl_master_data where serial_number='$f_name'");
$rowfetch=$sqlqry->row();
echo $rowfetch->keyvalue;
}else{
echo "All";
}?></th>
<th></th>
<th></th>
<th></th>
</tr> 
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
<?php
	if($search!='')
	{
		$out=array();
		if($f_name!=''){
		//echo "select * from tbl_payment_gst where firm='$f_name'";
		$sql=$this->db->query("select * from tbl_payment_gst where firm='$f_name'");
		foreach($sql->result() as $line){
			  $hdrData=$line->contact_id;
			array_push($out,$hdrData);
		}
			$implode=implode(',', $out);
			$query="select * from tbl_contact_m where contact_id in ($implode)";
		}else{
			$query="select *from tbl_contact_m where status='A' and module_status='Seelampur'";
		}
	}else{
		$query="select *from tbl_contact_m where status='A' and module_status='Seelampur'";
	}
	$result11=$this->db->query($query);
?>
<tbody>
<?php  
$i=1;
  foreach($result11->result() as $fetch_list)
  {
  if($f_name!=''){
	$abc=$this->db->query("select * from tbl_payment_gst where contact_id='$fetch_list->contact_id' and firm='$f_name'");
	
	foreach($abc->result() as $lines){

		if($lines->status=='Invoice'){
		   $c+=$lines->total_billamt; 
		  
			}
				else if($lines->status=='Payment'){
			   $b+=$lines->total_billamt; 
 
			}
 		} 
	 }
	 else
	 {
	 $abc=$this->db->query("select * from tbl_payment_gst where contact_id='$fetch_list->contact_id'");
	
	foreach($abc->result() as $lines){

		if($lines->status=='Invoice'){
		   $c+=$lines->total_billamt; 
		  
			}
				else if($lines->status=='Payment'){
			   $b+=$lines->total_billamt; 
 
			}
 		} 
	}
 ?>

<tr class="gradeC record" data-row-id="<?php echo $fetch_list->invoice_rid; ?>">

<th><?php echo $i;?></th>
<th><a href="view_payment?id=<?php echo $fetch_list->contact_id;?>" target="_blank" ><?php echo $fetch_list->first_name;?></a></th>
<th><?php 
$sqlqry111=$this->db->query("select SUM(amtgst) as val11 from tbl_payment_gst where contact_id='$fetch_list->contact_id' and payment_mode='Gst'");
$rowfetch11=$sqlqry111->row();
$gstamt=$rowfetch11->val11;
if($f_name==''){
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_gst where contact_id='$fetch_list->contact_id' and status='Invoice'");
$rowfetch=$sqlqry->row();
echo $debit=$rowfetch->val;
}else{
$sqlqry1=$this->db->query("select SUM(total_billamt) as val from tbl_payment_gst where contact_id='$fetch_list->contact_id' and status='Invoice' and firm='$f_name'");
$rowfetch1=$sqlqry1->row();
echo $debit1=$rowfetch1->val;
}
//echo $totDebit=$debit+$gstamt;?></th>
<th><?php 
if($f_name==''){
$sqlqry=$this->db->query("select SUM(total_billamt) as val from tbl_payment_gst where contact_id='$fetch_list->contact_id' and status='Payment'");
$rowfetch=$sqlqry->row();
echo $credit=$rowfetch->val;
}else{
$sqlqry1=$this->db->query("select SUM(total_billamt) as val from tbl_payment_gst where contact_id='$fetch_list->contact_id' and status='Payment' and firm='$f_name'");
$rowfetch1=$sqlqry1->row();
echo $credit1=$rowfetch1->val;
}?></th>
<th><?php 
if($f_name==''){
echo $bal=$debit-$credit;
}else{
echo $bal1=$debit1-$credit1;
}?></th>
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
					
						$sqlprotype=$this->db->query("select * from tbl_contact_m where module_status='Seelampur'");
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
//var gsttot=document.getElementById("gsttot").value;
//var pagstamt=document.getElementById("pagstamt").value;
document.getElementById("close").innerHTML=closeee;
document.getElementById("credit").innerHTML=credit;
document.getElementById("debit").innerHTML=debit;
//document.getElementById("actgst").innerHTML=gsttot;
//document.getElementById("paigst").innerHTML=pagstamt;
}
function check1(v){
var date=document.getElementById("date").value;
if(date==''){
alert("Fisrt Select Date");
document.getElementById("date").focus();
document.getElementById("firm").value='';
}
}

function check2(v){
var customer_name=document.getElementById("customer_name").value;
if(customer_name==''){
alert("Fisrt Select Customer");
document.getElementById("customer_name").focus();
document.getElementById("date").value='';
}
}

function gstCalculate(v){
//alert(v);
var xhttp = new XMLHttpRequest();
xhttp.open("GET", "fetch_state?ID="+v, false);
xhttp.send();
//alert(xhttp.responseText);
var val=xhttp.responseText;
var value=val.split("^");
var state=value[0];
var gst=value[1];
var cfname=value[2];
document.getElementById("state").value = state;
document.getElementById("gst").value = gst;
document.getElementById("cf_name").value = cfname;
//alert(state);

	//document.getElementById("modal-contentitem").innerHTML = xhttp.responseText;
}

function calculation(v){
//alert(v);
var type=document.getElementById("type").value;
//alert(type);
if(type==""){
alert("First Select Type");
document.getElementById("type").focus();
document.getElementById("amt").value='';
}else{
if(type=="Invoice"){
var state=document.getElementById("state").value;
//alert(state);
var gst=document.getElementById("gst").value;
//alert(gst);
var gstamt=Number(v)-(Number(v)/((100+18)/100));
	if(state=='7'){
		var cgst=Number(gstamt)/2;
		var sgst=Number(gstamt)/2;
		//alert(cgst);
		//alert(sgst);
		document.getElementById("cgst").value = cgst.toFixed(2);
		document.getElementById("sgst").value = sgst.toFixed(2);
		document.getElementById("igst").value = '';
	}else{
		document.getElementById("igst").value = gstamt.toFixed(2);
		document.getElementById("cgst").value = '';
		document.getElementById("sgst").value = '';
	}
	var result=(Number(v)/((100+18)/100));
		document.getElementById("priAmt").value = result.toFixed(2);
		var backendCalc=(Number(result)*(Number(gst)/100));
		//alert(backendCalc);
		document.getElementById("paidamt").value = backendCalc.toFixed(2);
}
}
}

function gstInvoicegst(v){
//alert(v);
var firm=document.getElementById("firm").value;
if(firm!=''){
	if(v=="Invoice"){
		document.getElementById("check").style.display="Block";
		document.getElementById("showgst").style.display="Block";
		return;
	}else{
		document.getElementById("check").style.display="none";
		document.getElementById("showgst").style.display="none";
	return;
	}
}else{
	alert("First Select Firm");
	document.getElementById("firm").focus();
	document.getElementById("type").value='';
}
}



</script>	
<?php

$this->load->view("footer.php");
?>
